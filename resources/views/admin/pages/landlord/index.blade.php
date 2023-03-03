@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Landlord Management</h4>
            </div>
            <div class="card-body">
                <table id="listLandlord" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            loadtable();

            $('body').on('click', '.updateStatus', function() {
                var id = $(this).data('id');
                $.ajax({
                    url         : '/admin/landlord/update-status/' + id,
                    type        : 'get',
                    success     : function(res) {
                        if (res.status) {
                            toastr.success("Status update successful!");
                            loadtable();
                        } else {
                            toastr.error("Error!!");
                        }
                    },
                });
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                console.log('asdasd '+ id);
                $.ajax({
                    url         : '/admin/landlord/destroy/' + id,
                    type        : 'get',
                    success     : function(res) {
                        if (res.status) {
                            toastr.success("Deleted successfully!");
                            loadtable();
                        } else {
                            toastr.error("Error!!");
                        }
                    },
                });
            });

            function loadtable(){
                $.ajax({
                    url     :   '/admin/landlord/get-data',
                    type    :   'get',
                    success :   function(res) {
                        var content = '';
                        $.each(res.data, function(key, value) {
                            content += '<tr class="text-center">';
                            content += '<th>'+(key + 1)+'</th>';
                            content += '<th>'+ value.first_name + ' ' + value.last_name +'</th>';
                            content += '<th>'+ value.email +'</th>';
                            content += '<th>'+ value.phone_number +'</th>';
                            content += '<th>'+ value.address +'</th>';
                            content += '<td>';
                            if(value.is_open==1){
                                content += '<button class="btn btn-primary updateStatus" data-id="' + value.id + '">Active</button>';
                            }else{
                                content += '<button class="btn btn-danger updateStatus" data-id="' + value.id + '">Block</button>';
                            }
                            content += '</td>';
                            content += '<td>';
                            content += '<button class="btn btn-danger delete" data-id="' + value.id + '">Delete</button>';
                            content += '</td>';
                            content += '</tr>';
                        });
                        $("#listLandlord tbody").html(content);
                    },
                });
            }


        });
    </script>
@endsection
