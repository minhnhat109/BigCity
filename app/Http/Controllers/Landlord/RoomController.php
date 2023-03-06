<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\CreateRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        return view('landlord.pages.room.index');
    }
    public function viewListRoom()
    {
        return view('landlord.pages.room.list_room');
    }

    public function getCategory()
    {
        $roomCategory = RoomCategory::where('is_open', 1)->get();
        return response()->json([
            'listRoomCategory' => $roomCategory
        ]);
    }
    public function getData()
    {
        $landlord = Auth::guard('landlord')->user();
        $room = Room::join('room_categories', 'rooms.id_category', 'room_categories.id')
                       ->where('id_landlord', $landlord->id)
                       ->select('rooms.*', 'room_categories.name_room_category')
                       ->get();
        return response()->json([
            'data'  => $room,
        ]);
    }


    public function store(CreateRoomRequest $request)
    {
        $landlord = Auth::guard('landlord')->user();
        $data = $request->all();
        $data['id_landlord'] = $landlord->id;
        Room::create($data);
        return response()->json([
            'status' => true,
            'mess' => 'Successfully added a new room!',
        ]);
    }

    public function updateStatus($id)
    {
        $room = Room::find($id);
        if ($room){
            $room->is_open = !$room->is_open;
            $room->save();

            return response()->json([
                'status' => true,
            ]);
        }else {
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function destroy($id)
    {
        $room = Room::find($id);
        if ($room) {
            $room->delete();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }

    public function edit($id)
    {
        $room = Room::find($id);
        if ($room) {
            return response()->json([
                'status'    => true,
                'data'      => $room,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }


    public function update(UpdateRoomRequest $request)
    {
        $room = Room::find($request->id);
        $data = $request->all();
        $room->update($data);
        return response()->json([
            'status' => true,
            'mess'   => 'Room update successful!',
        ]);
    }
}
