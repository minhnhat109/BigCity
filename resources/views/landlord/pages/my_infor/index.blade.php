@extends('landlord.master')
@section('content')
    <div class="card ">
        <div class="card-body">
            <div>
                <ul class="iq-edit-profile d-flex nav nav-pills">
                    <li class="col-md-6 p-0" id="change_capnhap">
                        <a class="nav-link active" data-toggle="pill">
                            Update information
                        </a>
                    </li>
                    <li class="col-md-6 p-0" id="change_password">
                        <a class="nav-link" data-toggle="pill">
                            Change Password
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="iq-card" id="update_password">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Change Password</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form>
                <div class="form-group">
                    <label>New Password:</label>
                    <input type="Password" class="form-control" id="password" value="">
                </div>
                <div class="form-group">
                    <label>Verify Password:</label>
                    <input type="Password" class="form-control" id="re_password" value="">
                </div>
                <div class="text-right">
                    <button type="button" class="btn bg-danger">Cancle</button>
                    <button type="button" class="btn btn-primary mr-2" id="changePass">Update</button>
                </div>
            </form>
        </div>
    </div>

    <input id="id" type="text" hidden>
    <div class="tab-pane fade active show" id="update_infor" role="tabpanel">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Update information</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <form>
                    <div id="test" class=" row align-items-center">
                        <input type="text" class="form-control" id="id" hidden>
                        <div class="form-group col-sm-6">
                            <label>Full Name</label>
                            <input type="text" class="form-control" id="full_name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" id="phone_number">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Address</label>
                            <input type="text" class="form-control" id="address">
                            </textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" id="reset" class="btn bg-danger">Cancle</button>
                        <button type="button" id="updateLandlord" class="btn btn-primary mr-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image', {
            prefix: '/laravel-filemanager'
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadInfo();

            function loadInfo() {
                $.ajax({
                    url: '/landlord/my-information/data',
                    type: 'get',
                    success: function(res) {
                        $("#id").val(res.data.id);
                        $("#email").val(res.data.email);
                        $("#full_name").val(res.data.first_name + ' ' + res.data.last_name);
                        $("#phone_number").val(res.data.phone_number);
                        $("#address").val(res.data.address);
                    },
                });
            };

            $("#update_password").hide();

            $("#change_capnhap").click(function() {
                $("#update_password").hide();
                $("#update_infor").show();
                $("#infor").hide();

            });

            $("#change_password").click(function() {
                $("#update_infor").hide();
                $("#infor").hide();
                $("#update_password").show();
            });

            $("#changePass").click(function() {
                var payload = {
                    'password': $("#password").val(),
                    're_password': $("#re_password").val(),
                };
                $.ajax({
                    url: '/landlord/my-information/change-password',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {

                            toastr.success('Changed Password Successfully');
                        } else {
                            toastr.error('An error has occurred');
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

            $("#updateLandlord").click(function() {
                var payload = {
                    "id": $("#id").val(),
                    "email": $("#email").val(),
                    "full_name": $("#full_name").val(),
                    "phone_number": $("#phone_number").val(),
                    "address": $("#address").val(),
                };
                $.ajax({
                    url: '/landlord/my-information/update',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Updated Successfully');
                        } else {
                            toastr.error('An error has occurred');
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

        });
    </script>
@endsection
