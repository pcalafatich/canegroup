<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    protected $fillable=[
        'modelo','page_name','slug','description','status','seo_title','seo_description'
    ];
}
