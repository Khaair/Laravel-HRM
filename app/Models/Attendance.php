<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'clock_in', 'clock_out', 'date', 'status'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
