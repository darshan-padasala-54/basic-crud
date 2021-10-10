<?php

namespace App\Interfaces;


interface EmployeeRepositoryInterface
{
    public function get();

    public function create($data);

    public function update($data, $id);

    public function remove($id);
}
