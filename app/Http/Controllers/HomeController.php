<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware("fieldsSet:persist");
    }

    /**
     * Authenticated user will see home blade file
     * UnAuthenticated user will see a normal welcome page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(){
        return ! auth()->check() ? view('welcome') : view('home');
    }
}
