<?php
/**
 * Created by PhpStorm.
 * User: oziel
 * Date: 5/05/17
 * Time: 01:39 AM
 */

namespace App\Repositories;

use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class FinancesRepository
{
    private $income;
    private $expense;

    public function __construct(Income $income, Expense $expense)
    {
        $this->income = $income;
        $this->expense = $expense;
    }

    public function byDate($month, $year)
    {
        //$month = Carbon::now()->month;
        $incomes = $this->income->whereMonth('entry_date', $month)->whereYear('entry_date', $year)->get();
        $expenses = $this->expense->whereMonth('entry_date', $month)->whereYear('entry_date', $year)->get();
        $totalIncomes = $incomes->sum('total');
        $totalExpenses = $expenses->sum('total');
        $profit = $totalIncomes - $totalExpenses;
        //$newCollection = collect($incomes, $expenses, $profit);
        //return $newCollection;

        return [
            'incomes' => $totalIncomes,
            'expenses' => $totalExpenses,
            'profit' => $profit
        ];
    }

    public function incomesByCategory($month, $year)
    {
        $incomes = $this->income->whereMonth('entry_date', $month)->whereYear('entry_date', $year)->get();
        $incomesByCat = [];
        $categories = ['facturas'];
        //$categories = $this->expense->select('type')->get();
        foreach ($categories as $category) {
            $total = 0.0;
            foreach ($incomes as $income) {
                if ($income->type === $category) {
                    $total += $income->total;
                    $incomesByCat[$income->type] = $total;
                }
            }
        }
        return $incomesByCat;
    }

    public function expensesByCategory($month, $year)
    {
        $expenses = $this->expense->whereMonth('entry_date', $month)->whereYear('entry_date', $year)->get();
        $expensesByCat = [];
        $categories = ['salarios'];
        //$categories = $this->income->select('type')->get();
        foreach ($categories as $category) {
            $total = 0.0;
            foreach ($expenses as $expense) {
                if ($expense->type === $category) {
                    $total += $expense->total;
                    $expensesByCat[$expense->type] = $total;
                }
            }
        }
        return $expensesByCat;
    }

    public function allIncomes()
    {
        return $this->income->all();
    }

    public function allExpenses()
    {
        return $this->expense->all();
    }

}