<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model {
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'DepartmentID';
    protected $fillable = ['CollegeID', 'DepartmentName', 'DepartmentCode', 'IsActive'];

    protected $dates = ['deleted_at']; 

    public function college() {
        return $this->belongsTo(College::class, 'CollegeID', 'CollegeID')->withTrashed(); 
    }
}
