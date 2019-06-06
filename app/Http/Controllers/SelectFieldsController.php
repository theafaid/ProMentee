<?php

namespace App\Http\Controllers;

use App\Cacheable\CacheableFields;
use App\Eloquent\EloquentFields;
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
                'mainEduFields'   => json_decode((new CacheableFields(new EloquentFields))->mainEduFields()),
                'mainEntmtFields' => json_decode((new CacheableFields(new EloquentFields))->mainEduFields())
            ]);
        }

        return abort(404);
    }
}
