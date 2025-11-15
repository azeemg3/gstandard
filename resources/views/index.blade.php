@extends('layout.master')
@section('mytitle', __('file.main_dashboard'))
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6 mb-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_mtcn }}</h3>

                        <p>Current Month MTCN</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6 mb-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $profit }}</h3>

                        <p>Current Month Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6 mb-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_staff }}</h3>

                        <p>Total Staff</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6 mb-4">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $expenses }}</h3>

                        <p>Current Month Expense</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header border-0 d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-exchange-alt mr-2"></i> Recent Transactions
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover table-sm mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>MTCN</th>
                                            <th>Amount</th>
                                            <th>Sender</th>
                                            <th>Receiver</th>
                                            <th>Status</th>
                                            <th style="width: 40px">Branch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        @php
                                            $senderDetails = json_decode($item->sender_details);
                                            $receiverDetails = json_decode($item->receiver_details);
                                        @endphp
                                        <tr>
                                            <td class="text-muted">{{ $loop->iteration }}.</td>
                                            <td class="text-monospace">{{ $item->transaction_code }}</td>
                                            <td class="text-nowrap">{{ $item->amount }}</td>
                                            <td>{{ $senderDetails->sender_name  }} ({{ $senderDetails->sender_mobile }})</td>
                                            <td>{{ $receiverDetails->receiver_name }} ({{ $receiverDetails->receiver_mobile }})</td>
                                            <td>
                                                @if ($item->status == 'delivered')
                                                    <span class="badge bg-success">{{ $item->status }}</span>
                                                @elseif ($item->status == 'approved')
                                                    <span class="badge bg-success">{{ $item->status }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->receiver_branch->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection