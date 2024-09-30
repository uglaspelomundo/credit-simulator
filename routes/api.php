<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\Participant\v1\LoanController;

Route::post('/loan/simulate', [LoanController::class, 'simulate']);