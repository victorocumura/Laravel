<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Artigo;

class ArtigoCreate extends Component
{
    public $titulo;
    public $conteudo;

    protected $rules = [
        'titulo' => 'required|min:3',
        'conteudo' => 'required|min:5',
    ];

    public function salvar()
    {
        $this->validate();

        Artigo::create([
            'titulo' => $this->titulo,
            'conteudo' => $this->conteudo,
        ]);

        session()->flash('mensagem', 'Artigo criado com sucesso!');

        // Limpa os campos após salvar
        $this->reset(['titulo', 'conteudo']);
    }

    public function render()
    {
        return view('livewire.artigo-create');
    }
}
