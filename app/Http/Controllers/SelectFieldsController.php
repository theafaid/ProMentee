<?php

namespace App\Http\Controllers;

class SelectFieldsController extends Controller
{
    /**
     * Show select fields page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = auth()->user();

        return $user && ! $user->hasSetFields() ? view('select_fields') : abort(404) ;
    }
}
