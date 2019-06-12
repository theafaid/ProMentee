<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fields\SetFieldsRequest;
use Illuminate\Http\Request;

class UserFieldsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('requiresFieldsNotSet');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Set education, entertainment fields for a authenticated user
     * @param SetFieldsRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(SetFieldsRequest $request)
    {
        return $request->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showSetFieldsPage(){
        return view('user.fields.set_fields', [
            'mainEduFields'   => resolve('Fields')->mainFields()['edu'],
            'mainEntmtFields' => resolve('Fields')->mainFields()['entmt'],
        ]);
    }
}
