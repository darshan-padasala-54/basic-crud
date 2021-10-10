<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyPostRequest;
use App\Interfaces\CompanyRepositoryInterface;
use App\Mail\CompanyRegistered;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    protected $company;

    public function __construct(CompanyRepositoryInterface $company)
    {
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->company->get();
        return response()->json($companies);
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
    public function store(CompanyPostRequest $request)
    {
        $details = $request->post();
        if($request->logo){
            try{
                $logo = time().'.'.$request->logo->getClientOriginalExtension();
                Storage::disk('public')->put($logo, file_get_contents($request->file('logo')));
                $details['logo'] = $logo;
            }catch(\Exception $e){}
        }
        $company = $this->company->create($details);

        try{
            \Mail::to($company->email)->send(new CompanyRegistered());
        }catch(\Exception $e){}
        return response()->json([
            'message'=>'Company Created Successfully!!',
            'company'=>$company
        ]);
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
    public function edit(Company $company)
    {
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyPostRequest $request, $id)
    {
        $details = $request->post();
        if($request->logo){
            try{
                $logo = time().'.'.$request->logo->getClientOriginalExtension();
                Storage::disk('public')->put($logo, file_get_contents($request->file('logo')));
                $details['logo'] = $logo;
            }catch(\Exception $e){}
        }
        $company = $this->company->update($details, $id);
        return response()->json([
            'message'=>'Company Updated Successfully!!',
            'company'=>$company
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->company->remove($id);
        return response()->json([
            'message'=>'Company Deleted Successfully!!',
        ]);
    }

    public function getAll(){
        return response()->json([
            'data' => $this->company->getAll()
        ]);
    }
}
