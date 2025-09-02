@extends('layout.master')
@section('mytitle', 'Business Settings')
@section('content')
    @php
        $breadcrumb[]=['title'=>'Home'];
        $breadcrumb[]=['title'=>'Settings'];
        $breadcrumb[]=['title'=>__('Profit Report')];
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
                                    <th>MTCN</th>
                                    <th>Branch</th>
                                    <th>Amount</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->transaction_code }}</td>
                                            <td>{{ $transaction->receiver_branch->name }}</td>
                                            <td>{{ number_format($transaction->amount, 2) }}</td>
                                            <td>{{ number_format($transaction->transaction_fee ?? 0, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="font-weight-bold">
                                        <td colspan="2" class="text-right">Total:</td>
                                        <td>{{ number_format($transactions->sum('amount'), 2) }}</td>
                                        <td>{{ number_format($transactions->sum('transaction_fee'), 2) }}</td>
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
