<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Show the profit report.
     */
    public function profit_report(Request $request)
    {
        // Example: Calculate total profit from transactions
        // You can adjust logic as needed for your business rules
        $transactions = Transaction::query();
        if ($request->has('from_date') && $request->has('to_date')) {
            $transactions->whereBetween('created_at', [
                $request->input('from_date'),
                $request->input('to_date')
            ]);
        }

        // $totalAmount = $transactions->sum('amount');
        // $totalFee = $transactions->sum('transaction_fee');
        // $profit = $totalFee; // Or use your own profit calculation logic
        $transactions = $transactions->with('receiver_branch')->get();
        return view('reports.profit_report.index', [
            'transactions' => $transactions,
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date'),
        ]);
    }
    public function branch_summary(Request $request)
    {
        // Example: Calculate total profit from transactions
        // You can adjust logic as needed for your business rules
        $branches = Branch::with([
            'transactions' => function ($q) {
                $q->select(
                    'from_branch_id',
                    DB::raw('SUM(amount) as total_transactions'),
                    DB::raw('SUM(transaction_fee) as total_profit')
                )
                    ->groupBy('from_branch_id');
            },
            'staffSalaries' => function ($q) {
                $q->select(
                    'branch_id',
                    DB::raw('SUM(amount) as total_salaries')
                )
                    ->groupBy('branch_id');
            },
            'expenses' => function ($q) {
                $q->select(
                    'branch_id',
                    DB::raw('SUM(amount) as total_expenses')
                )
                    ->groupBy('branch_id');
            }
        ])->when(!auth()->user()->hasRole('Admin'), function ($query) {
            $query->where('id', auth()->user()->branch_id);
        })
            ->get();


        // $transactions = Transaction::query();
        // if ($request->has('from_date') && $request->has('to_date')) {
        //     $transactions->whereBetween('created_at', [
        //         $request->input('from_date'),
        //         $request->input('to_date')
        //     ]);
        // }
        // $transactions->groupBy('');
        // $totalAmount = $transactions->sum('amount');
        // $totalFee = $transactions->sum('transaction_fee');
        // $profit = $totalFee; // Or use your own profit calculation logic
        // $transactions = $transactions->with('receiver_branch')->get();
        return view('reports.branch_summary.index', compact('branches'), [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date'),
        ]);
    }
}
