<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    /**
     * Authenticated user will see home blade file
     * UnAuthenticated user will see a normal welcome page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(){

        if($user = auth()->user()){
            return $user->hasSelectedFields() ? view('home') : redirect(route('selectFields'));
        }

        return view('welcome');
    }
}
