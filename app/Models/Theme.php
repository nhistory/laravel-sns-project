<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    //relationship methods to return related data
    function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
    function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
