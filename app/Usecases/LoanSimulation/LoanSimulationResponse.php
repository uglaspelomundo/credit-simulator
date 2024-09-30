<?php

namespace App\Usecases\LoanSimulation;

class LoanSimulationResponse
{
    public $totalAmountToPay;
    public $monthlyPayment;
    public $totalInterest;

    public function __construct($totalAmountToPay, $monthlyPayment, $totalInterest)
    {
        $this->totalAmountToPay = $totalAmountToPay;
        $this->monthlyPayment = $monthlyPayment;
        $this->totalInterest = $totalInterest;
    }

    public function toArray()
    {
        return [
            'totalAmountToPay' => number_format($this->totalAmountToPay, 2, ',', '.'),
            'monthlyPayment' => number_format($this->monthlyPayment, 2, ',', '.'),
            'totalInterest' => number_format($this->totalInterest, 2, ',', '.'),
        ];
    }
}
