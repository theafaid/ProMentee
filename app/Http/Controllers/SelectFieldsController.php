<?php

namespace App\Http\Controllers;

use App\Field;

class SelectFieldsController extends Controller
{
    /**
     * Show select fields page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = auth()->user();

        if(! $user->hasSetFields()){
            return view('select_fields', [
                'mainEduFields'   => Field::where('type', 'edu')->where('parent_id', null)->get(),
                'mainEntmtFields' => Field::where('type', 'entmt')->where('parent_id', null)->get()
            ]);
        }

        return abort(404);
    }
}
