@extends('user.master')
@section('title')
    Home
@endsection
@section('content')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input id="searchName" type="text" class="form-control py-2" placeholder="Enter the name room ..."
                    aria-label="Enter the name room ..." aria-describedby="search">
                <button class="btn text-white px-5" type="button" id="search"
                    style="background-color: #003b95">Search</button>
            </div>
        </div>
        <div class="col-md-3">
            <select id="selectCategory" class="form-select py-2" aria-label="Default select example">
                <option selected value="0">Category Room</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="selectPrice" class="form-select py-2" aria-label="Default select example">
                <option selected value="0">Price</option>
                <option value="1">0 - 3 Million</option>
                <option value="2">3 - 6 Million</option>
                <option value="3">Over 6 Million</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="container px-4 px-lg-5 mt-5">
            <div id="listRoom" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
            </div>
            <div class="row" id="noResult">

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

            function formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            }

            loadCategory()

            function loadCategory() {
                $.ajax({
                    url: '/home/get-data-category',
                    type: 'get',
                    success: function(res) {
                        var category = res.data;
                        var content = '';
                        $.each(category, function(key, value) {
                            content += '<option value="' + value.id + '">' + value
                                .name_room_category + '</option>'
                        });
                        $("#selectCategory").append(content);
                    },
                });
            }

            search()

            function search() {
                var payload = {
                    'name': $('#searchName').val(),
                    'id_category': $('#selectCategory').val(),
                    'price': $('#selectPrice').val(),
                };
                $.ajax({
                    url: '/home/search',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        var content = '';
                        if (res.status) {
                            var room = res.data;
                            $.each(room, function(key, value) {
                                content += inforRoom(value)
                            });
                            $("#noResult").html("");
                            $("#listRoom").html(content);
                        } else {
                            $("#listRoom").html("");
                            content += noResult()
                            $("#noResult").html(content);
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            }

            $('#search').click(function() {
                search()
            });

            $('#selectCategory').change(function() {
                search()
            });

            $('#selectPrice').change(function() {
                search()
            });

            function inforRoom(value) {
                content = ""
                content += '<div class="col mb-5">'
                content += '<div class="card h-100">'
                content += '<img class="card-img-top" src="' + value.image +
                    '" alt="..." style="width: 367px; height: 244px;"/>'
                content += '<div class="card-body p-4">'
                content += '<div class="text-start">'
                content += '<h5 class="fw-bolder">' + value.name + '</h5>'
                content += '<h5 class="text-start">Price: ' + formatNumber(value.price) + '</h5>'
                content += '<div class="">'
                content += '<span class="text-start">' + value.short_description + '</span>'
                content += '</div>'
                content += '</div>'
                content += '</div>'
                content += '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">'
                content +=
                    '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/home/room-detail/' +
                    value.id + '">View details</a>'
                content += '</div>'
                content += '</div>'
                content += '</div>'
                content += '</div>'
                return content
            }

            function noResult() {
                content = ""
                // content += '<div class="col text-center">'
                content += '<div class="shopee-search-empty-result-section text-center" >'
                content += '<img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/a60759ad1dabe909c46a817ecbf71878.png"'
                content += 'class="shopee-search-empty-result-section__icon">'
                content += '<div class="shopee-search-empty-result-section__title">No result is found</div>'
                content += '<div class="shopee-search-empty-result-section__hint">Try using more generic keywords</div>'
                content += '</div>'
                // content += '</div>'
                return content
            }
        });
    </script>
@endsection
