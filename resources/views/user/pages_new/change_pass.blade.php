@extends('user.master_new')
@section('head')
@endsection
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Change Password</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html" data-bs-original-title="" title=""> <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg></a></li>
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <form class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Change Password</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i
                                        class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                                    data-bs-toggle="card-remove" data-bs-original-title="" title=""><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-old-password">Old Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input id="old_password" type="password"
                                                class="form-control"placeholder="Old Password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-new-password">New Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input id="password" type="password"
                                                class="form-control"placeholder="New Password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-retype-new-password">Confirm New
                                            Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input id="re_password" name="re_password" type="password"
                                                class="form-control"placeholder="New Password" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" id="changePass" type="button" data-bs-original-title=""
                                title="">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#changePass").click(function() {
                var payload = {
                    'old_password': $("#old_password").val(),
                    'password': $("#password").val(),
                    're_password': $("#re_password").val(),
                };
                $.ajax({
                    url: '/home/my-account/change-password',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status == 1) {
                            toastr.success('Changed Password Successfully');
                            $('#changePW').trigger("reset");
                        } else if (res.status == 0) {
                            toastr.error('An error has occurred');
                        } else {
                            toastr.error('Old password is incorrect');
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
