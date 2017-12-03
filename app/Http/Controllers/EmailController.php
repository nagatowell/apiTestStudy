<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = new Email();
        if(!empty($request->email) && !empty($request->message) && !empty($request->company_token)){
            $email->name = $request->name;
            $email->message = $request->message;
            $email->email = $request->email;
            $email->from = $request->from;
            $email->from_name = $request->from_name;
            $email->status = 200;
            $email->subject = $request->subject;
            $email->company_token = $request->company_token;
            $email->tracking = $request->tracking;
            $email->sent_date = date('Y/m/d');
            $email->save();

            return response()->json($email, 201);
        }else{
            return response()->json(['info' => 'Email, Message or Company Token empty'], 400);
        }
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

    public function allEmailCompany(Request $request){
        $email = Email::where('company_token', $request->company_token)->get();
        if (!empty($email)) {
            return response()->json($email, 200);
        }
        return response()->json([], 404);
    }

    public function statusEmail(Request $request){
        $email = Email::where('_id', $request->id)->first();
        if (!empty($email)) {
            return response()->json($email, 200);
        }
        return response()->json([], 404);
    }
}
