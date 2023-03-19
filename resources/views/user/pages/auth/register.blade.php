<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BigCity</title>
    <link rel="icon" type="image/x-icon" href="/assets_user/assets/favicon.ico" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/typography.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <section class="sign-in-page">
        <div class="container bg-white mt-5 p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center">
                    <div class="sign-in-from">
                        <h1 class="mb-0 dark-signin">Register</h1>
                        <form class="mt-3 mb-4">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example8">Full Name</label>
                                <input type="text" id="full_name"
                                    class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example8">Email</label>
                                <input type="email" id="email"
                                    class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example8">Phone Number</label>
                                <input type="text" id="phone_number"
                                    class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example8">Password</label>
                                <input type="password" id="password"
                                    class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example8">Repeat Password</label>
                                <input type="password" id="re_password"
                                    class="form-control form-control-lg" />
                            </div>
                            <div class="d-inline-block w-100">
                                <button type="button" id="register"
                                    class="btn btn-primary float-right ml-3 px-4">Register</button>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span>Have already an account? <a href="/login">Login </a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="sign-in-detail text-white">
                        <h2 class="mb-3 text-white font-weight-bold">BigCity</h2>
                        <div class="slick-slider11" data-autoplay="true" data-loop="true" data-nav="false"
                            data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1"
                            data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                            <div class="item">
                                <img src="/assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Manage your orders</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content.</p>
                            </div>
                            <div class="item">
                                <img src="/assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Manage your orders</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content.</p>
                            </div>
                            <div class="item">
                                <img src="/assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Manage your orders</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.appear.js"></script>
    <script src="/assets/js/countdown.min.js"></script>
    <script src="/assets/js/waypoints.min.js"></script>
    <script src="/assets/js/jquery.counterup.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/apexcharts.js"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/smooth-scrollbar.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#register').click(function() {
                var payload = {
                    'email': $("#email").val(),
                    'full_name': $("#full_name").val(),
                    'phone_number': $("#phone_number").val(),
                    'password': $("#password").val(),
                    're_password': $("#re_password").val(),
                };

                $.ajax({
                    url: '/register',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        toastr.success("Registered successfully");
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 900);
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
</body>

</html>
