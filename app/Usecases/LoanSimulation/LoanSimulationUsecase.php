<?php

namespace App\Usecases\LoanSimulation;

use Carbon\Carbon;
use App\Models\Loan\LoanSimulation;
use Illuminate\Support\Facades\DB;
use Exception;

class LoanSimulationUsecase
{
    public function simulate($loanAmount, $birthDate, $months)
    {
        $age = $this->calculateAge($birthDate);
        $annualInterestRate = $this->getInterestRate($age);
        $monthlyInterestRate = $this->convertToMonthlyRate($annualInterestRate);

        $monthlyPayment = $this->calculateMonthlyPayment($loanAmount, $monthlyInterestRate, $months);
        $totalAmountToPay = $monthlyPayment * $months;
        $totalInterest = $totalAmountToPay - $loanAmount;

        return $this->saveLoanSimulation($loanAmount, $birthDate, $months, $totalAmountToPay, $monthlyPayment, $totalInterest);
    }

    #region metodo private
    private function calculateAge($birthDate)
    {
        return Carbon::parse($birthDate)->age;
    }

    private function getInterestRate($age)
    {
        if ($age <= 25) {
            return 5;
        } elseif ($age <= 40) {
            return 3;
        } elseif ($age <= 60) {
            return 2;
        } else {
            return 4;
        }
    }

    private function convertToMonthlyRate($annualInterestRate)
    {
        return $annualInterestRate / 12 / 100;
    }

    private function calculateMonthlyPayment($loanAmount, $monthlyInterestRate, $months)
    {
        return ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$months));
    }

    private function saveLoanSimulation($loanAmount, $birthDate, $months, $totalAmountToPay, $monthlyPayment, $totalInterest)
    {
        DB::beginTransaction();

        try {
            LoanSimulation::create([
                'loan_amount' => $loanAmount,
                'birth_date' => $birthDate,
                'months' => $months,
                'total_amount_to_pay' => $totalAmountToPay,
                'monthly_payment' => $monthlyPayment,
                'total_interest' => $totalInterest,
            ]);

            DB::commit();

        } catch (Exception $ex) {
            DB::rollBack();
            throw new Exception("Não foi possível processar a requisição.", 400);
        }

        return new LoanSimulationResponse($totalAmountToPay, $monthlyPayment, $totalInterest);
    }  

    #endregion
}
