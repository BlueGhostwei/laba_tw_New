<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Request;

class CategoryController extends Controller
{
    /**
     *
     */
    public function index()
    {
         return view('Admin.category.from');
    }

    public function store(Request $request)
    {
      return view('Admin.category.store');
    }
    public function  show(){
        
        return view('Admin.category.show');
    }
}
