<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public function tempFile()
    {
        return $this->belongsTo(temp_file::class,'temp_id');
    }
    
    
  
}
