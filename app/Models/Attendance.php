<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid', 
        'in_time',
        'out_time',
        'total_work_time',
        'attendance_status',
        'date',
    ];

  
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'uid');
    }
    
}
