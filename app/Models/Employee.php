<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone',
    ];

    public function company(){
        return $this->hasOne(company::class, 'company_id', 'company_id');
    }
}
