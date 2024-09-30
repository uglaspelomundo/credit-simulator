<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSimulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_amount',
        'birth_date',
        'months',
        'total_amount_to_pay',
        'monthly_payment',
        'total_interest',
    ];
}
