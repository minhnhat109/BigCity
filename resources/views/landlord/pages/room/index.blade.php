@extends('landlord.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input tabindex="2" class="form-control" id="name" name="name" type="text"
                                    placeholder="Enter the name room">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Slug Name</label>
                                <input  class="form-control" id="slug_name" name="slug_name" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Price of a month</label>
                                <input tabindex="3" class="form-control" id="price" name="price" type="number"
                                    placeholder="Enter the monthly price of the room">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Room Category</label>
                                <select  name="id_category" id="id_category" class="form-control">
                                    <option value=0>Select room category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="is_open" id="is_open" class="form-control">
                                    <option value=1>Active</option>
                                    <option value=0>Block</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input tabindex="6" class="form-control" id="address" name="address" type="text"
                                placeholder="Nhập vào Address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="input-group">
                                    <input type="text" id="image" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text lfm bg-primary lfm" data-input="image" data-preview="holder">Choose</span>
                                     </div>
                                 </div>
                                 <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Short description</label>
                            <textarea tabindex="7" class="form-control" id="short_description" name="short_description" cols="30" rows="10" placeholder="Nhập vào mô tả ngắn phòng trọ"></textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Detail description</label>
                            <textarea tabindex="8" class="form-control" id="detail_description" name="detail_description" cols="30" rows="10" placeholder="Nhập vào mô tả chi tiết"></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right mt-3" >
                        <button id="createRoom" class="btn btn-primary px-3 py-2" type="button">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('.lfm').filemanager('image', {prefix: '/laravel-filemanager'});
        var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
         $(document).ready(function() {
            CKEDITOR.replace('detail_description');
            CKEDITOR.replace('short_description');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            loadCategory();

            function converToSlug(str) {
                str = str.toLowerCase();
                str = str
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '');
                str = str.replace(/[đĐ]/g, 'd');
                str = str.replace(/([^0-9a-z-\s])/g, '');
                str = str.replace(/(\s+)/g, '-');
                str = str.replace(/-+/g, '-');
                str = str.replace(/^-+|-+$/g, '');
                return str;
            };

            $("#name").keyup(function() {
                var slug = converToSlug($("#name").val());
                $("#slug_name").val(slug);
            });

            function loadCategory()
            {
                $.ajax({
                    url     :   '/landlord/room/get-category',
                    type    :   'get',
                    success :   function(res) {
                        var contentLoaiPhong = '';
                        $.each(res.listRoomCategory, function(key, value) {
                            contentLoaiPhong += '<option value='+ value.id +'>' + value.name_room_category +'</option>'
                        });
                        $("#id_category").append(contentLoaiPhong);
                    },
                });
            }

            $('#createRoom').click(function(){
                var payload = {
                    'name'               : $('#name').val(),
                    'slug_name'          : $('#slug_name').val(),
                    'id_category'        : $('#id_category').val(),
                    'price'              : $('#price').val(),
                    'address'            : $('#address').val(),
                    'image'           : $('#image').val(),
                    'short_description'  : CKEDITOR.instances['short_description'].getData(),
                    'detail_description' : CKEDITOR.instances['detail_description'].getData(),
                    'is_open'               : $('#is_open').val(),
                };
                console.log(payload);
                $.ajax({
                    url     :   '/landlord/room',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        if(res.status){
                            toastr.success(res.mess);
                        }else{
                            toastr.error(res.mess);
                        }
                    },
                    error   : function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });
        });
    </script>
@endsection
