<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budget = factory(App\Budget::class)->create();
        $user = factory(App\User::class)->create(['default_budget_id' => $budget->id]);

        factory(\App\Expense::class, 5)->create(['user_id' => $user->id, 'budget_id' => $budget->id]);
    }
}
