<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Desenvolvedor;

class Artigo extends Model
{

    protected $table = 'artigos';


    protected $fillable = [
        'titulo',
        'slug',
        'conteudo',
        'data_publicacao',
        'imagem_capa'
    ];

     protected $casts = [
        'data_publicacao' => 'datetime',
    ];

public function desenvolvedores()
{
    return $this->belongsToMany(Desenvolvedor::class, 'artigo_desenvolvedor', 'artigo_id', 'desenvolvedor_id');
}


}
