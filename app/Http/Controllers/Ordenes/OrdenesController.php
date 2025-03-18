<?php

namespace App\Http\Controllers\Ordenes;

use App\Http\Controllers\Controller;
use App\Models\PurcharseOrde\PurcharseOrder;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrdenesController extends Controller
{
    public function index()
    {
        $user_level = Auth::user()->access_level_id;
        if ($user_level == 3) {
            return view('crm.orders.indexContable');
        }
        return view('crm.orders.index');
    }
    public function indexAll(){
        return view('crm.orders.indexAll');

    }

}
