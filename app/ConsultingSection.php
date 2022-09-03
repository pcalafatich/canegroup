<?php
// MODELO PARA MANEJAR LA HOMEPAGE DE CONSULTING
namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultingSection extends Model
{
    protected $fillable=[
        'header','description','show_homepage','section_name','content_quantity','icon'
    ];
}
