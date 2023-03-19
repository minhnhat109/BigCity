<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BigCity</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets_user/assets/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="/assets/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Sign in Start -->
    <section class="sign-in-page">
        <div class="container bg-white mt-5 p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center">
                    <div class="sign-in-from">
                        <h1 class="mb-0 dark-signin">Login</h1>
                        <p>Enter your email address and password to access admin panel.</p>
                        <form class="mt-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control mb-0" id="email" name="email"
                                    placeholder="Enter your email or phone number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control mb-0" id="password" name="password"
                                    placeholder="Enter password">
                                <span id="checkpassword"></span>
                            </div>
                            <div class="d-inline-block w-100">
                                <button type="button" id="login"
                                    class="btn btn-primary float-right ml-3">Login</button>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span>Not a member? <a href="/register">Register </a></span>
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
    <!-- Sign in END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- Appear JavaScript -->
    <script src="/assets/js/jquery.appear.js"></script>
    <!-- Countdown JavaScript -->
    <script src="/assets/js/countdown.min.js"></script>
    <!-- Counterup JavaScript -->
    <script src="/assets/js/waypoints.min.js"></script>
    <script src="/assets/js/jquery.counterup.min.js"></script>
    <!-- Wow JavaScript -->
    <script src="/assets/js/wow.min.js"></script>
    <!-- Apexcharts JavaScript -->
    <script src="/assets/js/apexcharts.js"></script>
    <!-- Slick JavaScript -->
    <script src="/assets/js/slick.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="/assets/js/select2.min.js"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="/assets/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="/assets/js/smooth-scrollbar.js"></script>
    <!-- Chart Custom JavaScript -->
    {{-- <script src="/assets/js/chart-custom.js"></script> --}}
    <!-- Custom JavaScript -->
    <script src="/assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#login").click(function() {
                var payload = {
                    'email': $("#email").val(),
                    'password': $("#password").val(),
                };
                $.ajax({
                    url: '/login',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success("Login Successful");
                            window.setTimeout(() => {
                                window.location.href = "/home";
                            }, 500);
                        } else {
                            toastr.error('Login failed!');
                            $("#checkpassword").text(
                                "The password does not exist or you entered it incorrectly");
                            $("#checkpassword").addClass("text-danger");
                            $("#password").addClass("border border-danger");
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

            $('#password').keyup(function(e) {
                if (e.keyCode == 13) {
                    $("#login").click()
                }
            });
        });
    </script>
</body>

</html>
