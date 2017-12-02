<?php

namespace App\Http\Controllers;

use App\Sms;
use Illuminate\Http\Request;

class SmsController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->message) && !empty($request->phone_number) && !empty($request->company_token)) {
            $sms = new Sms();
            $sms->message = $request->message;
            $sms->phone_number = $request->phone_number;
            $sms->status = 200;
            $sms->company_token = $request->company_token;
            $sms->tracking = $request->tracking;
            $sms->sent_date = date('Y/m/d');
            $sms->save();
            return response()->json($sms, 201);
        } else {
            return response()->json(['info' => 'PhoneNumber, Message or Company Token empty'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allSmsCompany(Request $request)
    {
        $sms = Sms::where('company_token', $request->company_token)->get();
        if (!empty($sms)) {
            return response()->json($sms, 200);
        }
        return response()->json([], 404);
    }

    public function statusSms(Request $request)
    {
        $sms = Sms::where('_id', $request->id)->first();
        if (!empty($sms)) {
            return response()->json($sms, 200);
        }
        return response()->json([], 404);
    }
}
