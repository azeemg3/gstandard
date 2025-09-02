@extends('layout.master')
@section('mytitle', 'Currency List')
@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <a href="{{ route('currency.create') }}" class="btn btn-success float-right">Add Currency</a>
                <h3 class="card-title">Currency List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Symbol</th>
                                <th>Exchange Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('currency.js_func')
