<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js" defer></script>
<script type="text/javascript">
    var table;
    $(function() {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction.index') }}",
            columns: [{
                    data: 'transaction_code',
                    name: 'transaction_code'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'sender',
                    name: 'sender'
                },
                {
                    data: 'receiver',
                    name: 'receiver'
                },
                {
                    data: 'receiver_branch.name',
                    name: 'receiver_branch.name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
    $(document).on('click', '.approve_rec', function() {
        var id = $(this).data('id');
        var action = $(this).data('action');
        Swal.fire({
            title: "Are you sure?",
            text: "You are going to take action on this record!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: action,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Updated!",
                            text: "Record has been updated.",
                            icon: "success"
                        });
                        table.ajax.reload();
                    },
                    error: function() {                        
                        alert("hye");
                    },
                });
            } else {}
        });
    });

    function fetch_trans_fee(element) {
        let branchId = $(element).val();
        if (branchId) {
            $.ajax({
                url: "{{ url('transaction-fee-by-branch') }}/" + branchId,
                type: 'GET',
                success: function(data) {
                    $('input[name="transaction_fee_percent"]').val(data.fee);
                },
            });
        } else {
            $('input[name="transaction_fee_percent"]').val(0);
        }

    }
    $(document).on('change', '#transaction_amount', function() {
        let amount = parseFloat($(this).val());
        let feePercent = parseFloat($('input[name="transaction_fee_percent"]').val());
        if (!isNaN(amount) && !isNaN(feePercent)) {
            let feeAmount = (amount * feePercent) / 100;
            $('#transaction_fee').val(feeAmount.toFixed(2));
        } else {
            $('#transaction_fee').val(0);
        }
    });

    function edit_trans(thisVal) {
        var mdl = $(thisVal).attr("data-modal");
        $("#" + mdl).modal();
        let action = $(thisVal).attr("data-action");
        $.ajax({
            url: action,
            dataType: "JSON",
            success: function(data) {
                for (i = 0; i < Object.keys(data).length; i++) {
                    $("#form input[name~='" + Object.keys(data)[i] + "']").val(Object.values(data)[i]);
                    $("#form select[name~='" + Object.keys(data)[i] + "']").val(Object.values(data)[i]);
                    $("#form textarea[name~='" + Object.keys(data)[i] + "']").val(Object.values(data)[i]);
                    console.log(data.sender_details.sender_name);
                    $("#form .sender_name").val(data.sender_details.sender_name);
                    $("#form .sender_mobile").val(data.sender_details.sender_mobile);
                    $("#form .sender_location").val(data.sender_details.sender_location);
                    $("#form .receiver_name").val(data.receiver_details.receiver_name);
                    $("#form .receiver_mobile").val(data.receiver_details.receiver_mobile);
                    $("#form .receiver_location").val(data.receiver_details.receiver_location);
                }
                $('.select2').select2();
            }
        });
    }
</script>