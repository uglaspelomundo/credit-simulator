<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loan_simulations', function (Blueprint $table) {
            $table->id();
            $table->decimal('loan_amount', 10, 2);
            $table->date('birth_date');
            $table->integer('months');
            $table->decimal('total_amount_to_pay', 10, 2);
            $table->decimal('monthly_payment', 10, 2);
            $table->decimal('total_interest', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_simulations');
    }
};
