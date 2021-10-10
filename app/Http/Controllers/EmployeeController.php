<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeePostRequest;
use App\Models\Employee;
use App\Repository\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct(EmployeeRepository $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employee->get();
        return response()->json($employees);
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
        $employee = $this->employee->create($request->post());
        return response()->json([
            'message'=>'Employee Added Successfully!!',
            'employee'=>$employee
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
    public function edit(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeePostRequest $request, $id)
    {
        $employee = $this->employee->update($request->post(), $id);
        return response()->json([
            'message'=>'Employee Updated Successfully!!',
            'employee'=>$employee
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
        $this->employee->remove($id);
        return response()->json([
            'message'=>'Employee Deleted Successfully!!',
        ]);
    }
}
