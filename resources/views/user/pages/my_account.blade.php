@extends('user.master')
@section('head')
    {{-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> --}}
@endsection
@section('content')
    <div id="app-change" class="container-fluid">
        <div class="content-body pt-3">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                                    href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">General Information</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password"
                                    data-toggle="pill"href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Change Password</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-transaction"
                                    data-toggle="pill"href="#account-vertical-transaction" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">History Transaction</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card" style="margin-bottom: 290px">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                        aria-labelledby="account-pill-general" aria-expanded="true">
                                        <!-- form -->
                                        <form class="validate-form mt-2" id="updateUser">
                                            <div class="row">
                                                <input hidden name="id" id="id">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-name">Name</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="Name" id="full_name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">Email</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="email" name="email"
                                                                class="form-control"placeholder="Email" id="email" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-phone">Phone</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="text" name="phone"
                                                                class="form-control"placeholder="Phone number"
                                                                id="phone_number" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row text-end">
                                                    <div class="col-md-9"></div>
                                                    <div class="col-3">
                                                        <button id="updateInfor" type="button"
                                                            class="btn mt-2 mr-1 text-white"
                                                            style="background-color: #003b95;">Save changes</button>
                                                        <button type="reset"
                                                            class="btn btn-outline-secondary mt-2">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ general tab -->

                                    <!-- change password -->

                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                                        aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form" id="changePW">
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
                                            <div class="row text-end">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3">
                                                    <button type="button" id="changePass"
                                                        class="btn mr-1 mt-1 text-white"
                                                        style="background-color: #003b95;">Save changes</button>
                                                    <button type="reset"
                                                        class="btn btn-outline-secondary mt-1">Cancel</button>
                                                </div>
                                            </div>

                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->
                                    <div class="tab-pane fade" id="account-vertical-transaction" role="tabpanel"
                                        aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        <table class="table table-hover" id="listTransaction">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Room Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Date created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <!--/ form -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->

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

            getTransaction();
            function getTransaction() {
                $.ajax({
                    url: '/home/get-data-transaction',
                    type: 'get',
                    success: function(res) {
                        content = ""
                        $.each(res.data, function(key, value) {
                            content += '<tr>'
                            content += '<th scope="row">' + (key + 1) + '</th>'
                            content += '<td>'+ value.name+'</td>'
                            content += '<td>'+ value.amount+'</td>'
                            content += '<td>' + formatDate(value.created_at) + '</td>'
                            content += '</tr>'
                        });
                        $("#listTransaction tbody").html(content);
                    },
                });
            };

            function formatDate(date){
                const [dateValues, timeValues] = date.split(' ');
                const newDate = new Date(dateValues);
                return newDate.toDateString();
            }

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

            // $("#update_password").hide();

            // $("#change_infor").click(function() {
            //     $("#update_password").hide();
            //     $("#update_infor").show();
            //     $("#infor").hide();

            // });

            // $("#change_password").click(function() {
            //     $("#update_infor").hide();
            //     $("#infor").hide();
            //     $("#update_password").show();
            // });

        });
    </script>
@endsection
