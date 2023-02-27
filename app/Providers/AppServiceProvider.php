<?php

namespace App\Providers;

use App\Models\LoaiPhong;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        // $loaiPhong = LoaiPhong::where('is_open',1)->get();
        // View()->share('loaiPhong', $loaiPhong);
        // dd($loaiPhong);
    }
}
