<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'zip',

"type" ,
"city",
"typeb" ,
"statename",
"stateabv",
"code",
"lat",
"lng",
"country",
"status",
    ];

}
