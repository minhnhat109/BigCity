@extends('user.master_new')
@section('head')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Profile</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home" data-bs-original-title="" title=""> <svg
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
                            <h4 class="card-title mb-0">Edit Profile</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i
                                        class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                                    data-bs-toggle="card-remove" data-bs-original-title="" title=""><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input hidden name="id" id="id">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-name">Name</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                id="full_name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-e-mail">Email</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="email" name="email" class="form-control"placeholder="Email"
                                                id="email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-phone">Phone</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="text" name="phone"
                                                class="form-control"placeholder="Phone number" id="phone_number" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" id="updateInfor" type="button" data-bs-original-title=""
                                title="">Update Profile</button>
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
            loadInfo();

            function loadInfo() {
                $.ajax({
                    url: '/home/get-data-my-account',
                    type: 'get',
                    success: function(res) {
                        $("#id").val(res.data.id);
                        $("#email").val(res.data.email);
                        $("#full_name").val(res.data.first_name + ' ' + res.data.last_name);
                        $("#phone_number").val(res.data.phone_number);
                    },
                });
            };
            $("#updateInfor").click(function() {
                var payload = {
                    "id": $("#id").val(),
                    "email": $("#email").val(),
                    "full_name": $("#full_name").val(),
                    "phone_number": $("#phone_number").val(),
                    "address": $("#address").val(),
                };
                $.ajax({
                    url: '/home/my-account/update',
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
