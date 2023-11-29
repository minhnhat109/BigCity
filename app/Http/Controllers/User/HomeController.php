<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Landlord;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view('user.pages_new.home_new');
    }
    // public function test(){
    //     return view('user.master_new');
    // }
    // public function test1(){
    //     return view('user.pages.home_new');
    // }
    public function getDataRoom(){
        $room = Room::where('is_open', 1)->get();
        return response()->json([
            'data'  => $room,
        ]);
    }

    public function getDataCategory(){
        $category = RoomCategory::where('is_open', 1)->get();
        return response()->json([
            'data'  => $category,
        ]);
    }

    public function viewRoomDetail($id){
        $room = Room::where('is_open', 1)
                    ->where('id', $id)
                    ->first();
        return view('user.pages_new.room_detail', compact('room'));
    }

    public function search(Request $request){
        $room = Room::query();
        if($request->name != "") {
            $room = $room->where('name', 'like' , '%' . $request->name . '%');
        }
        if($request->id_category > 0) {
            $room = $room->where('id_category', $request->id_category);
        }
        switch ($request->price) {
            case 1 :
                $room = $room->where('price', '<=', '3000000');
                break;
            case 2 :
                $room = $room->where('price', '<=', '6000000');
                $room = $room->where('price', '>', '3000000');
                break;
            case 3 :
                $room = $room->where('price', '>', '6000000');
                break;
        };
        $room = $room->where('is_open', 1)->get();
        if (count($room) > 0) {
            return response()->json([
                'data'  => $room,
                'status'  => true,
            ]);
        }
    }

    public function viewPayment($id){
        $room = Room::where('is_open', 1)
                    ->where('id', $id)
                    ->first();
        return view('user.pages_new.payment', compact('room'));
    }
    public function viewBlog(){
        return view('user.pages_new.blog');
    }

    public function getDataBlog(){
        $blog = Blog::where('is_open', 1)->get();
        return response()->json([
            'data'  => $blog,
        ]);
    }

    public function viewBlogDetail($id){
        $blog = Blog::where('is_open', 1)
                    ->where('id', $id)
                    ->first();
        return view('user.pages_new.blog_detail' ,compact("blog"));
    }

}
