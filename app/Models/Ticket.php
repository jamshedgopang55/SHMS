<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Attachment;

class Ticket extends Model
{
    use HasFactory;
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }

    public function images(){
        return $this->hasMany(Attachment::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function client()
    {
        return $this->belongsTo(client::class);
    }
    

}
