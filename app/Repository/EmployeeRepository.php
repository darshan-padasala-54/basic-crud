<?php


namespace App\Repository;


use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    const PER_PAGE = 10;
    public function get(){
        return Employee::with('company')->paginate(self::PER_PAGE);
    }

    public function create($data){
        return Employee::create($data);
    }

    public function update($data, $id)
    {
        $employee = Employee::find($id);
        $employee->fill($data);
        $employee->save();
        return $employee;
    }

    public function remove($id)
    {
        return Employee::find($id)->delete();
    }
}
