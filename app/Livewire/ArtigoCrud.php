<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artigo;
use App\Models\Desenvolvedor;
use Illuminate\Support\Str;

class ArtigoCrud extends Component
{
    use WithFileUploads;

    public $artigos;
    public $desenvolvedores;
    public $titulo;
    public $slug;
    public $conteudo;
    public $data_publicacao;
    public $imagem_capa;
    public $imagemPreview;
    public $desenvolvedoresSelecionados = [];
    public $artigo_id;

    public $isEditMode = false;

    public function mount()
    {
        $this->artigos = Artigo::with('desenvolvedores')->get();
        $this->desenvolvedores = Desenvolvedor::all();
    }

    public function render()
    {
        return view('livewire.artigo-crud', [
            'todosDesenvolvedores' => $this->desenvolvedores
        ]);
    }

    public function resetFields()
    {
        $this->titulo = '';
        $this->slug = '';
        $this->conteudo = '';
        $this->data_publicacao = '';
        $this->imagem_capa = null;
        $this->imagemPreview = null;
        $this->desenvolvedoresSelecionados = [];
        $this->artigo_id = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
            'imagem_capa' => 'nullable|image|max:2048',
            'desenvolvedoresSelecionados' => 'array'
        ]);

        $slug = Str::slug($this->titulo);

        $imagemPath = $this->imagem_capa
            ? $this->imagem_capa->store('artigos', 'public')
            : null;

        $artigo = Artigo::create([
            'titulo' => $this->titulo,
            'slug' => $slug,
            'conteudo' => $this->conteudo,
            'data_publicacao' => $this->data_publicacao,
            'imagem_capa' => $imagemPath,
        ]);

        $artigo->desenvolvedores()->sync($this->desenvolvedoresSelecionados);

        $this->artigos->prepend($artigo);
        session()->flash('message', 'Artigo criado com sucesso.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $artigo = Artigo::with('desenvolvedores')->findOrFail($id);

        $this->artigo_id = $artigo->id;
        $this->titulo = $artigo->titulo;
        $this->conteudo = $artigo->conteudo;
        $this->data_publicacao = $artigo->data_publicacao;
        $this->desenvolvedoresSelecionados = $artigo->desenvolvedores->pluck('id')->toArray();
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
            'imagem_capa' => 'nullable|image|max:2048',
            'desenvolvedoresSelecionados' => 'array'
        ]);

        $artigo = Artigo::findOrFail($this->artigo_id);

        $slug = Str::slug($this->titulo);

        if ($this->imagem_capa) {
            $imagemPath = $this->imagem_capa->store('artigos', 'public');
            $artigo->imagem_capa = $imagemPath;
        }

        $artigo->update([
            'titulo' => $this->titulo,
            'slug' => $slug,
            'conteudo' => $this->conteudo,
            'data_publicacao' => $this->data_publicacao,
        ]);

        $artigo->desenvolvedores()->sync($this->desenvolvedoresSelecionados);

        $this->artigos = Artigo::with('desenvolvedores')->get();
        session()->flash('message', 'Artigo atualizado com sucesso.');
        $this->resetFields();
    }

    public function delete($id)
    {
        $artigo = Artigo::findOrFail($id);
        $artigo->desenvolvedores()->detach();
        $artigo->delete();

        $this->artigos = Artigo::with('desenvolvedores')->get();

        session()->flash('message', 'Artigo removido com sucesso.');
    }
}
