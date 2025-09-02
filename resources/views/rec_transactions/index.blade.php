@extends('layout.master')
@section('mytitle', 'Business Settings')
@section('content')
    @php
        $breadcrumb[]=['title'=>'Home'];
        $breadcrumb[]=['title'=>'Settings'];
        $breadcrumb[]=['title'=>__('file.rec_transaction_list')];
    @endphp
    <x-content-header :breadcrumb="$breadcrumb" />
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        @include('transaction.modal')
                        <x-add-new-btn btnId="add-new" />
                        <div class="table-responsive">
                            <table class="table table-sm data-table">
                                <thead>
                                <tr>
                                    <th>MTCN</th>
                                    <th>Amount</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Receiver Branch</th>
                                    <th>Status</th>
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
@include('rec_transactions.js_func')
