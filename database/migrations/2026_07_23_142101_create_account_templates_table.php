<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_templates', function (Blueprint $table) {

            $table->id();

            $table->integer('account_code');

            $table->string('account_name');

            $table->enum('account_type', [
                'Asset',
                'Liability',
                'Equity',
                'Income',
                'Expense'
            ]);

            $table->enum('balance_type', [
                'Debit',
                'Credit'
            ]);

            $table->string('industry')
                ->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('account_templates');
    }
};