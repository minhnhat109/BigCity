@extends('landlord.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="ml-3">List of Rooms</h4>
                <div class="card-body">
                    <table class="table table-bordered" id="listRoom">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Room Category</th>
                                <th scope="col">Price of a month</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white" id="exampleModalLabel">Delete Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_room_delete" hidden>
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-icon">
                       <i class="ri-information-line"></i>
                    </div>
                    <div class="iq-alert-text">
                        <p>Are you sure you want to delete this room?.</p>
                    <p class="mb-0"><i>Note: Action cannot be undone</i>.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
              <button id="deleteRoom" class="btn btn-primary" type="button" data-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-xl" id="editModal" tabindex="-1" role="dialog"   aria-hidden="true">
        <div class="modal-dialog modal-xl">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title">Update Room</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                <input type="text" name="" id="id_room_edit" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input tabindex="2" class="form-control" id="name_edit" name="name" type="text"
                                placeholder="Enter the name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Slug Name </label>
                            <input  class="form-control" id="slug_name_edit" name="slug_name" type="text">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Price of a month</label>
                            <input tabindex="3" class="form-control" id="price_edit" name="price" type="number"
                                placeholder="Enter the monthly price of the room">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select id="is_open_edit" class="form-control">
                                <option value=1>Active</option>
                                <option value=0>Block</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Room Category</label>
                            <select id="id_category_edit" name="id_category_edit" class="form-control">
                                <option value=0>Select room category</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <div class="input-group">
                                <input type="text" id="image_edit" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text lfm bg-primary lfm" data-input="image_edit" data-preview="edit_holder">Choose</span>
                                 </div>
                             </div>
                             <div id="edit_holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input tabindex="6" class="form-control" id="address_edit" name="address" type="text"
                            placeholder="Enter the address">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <textarea tabindex="7" class="form-control" id="short_description_edit" name="short_description" cols="30" rows="10" placeholder="Enter a short description of the room"></textarea>
                </div>
                <div class="col-md-12 mt-3">
                    <textarea tabindex="8" class="form-control" id="detail_description_edit" name="detail_description" cols="30" rows="10" placeholder="Enter a detailed description"></textarea>
                </div>
              </div>
              <div class="modal-footer ">
                 <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                 <button type="button" id="updateRoom" class="btn btn-primary " data-dismiss="modal">Update</button>
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
            CKEDITOR.replace('detail_description_edit');
            CKEDITOR.replace('short_description_edit');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            loadCategory();
            loadTable();

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

            $("#name_edit").keyup(function() {
                var slug = converToSlug($("#name_edit").val());
                $("#slug_name_edit").val(slug);
            });

            $('body').on('click', '.updateStatus', function() {
                var them_moi_phong_id = $(this).data('id');
                $.ajax({
                    url         : '/landlord/room/update-status/' + them_moi_phong_id,
                    type        : 'get',
                    success     : function(res) {
                        if (res.status) {
                            toastr.success("Updated room status!");
                            loadTable();
                        } else {
                            toastr.error("Error!!");
                        }
                    },
                });
            });

            $('body').on('click', '.delete', function() {
                var id_room = $(this).data('id');
                $("#id_room_delete").val(id_room);
            });

            $("#deleteRoom").click(function() {
                var id = $("#id_room_delete").val();
                $.ajax({
                    url           : '/landlord/room/destroy/' + id,
                    type          : 'get',
                    success       : function(res) {
                        if (res.status) {
                            toastr.success("Room deleted successfully!");
                            loadTable();
                        } else {
                            toastr.error("Room does not exist!");
                        }
                    },
                });
            });


            $('body').on('click', '.edit', function() {
                var id_room = $(this).data('id');
                console.log(id_room);
                $.ajax({
                    url             : '/landlord/room/edit/' + id_room,
                    type            : 'get',
                    success         : function(res) {
                        if (res.status) {
                            $("#id_room_edit").val(res.data.id);
                            $("#id_category_edit").val(res.data.id_category);
                            $("#name_edit").val(res.data.name);
                            $("#slug_name_edit").val(res.data.slug_name);
                            $("#address_edit").val(res.data.address);
                            $("#image_edit").val(res.data.image);
                            $("#price_edit").val(res.data.price);
                            CKEDITOR.instances['detail_description_edit'].setData(res.data.detail_description);
                            CKEDITOR.instances['short_description_edit'].setData(res.data.short_description);
                            $("#is_open_edit").val(res.data.is_open);
                        } else {
                            toastr.error('Error! An error occurred. Please try again later !!!');
                        }
                    },
                });
            });

            $("#updateRoom").click(function() {
                var room = {
                    'id'                    :               $("#id_room_edit").val(),
                    'id_category'               :               $("#id_category_edit").val(),
                    'name'               :               $("#name_edit").val(),
                    'slug_name'          :               $("#slug_name_edit").val(),
                    'address'     :               $("#address_edit").val(),
                    'id_landlord'            :               $("#id_landlord_edit").val(),
                    'image'              :               $("#image_edit").val(),
                    'price'             :               $("#price_edit").val(),
                    'detail_description'        :               CKEDITOR.instances['detail_description_edit'].getData(),
                    'short_description'       :               CKEDITOR.instances['short_description_edit'].getData(),
                    'is_open'               :               $("#is_open_edit").val(),
                };
                $.ajax({
                    url             : '/landlord/room/update',
                    type            : 'post',
                    data            : room,
                    success         : function(res) {
                        toastr.success("The room has been updated successfully!");
                        loadTable();
                    },
                    error   : function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function (key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            function formatNumber(number)
            {
                return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
            }

            function loadCategory()
            {
                $.ajax({
                    url     :   '/landlord/room/get-category',
                    type    :   'get',
                    success :   function(res) {
                        var contentCategory = '';
                        $.each(res.listRoomCategory, function(key, value) {
                            contentCategory += '<option value='+ value.id +'>' + value.name_room_category +'</option>'
                        });
                        $("#id_category").append(contentCategory);
                        $("#id_category_edit").append(contentCategory);
                    },
                });
            }

            function loadTable() {
                $.ajax({
                    url     :   '/landlord/room/get-data',
                    type    :   'get',
                    success :   function(res) {
                        var room = res.data;
                        var content = '';
                        $.each(room, function(key, value) {
                            content +='<tr class="align-middle">';
                            content +='<th class="text-center">'+(key+1)+'</th>';
                            content +='<td class="text-center">'+value.name+'</td>';
                            content +='<td class="text-center">'+value.name_room_category+'</td>';
                            content +='<td class="text-center">'+formatNumber(value.price)+'</td>';
                            content +='<td class="text-center">'+value.address+'</td>';
                            content +='<td class="text-center">';
                            if(value.is_open == 1) {
                                content += '<button class="btn btn-primary updateStatus" data-id="' + value.id + '">Active</button>';
                            } else {
                                content += '<button class="btn btn-danger updateStatus" data-id="' + value.id + '">Block</button>';
                            }
                            content +='</td>';
                            content +='<td class="text-center text-nowrap">';
                            content +='<button class="btn btn-primary edit" data-id="' + value.id + '" style ="margin-right : 10px;" data-toggle="modal" data-target="#editModal">Edit</button>';
                            content +='<button class="btn btn-danger delete" data-id="' + value.id + '" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                            content +='</td>';
                            content +='</tr>';
                        });
                        $("#listRoom tbody").html(content);
                    },
                });
            }
        });
    </script>
@endsection
