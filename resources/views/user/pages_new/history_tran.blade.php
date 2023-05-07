@extends('user.master_new')
@section('head')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>History Transaction</h3>
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
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <form class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">History Transaction</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i
                                        class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                                    data-bs-toggle="card-remove" data-bs-original-title="" title=""><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-hover table-bordered" id="listTransaction">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Room Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Date created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
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

            getTransaction();

            function getTransaction() {
                $.ajax({
                    url: '/home/get-data-transaction',
                    type: 'get',
                    success: function(res) {
                        content = ""
                        $.each(res.data, function(key, value) {
                            content += '<tr>'
                            content += '<th scope="row">' + (key + 1) + '</th>'
                            content += '<td>' + value.name + '</td>'
                            content += '<td>' + formatNumber(value.amount) + '</td>'
                            content += '<td>' + formatDate(value.created_at) + '</td>'
                            content += '</tr>'
                        });
                        $("#listTransaction tbody").html(content);
                    },
                });
            };

            function formatDate(date) {
                const [dateValues, timeValues] = date.split(' ');
                const newDate = new Date(dateValues);
                return newDate.toDateString();
            };
            function formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            };


        });
    </script>
@endsection
