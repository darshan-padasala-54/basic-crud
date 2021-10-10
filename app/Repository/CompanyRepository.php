<?php


namespace App\Repository;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;


class CompanyRepository implements CompanyRepositoryInterface
{
    const PER_PAGE = 10;
    public function get(){
        return Company::paginate(self::PER_PAGE);
    }

    public function create($data){
    	return Company::create($data);
    }

    public function update($data, $id){
        $company = Company::find($id);
        $company->company_name = $data['company_name'];
        $company->email = $data['email'];
        $company->website = $data['website'];
        if(!empty($data['logo'])){
            if (Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $company->logo = $data['logo'];
        }
        $company->save();
        return $company;
    }

    public function remove($id){
        return Company::find($id)->delete();
    }

    public function getAll(){
        return Company::get();
    }
}
