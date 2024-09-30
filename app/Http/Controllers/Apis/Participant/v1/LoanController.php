<?php

namespace App\Http\Controllers\Apis\Participant\v1;

use App\Http\Controllers\Apis\Participant\Controller;
use App\UseCases\LoanSimulation\LoanSimulationRequest;
use App\UseCases\LoanSimulation\LoanSimulationUsecase;
use Exception;

class LoanController extends Controller
{
    protected $loanSimulationUsecase;

    public function __construct(LoanSimulationUsecase $loanSimulationUsecase)
    {
        $this->loanSimulationUsecase = $loanSimulationUsecase;
    }

    /**
     * Retornar o resultado de uma simulação de empréstimo.
     */
    public function simulate(LoanSimulationRequest $request)
    {
        try {
            $loanAmount = $request->input('loan_amount');
            $birthDate = $request->input('birth_date');
            $months = $request->input('months');

            $simulationResult = $this->loanSimulationUsecase->simulate($loanAmount, $birthDate, $months);

            return response()->json([
                'success' => true,
                'message' => "Simulação realizada com sucesso!",
                'data' => $simulationResult->toArray()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 400);
        }
    }
}
