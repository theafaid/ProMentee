<?php

namespace App\Http\Controllers;

use App\Field;
use Illuminate\Support\Facades\Redis;

class SelectFieldsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show select fields page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = auth()->user();

        if(! $user->hasSetFields()){
            return view('select_fields', [
                'mainEduFields'   => json_decode(Redis::get('eduFields.all')),
                'mainEntmtFields' => json_decode(Redis::get('entmtFields.all'))
            ]);
        }

        return abort(404);
    }
}
