@extends('layout.master')
@section('mytitle', 'Branch Summary Report')
@section('content')
    @php
        $breadcrumb[]=['title'=>'Home'];
        $breadcrumb[]=['title'=>'Reports'];
        $breadcrumb[]=['title'=>__('Branch Summary Report')];
    @endphp
    <x-content-header :breadcrumb="$breadcrumb" />
    <style>
        @media print {
            .print-btn, .navbar, .sidebar, .content-header, footer { display: none !important; }
            .card { box-shadow: none; border: none; }
        }
        .print-btn { float: right; margin-bottom: 20px; }
        .report-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .report-header .logo {
            max-width: 120px;
        }
        .company-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="report-header">
                                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" class="logo" alt="Logo">
                                <span class="company-title">{{ config('app.name') }}</span>
                                <button class="btn btn-primary print-btn float-right" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Transactions</th>
                                    <th>Total Profit</th>
                                    <th>Total Staff Salaries</th>
                                    <th>Total Expenses</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalProfit = 0;
                                        $totalSalaries = 0;
                                        $totalExpenses = 0;
                                        $totalTransactions = 0;
                                    @endphp
                                    @foreach($branches as $branch)
                                        @php
                                            $totalProfit += $branch->transactions()->sum('transaction_fee');
                                            $totalSalaries += $branch->staffSalaries()->sum('amount');
                                            $totalExpenses += $branch->expenses()->sum('amount');
                                            $totalTransactions += $branch->transactions()->sum('amount');
                                        @endphp
                                        <tr>
                                            <td>{{ $branch->name }}</td>
                                            <td>{{ number_format($branch->transactions()->sum('amount'), 2) }}</td>
                                            <td>{{ number_format($branch->transactions()->sum('transaction_fee'), 2) }}</td>
                                            <td>{{ number_format($branch->staffSalaries()->sum('amount'), 2) }}</td>
                                            <td>{{ number_format($branch->expenses()->sum('amount'), 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th><strong>Total</strong></th>
                                        <th>{{ $totalTransactions }}</th>
                                        <th>{{ number_format($totalProfit, 2) }}</th>
                                        <th>{{ number_format($totalSalaries, 2) }}</th>
                                        <th>{{ number_format($totalExpenses, 2) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
