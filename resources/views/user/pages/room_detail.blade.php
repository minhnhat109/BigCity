@extends('user.master')
@section('content')
    <div class="row" style="margin-bottom: 110px">
        @if (isset($room))
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <div class="h-100">
                <img class="card-img-top" src="{{ $room->image}}" alt="..." style="width: 450px; height: 300px;"/>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="">
                <h5 class="fw-bolder">{{$room->name}}</h5>
                <h5 class="text-start">Price: {{number_format($room->price, 0)}} VNĐ</h5>
                <div class="">
                   <span class="text-start">Address: {{$room->address}}</span>
                </div>
                <div>
                    <span class="text-start">{{$room->detail_description}}</span>
                 </div>
            </div>
            <div class="row p-4 mt-5 pt-0 border-top-0 bg-transparent">
                <div class="text-start"><a class="btn btn-outline-dark mt-auto" href="/home/payment/{{$room->id}}"  >Book now</a>
                </div>
            </div>
        </div>
        <div class="col-md-1">
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
