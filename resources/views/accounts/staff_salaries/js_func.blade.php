<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js" defer></script>
<script type="text/javascript">
    var table;
    $(function() {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff-salaries.index') }}",
            columns: [{
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'branch.name',
                    name: 'branch.name'
                },
                {
                    data: 'staff.name',
                    name: 'staff.name'
                },
                {
                    data: 'payment_method',
                    name: 'payment_method'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'note',
                    name: 'note'
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
    function delete_rec(route){
        alert(route);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value==true) {
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#" + id).hide();
                    },
                });
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    }
</script>