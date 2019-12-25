<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BudgetAndExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('budget_id');
            $table->unsignedInteger('amount');
            $table->boolean('gain');
            $table->string('note');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('budget_id')->references('id')->on('budgets');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->addColumn('uuid', 'default_budget_id');
            $table->foreign('default_budget_id')->references('id')->on('budgets')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['default_budget_id']);
            $table->dropColumn('default_budget_id');
        });
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('budgets');
    }
}
