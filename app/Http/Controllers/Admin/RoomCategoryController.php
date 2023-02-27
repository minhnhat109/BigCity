<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoaiPhong\CreateLoaiPhongRequest;
use App\Http\Requests\LoaiPhong\UpdateLoaiPhongRequest;
use App\Http\Requests\RoomCategory\CreateRoomCategoryRequest;
use App\Http\Requests\RoomCategory\UpdateRoomCategoryRequest;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    public function index()
    {
        return view('admin.pages.room_categories.index');
    }

    public function getData()
    {
        $roomCategory    = RoomCategory::all();
        return response()->json([
            'data'      => $roomCategory,
        ]);
    }
    public function updateStatus($id)
    {
        $roomCategory = RoomCategory::find($id);
        if ($roomCategory){
            $roomCategory->is_open = !$roomCategory->is_open;
            $roomCategory->save();

            return response()->json([
                'status' => true,
            ]);
        }else {
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function store(CreateRoomCategoryRequest $request)
    {
        $data = $request->all();
        RoomCategory::create($data);
        return response()->json([
            'status'    => 1,
        ]);
    }

    public function edit($id)
    {
        $roomCategory = RoomCategory::find($id);
        if ($roomCategory) {
            return response()->json([
                'status'    => true,
                'data'      => $roomCategory,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }

    public function update(UpdateRoomCategoryRequest $request)
    {
        $roomCategory = RoomCategory::find($request->id);
        $data = $request->all();
        $roomCategory->update($data);
    }

    public function destroy($id)
    {
        $roomCategory = RoomCategory::find($id);
        if ($roomCategory) {
            $roomCategory->delete();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }
}
