<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        background: #fff;
    }
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    .logo {
        max-width: 150px;
    }
    .print-btn {
        float: right;
        margin-bottom: 20px;
    }
    @media print {
        .print-btn {
            display: none;
        }
        body {
            margin: 0;
            padding: 0;
            font-size: 12pt;
            color: #000;
            background: #fff;
        }
        .invoice-box {
            box-shadow: none;
            border: none;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
    }
</style>
<div class="invoice-box">
    <button class="btn btn-primary print-btn" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" class="logo" alt="Logo">
                        </td>
                        <td style="text-align:right">
                            <h2>Transaction Invoice</h2>
                            <b>Date:</b> {{ $transaction->created_at->format('d M Y') }}<br>
                            <b>Transaction Code:</b> {{ $transaction->transaction_code }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <h4>Sender Details</h4>
                            @php $sender = json_decode($transaction->sender_details, true); @endphp
                            <b>Name:</b> {{ $sender['sender_name'] ?? '-' }}<br>
                            <b>Mobile:</b> {{ $sender['sender_mobile'] ?? '-' }}<br>
                            <b>Address:</b> {{ $sender['sender_address'] ?? '-' }}<br>
                        </td>
                        <td style="text-align:right">
                            <h4>Receiver Details</h4>
                            @php $receiver = json_decode($transaction->receiver_details, true); @endphp
                            <b>Name:</b> {{ $receiver['receiver_name'] ?? '-' }}<br>
                            <b>Mobile:</b> {{ $receiver['receiver_mobile'] ?? '-' }}<br>
                            <b>Address:</b> {{ $receiver['receiver_address'] ?? '-' }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <b>Amount:</b> {{ number_format($transaction->amount, 2) }}<br>
                <b>Status:</b> <span class="badge badge-info">{{ ucfirst($transaction->status) }}</span>
            </td>
            <td style="text-align:right">
                <b>Branch:</b> {{ $transaction->receiver_branch->name ?? '-' }}<br>
            </td>
        </tr>
    </table>
</div>
