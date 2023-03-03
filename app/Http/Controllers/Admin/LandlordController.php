<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\CreateLandlordRequest;
use App\Http\Requests\Landlord\UpdateLandlordRequest;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordController extends Controller
{
    public function index()
    {
        return view('admin.pages.landlord.index');
    }

    public function getData()
    {
        $landlord = Landlord::all();
        return response()->json([
            'data'  => $landlord,
        ]);
    }

    public function updateStatus($id)
    {
        $admin = Landlord::find($id);

        if ($admin) {
            $admin->is_open = !$admin->is_open;
            $admin->save();

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
        $landlord = Landlord::find($id);
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

    public function edit()
    {
        $chu_tro = Auth::guard('chu_tro')->user();

        $data = Landlord::find($chu_tro->id);

        return response()->json([
            'data' => $data,
        ]);
    }
}
