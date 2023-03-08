<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BigCity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }
    </style>
    @toastr_css
</head>

<body>
    <section class="h-100 bg-secondary">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                    alt="Sample photo" class="img-fluid"
                                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Register Landlord</h3>
                                    <form id="formSingUp">
                                        <div class="row">
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
                                                <label class="form-label" for="form3Example8">Address</label>
                                                <input type="text" id="address"
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

                                            <div class="d-flex justify-content-end pt-3">
                                                <button type="button" id="resetForm"
                                                    class="btn btn-danger btn-lg">Reset</button>
                                                <button id="registerLandlord" type="button"
                                                    class="btn btn-primary btn-lg ms-2">Register</button>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 text-center">
                                                    <span>Have already an account? <a href="/landlord/login">Login </a></span>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@jquery
@toastr_js
@toastr_render
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#resetForm').click(function() {
            $("#formSingUp").trigger("reset");
        });

        $('#registerLandlord').click(function() {
            var payload = {
                'email': $("#email").val(),
                'full_name': $("#full_name").val(),
                'phone_number': $("#phone_number").val(),
                'address': $("#address").val(),
                'password': $("#password").val(),
                're_password': $("#re_password").val(),
            };

            $.ajax({
                url: '/landlord/register',
                type: 'post',
                data: payload,
                success: function(res) {
                    toastr.success("Registered successfully");
                    setTimeout(() => {
                        window.location.href = '/landlord/login';
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

</html>
