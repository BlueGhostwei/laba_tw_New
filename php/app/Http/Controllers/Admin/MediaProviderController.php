<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class MediaProviderController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    /**
     * @return mixed
     */
    public function Event_list(){
      return view('Admin.vider.event_list');
    }

    /**
     * @return mixed
     */
    public function user_center(){
        return view('Admin.vider.user_index');
    }

    public function Bill_query()
    {
        return view('Admin.vider.bll_query');
    }



}
