<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'txn_id',
    	'amount',
    	'status',
    	'description',
    	'request',
    	'response',
    	'recruiter_id',
        'organization_id'
    ];


    protected $cast = [
        'created_at' => 'datetime'
    ];

    protected $appends = ['invoice_link'];

    public function getInvoiceLinkAttribute()
    {
        return asset('web-storage/public/'.$this->invoice);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
