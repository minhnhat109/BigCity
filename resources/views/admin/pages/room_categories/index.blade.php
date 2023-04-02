@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-4">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Create Room Category</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                    <form id="create" class="form theme-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Name Room Category</label>
                                        <input class="form-control" id="name_room_category" name="name_room_category" type="text"
                                            placeholder="Input name room category">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Slug Room Category</label>
                                        <input class="form-control" id="slug_room_category" name="slug_room_category" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="is_open" id="is_open" class="form-control">
                                            <option value=1>Active</option>
                                            <option value=0>Block</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button id="createRoomCategory" class="btn btn-primary btn-lg" type="button">Create</button>
                            <input class="btn btn-danger btn-lg" type="reset" value="Cancel">
                        </div>
                    </form>
                </div>
             </div>
    </div>
    <div class="col-md-8">
        <div class="iq-card">
            <div class="iq-card-header">
                <h5>Room Category List</h5>
            </div>
            <div class="iq-card-body">
                <table class="table table-bordered" id="listRoomCategory">
                    <thead>
                       <tr class="text-center align-middle">
                          <th><strong>#</strong></th>
                          <th><strong>Name Room Category</strong></th>
                          <th><strong>Status</strong></th>
                          <th><strong>Action</strong></th>
                       </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Update Room Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="text" name="" id="id_room_category_edit" hidden>
            <div class="mb-3">
                <label class="form-label">Name Room Category</label>
                <input class="form-control" id="name_room_category_edit" type="text"
                    placeholder="Input name room category">
            </div>
            <div class="mb-3">
                <label class="form-label">Slug Room Category</label>
                <input class="form-control" id="slug_room_category_edit" name="slug_room_category" type="text"
                    placeholder="Input slug room category">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_open" id="is_open_edit" class="form-control">
                    <option value=1>Active</option>
                    <option value=0>Block</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
          <button id="updateRoomCategory" class="btn btn-primary" type="button" data-dismiss="modal">Save changes</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Delete Room Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="text" id="id_room_category_delete" hidden>
            <div class="alert text-white bg-danger" role="alert">
                <div class="iq-alert-icon">
                   <i class="ri-information-line"></i>
                </div>
                <div class="iq-alert-text">
                    <p>Are you sure you want to delete this room type?.</p>
                <p class="mb-0"><i>Note: Action cannot be undone</i>.</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
          <button id="deleteRoomCategory" class="btn btn-primary" type="button" data-dismiss="modal">Save</button>
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

            $("#name_room_category").keyup(function() {
                var slug = converToSlug($("#name_room_category").val());
                $("#slug_room_category").val(slug);
            });

            $("#name_room_category_edit").keyup(function() {
                var slug = converToSlug($("#name_room_category_edit").val());
                $("#slug_room_category_edit").val(slug);
            });

            $("#createRoomCategory").click(function(){
                var roomCategory = {
                    'name_room_category'                : $("#name_room_category").val(),
                    'slug_room_category'               : $("#slug_room_category").val(),
                    'is_open'                       : $("#is_open").val(),
                };

                $.ajax({
                    url     :   '/admin/room-category',
                    type    :   'post',
                    data    :   roomCategory,
                    success :  function(res) {
                        if(res.status) {
                            toastr.success('Successfully added new category!');
                            $('#create').trigger("reset");
                            loadTable();
                        }
                    },
                    error   :   function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            $('body').on('click', '.updateStatus', function() {
                var room_category_id = $(this).data('id');
                $.ajax({
                    url         : '/admin/room-category/update-status/' + room_category_id,
                    type        : 'get',
                    success     : function(res) {
                        if (res.status) {
                            loadTable();
                            toastr.success("Updated catalog status!");
                        } else {
                            toastr.error("Error!!");
                        }
                    },
                });
            });

            $('body').on('click', '.edit', function() {
                var id_room_category = $(this).data('id');
                $.ajax({
                    url             : '/admin/room-category/edit/' + id_room_category,
                    type            : 'get',
                    success         : function(res) {
                        if (res.status) {
                            $("#id_room_category_edit").val(res.data.id);
                            $("#name_room_category_edit").val(res.data.name_room_category);
                            $("#slug_room_category_edit").val(res.data.slug_room_category);
                            $("#is_open_edit").val(res.data.is_open);
                        } else {
                            toastr.error('An error occurred !!!');
                        }
                    },
                });
            });

            $("#updateRoomCategory").click(function() {
                var roomCategory = {
                    'id'                            : $("#id_room_category_edit").val(),
                    'name_room_category'                : $("#name_room_category_edit").val(),
                    'slug_room_category'               : $("#slug_room_category_edit").val(),
                    'is_open'                       : $("#is_open_edit").val(),
                };
                $.ajax({
                    url             : '/admin/room-category/update',
                    type            : 'post',
                    data            : roomCategory,
                    success         : function(res) {
                        toastr.success("Room type updated successfully!");
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

            $("#deleteRoomCategory").click(function() {
                var id = $("#id_room_category_delete").val();
                $.ajax({
                    url           : '/admin/room-category/destroy/' + id,
                    type          : 'get',
                    success       : function(res) {
                        if (res.status) {
                            toastr.success("Deleted successfully!");
                            loadTable();
                        } else {
                            toastr.error("Does not exist!");
                        }
                    },
                });
            });

            $('body').on('click', '.delete', function() {
                var id_room_category = $(this).data('id');
                $("#id_room_category_delete").val(id_room_category);
            });


            loadTable();
            function loadTable() {
                $.ajax({
                    url     :   '/admin/room-category/get-data',
                    type    :   'get',
                    success :   function(res) {
                        var roomCategory = res.data; // 1 array
                        var contentTable = '';
                        $.each (roomCategory, function(key, value) {
                            contentTable += '<tr>';
                            contentTable += '<th class="text-center align-middle">'+ (key + 1) +'</th>';
                            contentTable += '<td class="text-nowrap align-middle">'+ value.name_room_category +'</td>';
                            contentTable += '<td class="text-nowrap text-center align-middle">';
                            if(value.is_open == 1) {
                                contentTable += '<button class="btn btn-primary updateStatus align-middle btn-block rounded-pill" data-id="' + value.id + '">Active</button>';
                            } else {
                                contentTable += '<button class="btn btn-danger updateStatus btn-block rounded-pill" data-id="' + value.id + '">Block</button>';
                            }
                            contentTable += '</td>';
                            contentTable += '<td class="text-nowrap text-center align-middle">';
                            contentTable += '<button class="btn btn-primary btn-lg edit align-middle rounded-pill mr-1" data-id="' + value.id + '" data-toggle="modal" data-target="#editModal">Edit</button>';
                            contentTable += '<button class="btn btn-danger btn-lg delete align-middle rounded-pill" data-id="' + value.id + '" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                            contentTable += '</td>';
                            contentTable += '</tr>';
                        });
                        $("#listRoomCategory tbody").html(contentTable);
                    },
                });
            }
        });
    </script>
@endsection
