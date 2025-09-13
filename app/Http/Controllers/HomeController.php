<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = Transaction::with('receiver_branch')->select('*');
        $total_mtcn = 0;
        $profit = 0;
        $expenses = 0;
        $total_staff = 0;
        if (!Auth::user()->hasRole('Admin')) {
            $query->where('from_branch_id', Auth::user()->branch_id);
        }
        if (Auth::user()->hasRole('Admin')) {
            $trans = Transaction::all();
            $expenses = Expense::sum('amount');
            $total_mtcn = $trans->sum('amount');
            $profit = $trans->sum('transaction_fee');
            $total_staff = User::whereHas('roles', function($q){
                $q->where('name','Staff');
            })->count();
        }
        $data = $query->orderBy('id', 'desc')->limit(10)->get();
        return view('index', compact('data', 'total_mtcn', 'profit', 'expenses', 'total_staff'));
    }
}
