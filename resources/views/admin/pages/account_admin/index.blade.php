@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <form id="formCreate">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Create Admin Account</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <span id="message_email"></span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Repeat password</label>
                                    <input type="password" id="re_password" name="re_password" class="form-control">
                                </div>
                                <div class="text-right">
                                    <button id="createAdmin" type="button" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="iq-card">
                <div class="iq-card-header">
                    <h4 class="">List of Admin Accounts</h4>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id=listAdmin class="table table-bordered ">
                            <thead>
                                <tr class="text-center">
                                    <th><b>#</b></th>
                                    <th><b>Full Name</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Status</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="" id="id" hidden>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="full_name_edit" name="full_name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_edit" name="email">
                        <span id="message_email"></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password_edit" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="password" id="re_password_edit" name="re_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_open" id="is_open_edit" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Block</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                    <button id="updateAccount" class="btn btn-primary" type="button" data-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Delete Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="" id="id_admin_delete" hidden>
                    <div class="alert alert-secondary" role="alert">
                        <div class="iq-alert-icon">
                            <i class="ri-information-line"></i>
                        </div>
                        <div class="iq-alert-text">Are you sure you want to <b>delete</b> this account?</div>

                    </div>
                    <div>
                        <h5>Note that it cannot be restored after deletion</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                    <button id="deleteAccount" class="btn btn-primary" type="button" data-dismiss="modal">Delete</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            $("#email").blur(function() {
                var payload = {
                    'email': $("#email").val(),
                };
                $.ajax({
                    url: '/admin/account-admin/check-email',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status == true) {
                            $("#message_email").html(
                                '<span class="text-danger">Email already exists</span>');
                        } else if (res.status == 3) {
                            $("#message_email").html(
                                '<span class="text-warning">Please fill in your Email</span>');
                        } else {
                            $("#message_email").html(
                                '<span class="text-primary">Email can be used</span>'
                                );
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            $("#createAdmin").click(function() {
                var payload = {
                    'email': $("#email").val(),
                    'full_name': $("#full_name").val(),
                    'password': $("#password").val(),
                    're_password': $("#re_password").val(),
                };

                $.ajax({
                    url: '/admin/account-admin',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        toastr.success("Successfully added new Admin account");
                        loadtable();
                        $("#formCreate").trigger("reset");
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            $('body').on('click', '.updateStatus', function() {
                var id = $(this).data('id');
                console.log(123);
                $.ajax({
                    url: '/admin/account-admin/update-status/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success("Updated status success!");
                            loadtable();
                        } else {
                            toastr.warning(res.message);
                        }
                    },
                });
            });

            loadtable();

            $("body").on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/admin/account-admin/edit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            $("#id").val(res.data.id);
                            $("#email_edit").val(res.data.email);
                            $("#full_name_edit").val(res.data.first_name + ' ' + res.data.last_name);
                            $("#is_open_edit").val(res.data.is_open);
                        } else {
                            toastr.error("Account does not exist!");
                        }
                    },
                });
            });

            $("#updateAccount").click(function() {
                var payload = {
                    "id": $("#id").val(),
                    "email": $("#email_edit").val(),
                    "full_name": $("#full_name_edit").val(),
                    "is_open": $("#is_open_edit").val(),
                };

                $.ajax({
                    url: '/admin/account-admin/update',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Updated success');
                            loadtable();
                        } else {
                            loadtable();
                            toastr.warning(res.message);
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            $("body").on('click', '.delete', function(){
                var id_admin = $(this).data('id');
                $("#id_admin_delete").val(id_admin);
            });

            $("#deleteAccount").click(function() {
                var id = $("#id_admin_delete").val();
                console.log(id);
                $.ajax({
                    url     :   '/admin/account-admin/destroy/' + id,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            toastr.success("Deleted Admin successfully!");
                            loadtable();
                        } else {
                            toastr.error("Admin does not exist!");
                        }
                    },
                });
            });

            function loadtable() {
                $.ajax({
                    url: '/admin/account-admin/get-data',
                    type: 'get',
                    success: function(res) {
                        var content = '';
                        $.each(res.data, function(key, value) {
                            content += '<tr class="text-center">';
                            content += '<td class="text-center">' + (key + 1) + '</td>';
                            content += '<td>' + value.first_name + ' ' + value.last_name + '</td>';
                            content += '<td>' + value.email + '</td>';
                            content += '<td>';
                            if (value.is_open == 1) {
                                content +=
                                    '<button class="btn btn-primary updateStatus text-nowrap" data-id="' +
                                    value.id + '">Active</button>';
                            } else {
                                content +=
                                    '<button class="btn btn-danger updateStatus text-nowrap" data-id="' +
                                    value.id + '">Block</button>';
                            }
                            content += '</td>';
                            content += '<td>';
                            content +=
                                '<button class="btn btn-primary edit text-nowrap" data-id="' +
                                value.id +
                                '" " style="margin-right: 10px"  data-toggle="modal" data-target="#editModal">Update</button>';
                            content +=
                                '<button class="btn btn-danger delete text-nowrap" data-id="' +
                                value.id +
                                '" style="margin-right: 10px" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                            content += '</td>';
                            content += '</tr>';
                        });
                        $("#listAdmin tbody").html(content);
                    }
                });
            }
        });
    </script>
@endsection
