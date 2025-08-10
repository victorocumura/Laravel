<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artigo;

class Desenvolvedor extends Model
{
    protected $table = 'desenvolvedores';

    protected $fillable = [
        'nome',
        'email',
        'senioridade',
        'skills'
    ];

public function artigos()
{
    return $this->belongsToMany(Artigo::class, 'artigo_desenvolvedor', 'desenvolvedor_id', 'artigo_id');
}


}
