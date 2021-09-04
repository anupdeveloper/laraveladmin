<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organization extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'domain',
        'country_code',
        'contact_number',
        'vat_number',
        'email',
        'address',
        'city',
        'county',
        'state',
        'country',
        'pincode'
    ];

    /**
     * Get the recruiters for the organization.
     */
    public function savedCards()
    {
        return $this->hasMany(SavedCard::class);
    }
    public function recruiters()
    {
        return $this->hasMany(Recruiter::class);
    }
    public function recruiter()
    {
        return $this->hasOne(Recruiter::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function jobHistories()
    {
    	return $this->hasMany(JobHistory::class);
    }

    public function organizationCredit()
    {
        return $this->hasOne(OrganizationCredit::class);
    }

    public function organizationCreditDetails()
    {
    	return $this->hasMany(OrganizationCreditDetail::class);
    }

    public function paymentLogs()
    {
        return $this->hasOne(PaymentLog::class);
    }
    public function paymentTransactions()
    {
        return $this->hasOne(PaymentTransaction::class);
    }
    public function jobPaymentTransactions()
    {
        return $this->hasMany(JobPaymentTransaction::class);
    }

    /**
     * Get the social logins for the user.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function ticketMessages()
    {
        return $this->hasOne(TicketMessage::class);
    }
}
