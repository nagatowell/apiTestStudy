<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $company = new Company();

        if( empty($request->company_name) && empty($request->company_email)){
            return response()->json(['status' => 400, 'info' => 'Invalid requests, check params'], 400);
        }
        
        $company_check = Company::where('company_email', $request->company_email)->first();
        if(!empty($company_check)){
            return response()->json($company, 200);
        }
        
        $company->company_name = $request->company_name;
        $company->company_email = $request->company_email;
        $company->company_token = bin2hex(random_bytes(60));
        $company->save();

        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::where('_id', $id)->first();
        if(empty($company)){
            return response()->json($company, 400);
        }
        return response()->json($company, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::where('_id', $id)->first();

        if( empty($request->company_name) && empty($request->company_email)){
            return response()->json(['status' => 400, 'info' => 'Invalid requests, check params'], 400);
        }

        if(empty($company)){
            return response()->json(['status' => 404, 'info' => 'Not Found'], 404);
        }
        $company->company_name = $request->company_name;
        $company->company_email = $request->company_email;
        $company->company_token = bin2hex(random_bytes(60));
        $company->save();

        return response()->json($company, 200);
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
}
