<?php

namespace App\Repositories\Budget;

use App\Contracts\Request;
use App\Models\Budget\Budget;
use App\Http\Requests\Budget\StoreBudgetRequest;
use App\Http\Requests\Budget\UpdateBudgetRequest;

class BudgetRepository
{
    /**
     * @var \App\Models\Budget\Budget
     */
    protected $budgetModel;

    /**
     * @param \App\Models\Budget\Budget $budgetModel
     */

    public function __construct(
        Budget $budgetModel
    ) {
        $this->budgetModel = $budgetModel;
    }

    /**
     * @param \App\Http\Requests\Budget\StoreBudgetRequest
     * @return \App\Models\Budget\Budget
     */

    public function store(StoreBudgetRequest $request)
    {
        $input = $request->safe([
            'cashflow_id',
            'category_id',
            'total',
            'month',
        ]);

        $budget = $this->budgetModel->create([
            'cashflow_id'       => $input['cashflow_id'] ?? null,
            'category_id'       => $input['category_id'] ?? null,
            'total'             => $input['total'] ?? null,
            'month'             => $input['month'] ?? null,
        ]);

        return $budget;
    }


    /**
     * @param \App\Http\Requests\Budget\UpdateBudgetRequest $request
     * @param \App\Models\Budget\Budet $budget
     * @return \App\Models\Budget\Budget
     */

    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $input = $request->safe([
            'cashflow_id',
            'category_id',
            'total',
            'month',
        ]);

        $budget->update([
            'cashflow_id'       => $input['cashflow_id'] ?? $budget->cashflow_id,
            'category_id'       => $input['category_id'] ?? $budget->category_id,
            'total'             => $input['total'] ?? $budget->total,
            'month'             => $input['month'] ?? $budget->month,
        ]);

        return $budget;
    }

    /**
     * @param \App\Contracts\Request $request
     * @param \App\Models\Budget\Budget $budget
     * @return \App\Models\Budget\Budget
     */

    public function delete(Request $request, Budget $budget)
    {
        $budget->delete();
        return $budget;
    }
}
