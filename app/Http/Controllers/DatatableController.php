<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Job;
use App\Models\JobPaymentTransaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentLogs;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class DatatableController extends Controller {
	public function getPaymentLogs(Request $request) {
		if ($request->date_range) {
			$date_range_array = explode(' - ',$request->date_range);
			$from = \Carbon\Carbon::parse($date_range_array[0]);
			$to = \Carbon\Carbon::parse($date_range_array[1]);
			$data = JobPaymentTransaction::with('organization')
			->whereDate('created_at','>=',$from)
			->whereDate('created_at','<=',$to)
			->get();
		}
		else {
			$data = JobPaymentTransaction::with('organization')->get();
		}
		return Datatables::of($data)
						->addIndexColumn()
						->addColumn('amount', function($row) {
			return '£'.$row->amount;
		})
		->addColumn('action', function($row) {
			$btn = '';
			return $btn;
		})
		->addColumn('status', function($row) {
			return '<span style="color:green">'.$row->status.'</span>';
		})
		->addColumn('company_name', function($row){
			return $row->organization ? $row->organization->name : '';
			// return $row->created_at->format('d/m/y');
		})
		->addColumn('invoice', function($row) {
			return '<a target="_blank" class="download-invoice" data-id="'.$row->id.'">Download Invoice</a>';
		})
		->rawColumns(['action','status','invoice'])
		->make(true);
	}

	public function exportPaymentLogs(Request $request) {
		// return (new PaymentLogs)->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);
		// return Excel::download(new PaymentLogs($request->date_range), 'payment.xlsx');
		return Excel::download(new PaymentLogs($request->date_range), 'payment.csv',\Maatwebsite\Excel\Excel::CSV,[
			'Content-Type' => 'text/csv',
		]);
	}

	public function exportBulkInvoices(Request $request) {
		if ($request->has('id')) {
			$payment_log = JobPaymentTransaction::with('job')->find($request->id);
			$customer = new Buyer([
				'name'          => @\Auth::user()->name,
				'custom_fields' => [
					'email' => \Auth::user()->email,
				],
			]);
			$sub_total = Job::costRequiredToPostJobExclVat($payment_log->job->id);
			$item = (new InvoiceItem(10))->title('Job Post Charge | Ref no:'.$payment_log->job->job_ref_number)->pricePerUnit($sub_total)->quantity(1);
			$invoice = Invoice::make()
					->buyer($customer)
					->series($payment_log->txn_id)
					->serialNumberFormat('{SERIES}')
					->date($payment_log->created_at)
					->dateFormat('d/m/Y')
					->filename($payment_log->txn_id)
					->logo(public_path('assets/images/logo-email.png'))
					->addItem($item)
					->taxRate(20);
			return $invoice->stream();
		}
		else {
			if (empty($request->date_range)) {
				$data = JobPaymentTransaction::all();
			}
			else {
				$date_range_array = explode(' - ',$request->date_range);
				$from = \Carbon\Carbon::parse($date_range_array[0]);
				$to = \Carbon\Carbon::parse($date_range_array[1]);
				$data = JobPaymentTransaction::whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to)->get();
			}					
			$all_files = '';
			foreach ($data as $key => $value) {
				$customer = new Buyer([
					'name'          => @\Auth::user()->name,
					'custom_fields' => [
						'email' => \Auth::user()->email,
					],
				]);
				$sub_total = Job::costRequiredToPostJobExclVat($value->job->id);
				$item = (new InvoiceItem(10))->title('Job Post Charge | Ref no:'.$value->job->job_ref_number)->pricePerUnit($sub_total)->quantity(1);
				$invoice = Invoice::make()
									->buyer($customer)
									->series($value->txn_id)
									->serialNumberFormat('{SERIES}')
									->date($value->created_at)
									->dateFormat('d/m/Y')
									->filename($value->txn_id)
									->logo(public_path('assets/images/logo-email.png'))
									->addItem($item)->taxRate(20)->save('public');
				$all_files .= $value->txn_id.'.pdf ';
			}
			chdir('storage');
			$file_name = 'output-'.uniqid().time().'.pdf';
			$command = 'pdfunite '.$all_files.' '.$file_name;
			shell_exec($command);
			shell_exec('rm -f '.$all_files);
			$headers = array(
				'Content-Type: application/pdf',
			);
			return \Response::download($file_name, 'filename.pdf', $headers);
		}
		/* if ($request->has('id')) {
			$payment_log = JobPaymentTransaction::find($request->id);
			// dd($payment_log);
			$customer = new Buyer([
				'name'          => 'John Doe',
				'custom_fields' => [
					'email' => 'test@example.com',
				],
			]);
			$item = (new InvoiceItem(10))->title('Credit Purchase')->pricePerUnit(1)->quantity($payment_log->amount);
			$invoice = Invoice::make()
									->buyer($customer)
									->filename($payment_log->txn_id)
									// ->logo(public_path('assets/images/logo-email.png'))
									->addItem($item);
			return $invoice->stream();
		}
		else {
			if (empty($request->date_range)) {
				$data = JobPaymentTransaction::all();
			}
			else {
				$date_range_array = explode(' - ',$request->date_range);
				$from = \Carbon\Carbon::parse($date_range_array[0]);
				$to = \Carbon\Carbon::parse($date_range_array[1]);
				$data = JobPaymentTransaction::
				whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
			}
			$all_files = '';

			foreach ($data as $key => $value) {
					$customer = new Buyer([
						'name' => 'John Doe',
						'custom_fields' => [
							'email' => 'test@example.com',
						],
					]);
					$item = (new InvoiceItem(10))->title('Credit Purchase')->pricePerUnit(1)->quantity($value->amount);
					$invoice = Invoice::make()
											->buyer($customer)
											->filename($value->txn_id)
											// ->logo(public_path('assets/images/logo-email.png'))
											->addItem($item)->save('public');
					$all_files .= $value->txn_id.'.pdf ';
			}
			
			chdir('storage');
			$file_name = 'output-'.uniqid().time().'.pdf';
			$command = 'pdfunite '.$all_files.' '.$file_name;
			shell_exec($command);
			shell_exec('rm -f '.$all_files);
			$headers = array(
				'Content-Type: application/pdf',
			);
			return \Response::download($file_name, 'filename.pdf', $headers);
		} */

		/* $date_range_array = explode(' - ',$request->date_range);
		$from = \Carbon\Carbon::parse($date_range_array[0]);
		$to = \Carbon\Carbon::parse($date_range_array[1]);
		$data = PaymentLog::whereDate('created_at','>=',$from)
		->whereDate('created_at','<=',$to)
		->get()->pluck('invoice')->toArray();
		$data = implode(' ', $data);
		chdir('web-storage/public');
		$file_name = 'output-'.uniqid().time().'.pdf';
		$command = 'pdfunite '.$data.' '.$file_name;
		shell_exec($command);
		$headers = array(
			'Content-Type: application/pdf',
		);
		return \Response::download($file_name, 'filename.pdf', $headers);
		dd($request->date_range); */
	}


	public function getPublihsedJobs(Request $request)
	{
		$jobs = Job::with('organization');

        if($request->job_type != null){

            switch ($request->job_type) {
                case 'featured':
                    $jobs->where('is_featured',1);
                    break;
                
                case 'non_featured':
                    $jobs->where('is_featured',0);
                    break;
                
                default:
                    # code...
                    break;
            }
            
        }

        if($request->job_status != null){

            switch ($request->job_status) {
                
                
                case 'expired':
                    $jobs->whereDate('expiring_at','<',\Carbon\Carbon::now());
                    break;
                
                case 'open':
                    $jobs->whereDate('expiring_at','>',\Carbon\Carbon::now());
                    break;
                
                case 'unpublished':
                    $jobs->where('is_payment_received',0);
                    break;
                
                default:
                    # code...
                    break;
            }
        }



        $data = $jobs->orderByRaw('ISNULL(advert_days) desc')->orderBy('id','desc')->get();
        // return [];
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        // dd($row);

                       
                        $btn = '<a class="action-button" title="View" href="view/'.$row->id.'"><i class="text-info fa fa-eye"></i></a>
                        <a class="action-button" title="Edit" href="edit/'.$row->id.'"><i class="text-warning fa fa-edit"></i></a>
                        <a class="action-button" title="Suspend" href="'.route('suspend_job', ['id' => $row->id]).'"><i class="text-primary fa fa-exclamation-circle"></i></a>
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="'.$row->id.'"><i class="text-danger fa fa-trash-alt"></i></a>';
                        
   
                        return $btn;
                })
                ->addColumn('recruiter_name', function($row){
                        $data = $row->recruiter;

                        if ($data) {

                            if(empty($data->name)){

                                return '<div title='.$data->email.'>'.$data->email.'</div>';
                            }else{

                                return '<div title='.$data->name.'>'.$data->name.'</div>';
                            }
                        }else{
                            return '';
                        }
                            

                })
                ->addColumn('expiring_at', function($row){
                        
                        if ($row->expiring_at) {
                            
                            return \Carbon\Carbon::parse($row->expiring_at)->format('d/m/y');
                        }else{

                            return '';
                        }
                })
                ->addColumn('job_type', function($row){
                        
                        return ucwords(str_replace('_',' ',$row->job_type));
                })
                ->addColumn('company_name', function($row){
                        
                        return $row->organization->name;
                })
                ->addColumn('status', function($row){
 
                        $html = '';

                        if ($row->expiring_at > \Carbon\Carbon::now()) {
                           
                           $html = '<div class="badge badge-success">open</div>';
                        }elseif ($row->expiring_at == null) {
                            $html = '';                            
                        }else{

                            $html = '<div class="badge badge-danger">expired</div>';
                        }

                        if ($row->is_payment_received == 1) {
                           
                           $html .= '<div class="badge badge-primary">Published</div>';
                        }else{

                            $html .= '<div class="badge badge-warning">Unpublished</div>';
                        }
                        // dump($row->advert_days);
                        if (empty($row->advert_days)) {
                            $html .= '<div class="badge badge-secondary">'.'FREE'.'</div>';
                        }                  
   
                        return $html;
                })
                ->rawColumns(['action','status','recruiter_name'])
                ->make(true);
	}
}
