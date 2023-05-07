@extends('user.master_new')
@section('content')
    <div class="" style="margin-bottom: 470px">
        <h3 class="text-center mt-100">You have successfully paid</h3>
        <input id="room_id" hidden type="text" value="{{ $room_id }}">
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

            createPayment()
            function createPayment() {
                var payload = {
                    'room_id': $('#room_id').val(),
                };
                $.ajax({
                    url: '/home/create-payment',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            window.location = '/home';
                        } else {
                            window.location = '/home/payment/' + payload.room_id;
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
        });
    </script>
@endsection
