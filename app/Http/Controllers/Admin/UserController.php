<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pages.user.index');
    }

    public function getData()
    {
        $user = User::all();
        return response()->json([
            'data'  => $user,
        ]);
    }

    public function updateStatus($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->is_open = !$user->is_open;
            $user->save();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'message'  => 'An error has occurred',
            ]);
        }
    }

    public function destroy($id)
    {
        $landlord = User::find($id);
        if ($landlord) {
            $landlord->delete();

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
