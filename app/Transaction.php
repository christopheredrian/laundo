<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'customer_contact_number',
        'amount',
        'date_of_transaction',
        'responsible_employee_for_transaction',
        'details',
    ];
}
