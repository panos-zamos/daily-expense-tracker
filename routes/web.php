<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/test', function () {
        return \App\User::with('defaultBudget', 'defaultBudget.latestExpenses', 'defaultBudget.latestExpenses.user')->get()->first();
    });

    Route::get('/home', function () {
        return view('home', [
            'user' => \App\User::with('defaultBudget', 'defaultBudget.latestExpenses', 'defaultBudget.latestExpenses.user')->get()->first(),
        ]);
    })->name('home');

    Route::post('/add_expense', function (\App\Http\Requests\NewExpense $expense) {
        $data = $expense->validated();
        $user = \App\User::with('defaultBudget')->get()->first();
        $newExpense = new \App\Expense($data + ['user_id' => $user->id, 'gain' => false]);
        $user->defaultBudget->expenses()->save($newExpense);

        return redirect('home');
    })->name('add_expense');

    Route::post('/add_gain', function (\App\Http\Requests\NewExpense $expense) {
        $data = $expense->validated();
        $user = \App\User::with('defaultBudget')->get()->first();
        $newExpense = new \App\Expense($data + ['user_id' => $user->id, 'gain' => true]);
        $user->defaultBudget->expenses()->save($newExpense);

        return redirect('home');
    })->name('add_gain');

    Route::resource('expenses', 'ExpenseController');
});
