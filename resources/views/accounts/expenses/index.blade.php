@extends('layout.master')
@section('mytitle', 'Business Settings')
@section('content')
    @php
        $breadcrumb[]=['title'=>'Home'];
        $breadcrumb[]=['title'=>'Accounts'];
        $breadcrumb[]=['title'=>__('Expenses')];
    @endphp
    <x-content-header :breadcrumb="$breadcrumb" />
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        @include('accounts.expenses.modal')
                        <x-add-new-btn btnId="add-new" />
                        <div class="table-responsive">
                            <table class="table table-sm data-table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Expense</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
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
@include('accounts.expenses.js_func')
