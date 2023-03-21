@extends('user.master')
@section('content')
    <div id="app-payment">
        <div class="checkout-area mt-3">
            <div class="container-fluid" style="margin-bottom: 270px">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="your-order">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <h3>Your transaction</h3>
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($room))
                                            @php
                                                $i = 1
                                            @endphp
                                            <tr>
                                                <th scope="row">{{$i++ }}</th>
                                                <td>{{ $room->name }}</td>
                                                <td>{{ number_format( $room->price, 0)}} VNĐ</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="text-end mt-4">
                                        <a href="/home/momo-payment/{{$room->id}}">
                                        <button style="background: #003b95; color:white; width: 200px"
                                        class="btn check_out mt-2 text-white">Payment with MOMO</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row mt-3 float-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
