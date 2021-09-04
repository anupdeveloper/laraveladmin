<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\QueuedVerifyEmailJob;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Http\Request;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'ip_address',
        'is_email_verified',
        'login_with',
        'signup_via',
        'is_job_alert_enabled',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @overide
     * Mark the given user's email as verified.
     *
     * @return bool
    */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'is_email_verified' => 1,
        ])->save();
    }

    /**
     * Get the social logins for the user.
    */
    public function socialLogins()
    {
        return $this->hasMany(UserSocialLogin::class);
    }

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobAlert()
    {
        return $this->hasOne(JobAlert::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobHistoryApplications()
    {
        return $this->hasMany(JobHistoryApplication::class, 'applicant_id', 'id');
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function JobApplications()
    {
        return $this->hasMany(JobApplication::class, 'applicant_id', 'id');
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function JobBookmarks()
    {
        return $this->hasMany(BookmarkedJob::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobHistoryBookmarks()
    {
        return $this->hasMany(JobHistoryBookmark::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobSearchHistory()
    {
        return $this->hasMany(JobSearchHistory::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobHistoryViews()
    {
        return $this->hasMany(JobHistoryView::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobViews()
    {
        return $this->hasMany(JobViewHistory::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobReports()
    {
        return $this->hasMany(JobReport::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function jobViewHistory()
    {
        return $this->hasMany(JobViewHistory::class);
    }

    /**
     * Job seacrh history for a perticular user.
    */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public static function saveTeacher(Request $request, $mode): bool
    {
        $email_verified = 0;
        if ($request->has($request->input('email_verified'))) {
            $email_verified = 1;
        }

        if ($mode === 'insert') {
            $model = new User();
            $model->name = $request->input('name');
            $model->first_name = $request->input('first_name');
            $model->last_name = $request->input('last_name');
            $model->email = $request->input('email');
            $model->is_email_verified = $email_verified;
            $model->ip_address = $request->ip();
            $model->role_id = '4';
            $status = $model->save();
        } elseif ($mode === 'update') {
            $status = User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'first_name' =>  $request->first_name,
                        'last_name' => $request->last_name,
                        'is_email_verified' => $email_verified,
                        'ip_address' => $request->ip()
                        ]);
        } elseif ($mode === 'delete') {
            $row = User::find($request->id);
            $status = $row->delete();
        }


        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
