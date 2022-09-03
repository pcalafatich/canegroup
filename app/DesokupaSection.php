<?php
// MODELO PARA MANEJAR LA HOMEPAGE DE DESOKUPA
namespace App;

use Illuminate\Database\Eloquent\Model;

class DesokupaSection extends Model
{
    protected $fillable=[
        'header','description','show_homepage','section_name','content_quantity','icon'
    ];
}
