@extends('layout.master')
@section('mytitle', 'Currency Details')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Currency Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>Name</th><td>{{ $currency->name }}</td></tr>
                <tr><th>Code</th><td>{{ $currency->code }}</td></tr>
                <tr><th>Symbol</th><td>{{ $currency->symbol }}</td></tr>
                <tr><th>Exchange Rate</th><td>{{ $currency->exchange_rate }}</td></tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('currency.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
