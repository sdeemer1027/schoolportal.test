<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address','city','state','zip','county','lat','lon'];

    // Define any relationships, such as hasMany or belongsTo, here
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Define the relationship with classrooms
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
