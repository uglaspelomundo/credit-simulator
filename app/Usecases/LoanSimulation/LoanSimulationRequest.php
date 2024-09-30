<?php

namespace App\Usecases\LoanSimulation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class LoanSimulationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => null,
            'errors' => $validator->errors()
        ], 422));
    }

    public function rules()
    {
        return [
            'loan_amount' => 'required|numeric',
            'birth_date' => 'required|date',
            'months' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'loan_amount.required' => 'O campo valor do empréstimo é obrigatório.',
            'loan_amount.numeric' => 'O campo valor do empréstimo deve ser um número.',
            'birth_date.required' => 'O campo data de nascimento é obrigatório.',
            'birth_date.date' => 'O campo data de nascimento deve ser uma data válida.',
            'months.required' => 'O campo quantidade de meses é obrigatório.',
            'months.integer' => 'O campo quantidade de meses deve ser um número.',
            'months.min' => 'O campo quantidade de meses tem que ser maior 0.'
        ];
    }
}
