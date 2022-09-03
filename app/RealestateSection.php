<?php
// MODELO PARA MANEJAR LA HOMEPAGE DE REALESTATE
namespace App;

use Illuminate\Database\Eloquent\Model;

class RealestateSection extends Model
{
    protected $fillable=[
        'header','description','show_homepage','section_name','content_quantity','icon'
    ];
}
