<?php

namespace App\Interfaces;


interface CompanyRepositoryInterface
{
    public function get();

    public function create($data);

    public function update($data, $id);

    public function remove($id);

    public function getAll();
}
