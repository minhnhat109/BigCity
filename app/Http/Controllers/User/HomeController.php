<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('user.pages.home');
    }

    public function getDataRoom(){
        $room = Room::where('is_open', 1)->get();
        return response()->json([
            'data'  => $room,
        ]);
    }

    public function viewRoomDetail($id){
        $room = Room::where('is_open', 1)
                    ->where('id', $id)
                    ->first();
        return view('user.pages.room_detail', compact('room'));
    }
}
