<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        if (!Auth::user()->hasRole('Admin')) {
            $query->where('from_branch_id', Auth::user()->branch_id);
        }
        $data= $query->orderBy('id', 'desc')->limit(10)->get();
        return view('index', compact('data'));
    }
}
