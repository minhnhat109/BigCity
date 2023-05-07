@extends('user.master_new')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Product</h3>
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid product-wrapper" id="app_home">
        <div class="product-grid">
            <div class="feature-products">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input v-model="searchName" type="text" class="form-control py-2"
                                placeholder="Enter the name room ..." aria-label="Enter the name room ..."
                                aria-describedby="search" v-on:keyup.enter="search()">
                            <button class="btn text-white px-5" type="button" id="search"
                                style="background-color: #003b95" v-on:click="search()">Search</button>
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <select v-model="selectCategory" class="form-select form-control py-2"
                            aria-label="Default select example" v-on:change="search()">
                            <option selected value="0">Category Room</option>
                            <template v-for="(value, key) in listCategory" >
                                <option v-bind:value="value.id">@{{value.name_room_category}}</option>
                            </template>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select v-model="selectPrice" class="form-select form-control py-2"
                            aria-label="Default select example" v-on:change="search()">
                            <option selected value="0">Price</option>
                            <option value="1">0 - 3 Million</option>
                            <option value="2">3 - 6 Million</option>
                            <option value="3">Over 6 Million</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="product-wrapper-grid">
                <div class="row">
                    <template v-for="(value, key) in listRoom">
                        <div class="col-xl-3 col-sm-6 xl-4">
                            <div class="card">
                                <div class="product-box">
                                    <div class="product-img">
                                        <img class="img-fluid" v-bind:src="value.image" alt="">
                                        <div class="product-hover">
                                            <ul>
                                                <li>
                                                    <a class="btn" type="button" v-bind:href="'/home/payment/'+value.id"
                                                        data-bs-original-title="" title=""><i
                                                            class="icon-shopping-cart"></i></a>
                                                </li>
                                                <li>
                                                    <a class="btn" type="button"
                                                        v-bind:href="'/home/room-detail/'+value.id"
                                                        data-bs-original-title="" title=""><i
                                                            class="icon-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenter" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="product-box row">
                                                        <div class="product-img col-lg-6"><img class="img-fluid"
                                                                v-bind:src=" value.image" alt=""></div>
                                                        <div class="product-details col-lg-6 text-start">
                                                            <h4>@{{ value.name }}</h4>
                                                            <div class="product-price">@{{ value.price }}</div>
                                                            <div class="product-view">
                                                                <h6 class="f-w-600">Product Details</h6>
                                                                <p class="mb-0" v-html="value.short_description"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close" data-bs-original-title="" title=""></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="product-details">
                                        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </div>
                                        <h4><a v-bind:href="'/home/room-detail/'+value.id">@{{ value.name }}</a></h4>
                                        <p v-html="value.short_description"></p>
                                        <div class="product-price">@{{ formatNumber(value.price) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app_home',
            data: {
                listRoom: [],
                listCategory: [],
                selectPrice: 0,
                selectCategory: 0,
                searchName: "",
            },
            created() {
                this.loadRoom();
                this.loadCategory();
            },
            methods: {
                loadRoom() {
                    axios
                        .get('/home/get-data-room')
                        .then((res) => {
                            this.listRoom = res.data.data;
                            console.log(this.listRoom);
                        });
                },
                search() {
                    var payload = {
                        'name': this.searchName,
                        'id_category': this.selectCategory,
                        'price': this.selectPrice,
                    };
                    axios
                        .post('/home/search', payload)
                        .then((res) => {
                            this.listRoom = res.data.data;
                            console.log(this.listRoom);
                        });
                },
                formatNumber(number) {
                    return new Intl.NumberFormat('vi-VI', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number);
                },
                loadCategory() {
                    axios
                        .get('/home/get-data-category')
                        .then((res) => {
                            this.listCategory = res.data.data;
                            // var content = '';
                            // $.each(category, function(key, value) {
                            //     content += '<option value="' + value.id + '">' + value
                            //         .name_room_category + '</option>'
                            // });
                            // $("#selectCategory").append(content);
                        });
                },
            },

        });
    </script>
@endsection
