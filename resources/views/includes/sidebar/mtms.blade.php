<?php
$lms=['transaction-fee','transaction','rec_transaction'];
?>
@can('transaction_view')
<li class="nav-item has-treeview @if(in_array(Request::segment(1),$lms)) menu-open @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-bullhorn"></i>
        <p>
            MTMS
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- <li class="nav-item">
            <a href="#" class="nav-link @if(Request::segment(2)=='transaction-fee') @endif">
                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                <p>Settlements</p>
            </a>
        </li> -->
        @can('transaction_fee_view')
        <li class="nav-item">
            <a href="{{route('transaction-fee.index')}}" class="nav-link @if(Request::segment(1)=='transaction-fee') active @endif">
                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                <p>Transaction Fee</p>
            </a>
        </li>
        @endcan
        <li class="nav-item">
            <a href="{{ route('transaction.index') }}" class="nav-link @if(Request::segment(1)=='transaction') active @endif">
                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                <p>Sender Transactions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('rec_transaction') }}" class="nav-link @if(Request::segment(1)=='rec_transaction') active @endif">
                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                <p>Receiver Transactions</p>
            </a>
        </li>
    </ul>
</li>
@endcan
