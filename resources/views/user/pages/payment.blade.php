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
                                <div class="col-md-3" id="paypal-button"></div>
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
<script src="https://www.paypal.com/sdk/js?client-id=AaDaMtnqGNv_FD8yS8TPTEgUb6qtj4Zig1sotShtT_t9Fr6j5pTFgAYsuejig72WBtefLuaOdYgV0BDv&currency=USD"></script>
<script>
    paypal.Buttons({
        // Order is created on the server and the order id is returned
        createOrder() {
            return  fetch("/my-server/create-paypal-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    // use the "body" param to optionally pass additional order information
                    // like product skus and quantities
                    body: JSON.stringify({
                        cart: [{
                            sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                            quantity: "YOUR_PRODUCT_QUANTITY",
                        }, ],
                    }),
                })
                .then((response) => response.json())
                .then((order) => order.id);
        },
        // Finalize the transaction on the server after payer approval
        onApprove(data) {
            return fetch("/my-server/capture-paypal-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                })
                .then((response) => response.json())
                .then((orderData) => {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    alert(
                        `Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`
                        );
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  window.location.href = 'thank_you.html';
                });
        }
    }).render('#paypal-button');
</script>
@endsection
