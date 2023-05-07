@extends('user.master_new')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Room Page</h3>
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
                        <li class="breadcrumb-item active">Room Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if (isset($room))
            <div>
                <div class="row product-page-main p-0">
                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-slider owl-carousel owl-theme owl-loaded owl-drag" id="sync1">
                                    <div class="owl-stage-outer">
                                        <img src="{{ $room->image }}" style="width: 470px;" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 xl-100">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-page-details">
                                    <h3>{{ $room->name }}</h3>
                                </div>
                                <div class="product-price">{{ number_format($room->price, 0) }} VNĐ
                                </div>
                                <hr>
                                <div>
                                    <table class="product-page-width">
                                        <tbody>
                                            <tr>
                                                <td> <b>Address &nbsp;&nbsp;&nbsp;:</b></td>
                                                <td>{{ $room->address }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <p>{!! $room->detail_description !!}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="product-title">share it</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-icon">
                                            <ul class="product-social">
                                                <li class="d-inline-block"><a href="#" data-bs-original-title=""
                                                        title=""><i class="fa fa-facebook"></i></a></li>
                                                <li class="d-inline-block"><a href="#" data-bs-original-title=""
                                                        title=""><i class="fa fa-google-plus"></i></a></li>
                                                <li class="d-inline-block"><a href="#" data-bs-original-title=""
                                                        title=""><i class="fa fa-twitter"></i></a></li>
                                                <li class="d-inline-block"><a href="#" data-bs-original-title=""
                                                        title=""><i class="fa fa-instagram"></i></a></li>
                                                <li class="d-inline-block"><a href="#" data-bs-original-title=""
                                                        title=""><i class="fa fa-rss"></i></a></li>
                                            </ul>
                                            <form class="d-inline-block f-right"></form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="product-title">Rate Now</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <div class="br-wrapper br-theme-fontawesome-stars"><select
                                                    id="u-rating-fontawesome" name="rating" autocomplete="off"
                                                    style="display: none;">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <div class="br-widget"><a href="#" data-rating-value="1"
                                                        data-rating-text="1" class="br-selected br-current"
                                                        data-bs-original-title="" title=""></a><a href="#"
                                                        data-rating-value="2" data-rating-text="2" data-bs-original-title=""
                                                        title=""></a><a href="#" data-rating-value="3"
                                                        data-rating-text="3" data-bs-original-title=""
                                                        title=""></a><a href="#" data-rating-value="4"
                                                        data-rating-text="4" data-bs-original-title=""
                                                        title=""></a><a href="#" data-rating-value="5"
                                                        data-rating-text="5" data-bs-original-title=""
                                                        title=""></a></div>
                                            </div><span>(250 review)</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="m-t-15 float-end">
                                    <a class="btn btn-success m-r-10" href="/home/payment/{{ $room->id }}"
                                        data-bs-original-title=""> <i class="fa fa-shopping-cart me-1"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-3 xl-cs-35 box-col-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- side-bar colleps block stat-->
                            <div class="filter-block">
                                <h4>Brand</h4>
                                <ul>
                                    <li>Clothing</li>
                                    <li>Bags</li>
                                    <li>Footwear</li>
                                    <li>Watches</li>
                                    <li>ACCESSORIES</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="collection-filter-block">
                                <ul class="pro-services">
                                    <li>
                                        <div class="media"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-truck">
                                                <rect x="1" y="3" width="15" height="13">
                                                </rect>
                                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </svg>
                                            <div class="media-body">
                                                <h5>Free Shipping </h5>
                                                <p>Free Shipping World Wide</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-clock">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <div class="media-body">
                                                <h5>24 X 7 Service </h5>
                                                <p>Online Service For New Customer</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-gift">
                                                <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                                <rect x="2" y="7" width="20" height="5">
                                                </rect>
                                                <line x1="12" y1="22" x2="12" y2="7">
                                                </line>
                                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                            </svg>
                                            <div class="media-body">
                                                <h5>Festival Offer </h5>
                                                <p>New Online Special Festival</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-credit-card">
                                                <rect x="1" y="4" width="22" height="16"
                                                    rx="2" ry="2"></rect>
                                                <line x1="1" y1="10" x2="23" y2="10">
                                                </line>
                                            </svg>
                                            <div class="media-body">
                                                <h5>Online Payment </h5>
                                                <p>Contrary To Popular Belief. </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- silde-bar colleps block end here-->
                    </div>
                </div> --}}
                </div>
            </div>
        @endif

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
        });
    </script>
@endsection
