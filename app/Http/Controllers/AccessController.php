<?php

namespace App\Http\Controllers;

use App\Access;
use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company_token = $request->bearerToken();
        if(!empty($company_token)){
            $company = Company::where('company_token', $company_token)->first();
            if(!empty($company)){
                $acc = Access::where('date', date('Y/m/d'))
                    ->where('company_token', $company_token)
                    ->first();
                if(empty($acc)){
                    $acc = new Access();
                    $acc->company_token = $company->company_token;
                    $acc->date = date('Y/m/d');
                    $acc->api_token = bin2hex(random_bytes(60));
                    $acc->save();
                }
                $data = ['api_token' => $acc->api_token];
                return response()->json($data, 200);
            }
            return response()->json(['info' => 'Company not found', 
                'status' => 404], 200);
        }
        return response()->json(['info' => 'Invalid Bearer', 
            'status' => 400], 200);
        
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

    public function isValid($token){
        $acc = Access::where('api_token', $token)->first();

        if(!empty($acc)){
            return response()->json(['info' => 'Valid Token', 
            'status' => 200], 200);
        }else{
            return response()->json(['info' => 'Invalid Token', 
            'status' => 404], 404);
        }
    }
}
