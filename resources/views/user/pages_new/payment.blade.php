@extends('user.master_new')
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Payment</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg></a></li>
                        <li class="breadcrumb-item"> Room Page</li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Your Transaction</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="order-history table-responsive wishlist">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Room Name</th>
                                            <th>Price</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($room))
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td><img class="img-fluid img-40" src="{{ $room->image }}" alt="#">
                                                </td>
                                                <td>
                                                    <div class="product-name">{{ $room->name }}</div>
                                                </td>
                                                <td>{{ number_format($room->price, 0) }} VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="total-amount">
                                                    <h6 class="m-0 text-end"><span class="f-w-600">Total Price :</span></h6>
                                                </td>
                                                <td><span>{{ number_format($room->price, 0) }} VNĐ</span></td>
                                            </tr>
                                            <tr>
                                                {{-- <td class="text-end" colspan="5"><a
                                                        class="btn btn-secondary cart-btn-transform" href="#">Continue
                                                        shopping</a></td> --}}
                                                <td colspan="6" class="text-end"><a class="btn btn-success cart-btn-transform text-end py-2" href="/home/momo-payment/{{$room->id}}">Payment with MOMO</a></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
