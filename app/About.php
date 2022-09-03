<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable=[
        'modelo','image','short_about','about','service','history'
    ];
}
