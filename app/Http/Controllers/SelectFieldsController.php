<?php

namespace App\Http\Controllers;

class SelectFieldsController extends Controller
{
    /**
     * Show select fields page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('select_fields');
    }
}
