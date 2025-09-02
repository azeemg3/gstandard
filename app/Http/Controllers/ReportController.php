<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

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
}
