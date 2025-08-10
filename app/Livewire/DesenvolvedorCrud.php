<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Desenvolvedor;
use Livewire\WithPagination;

class DesenvolvedorCrud extends Component
{
    use WithPagination;

    public $nome, $email, $senioridade, $skills, $devId;
    public $search = '';
    public $filtro = ''; // filtro que será usado para consulta

    protected function rules()
    {
        return [
            'nome' => 'required|min:3',
            'email' => $this->devId
                ? 'required|email|unique:desenvolvedores,email,' . $this->devId
                : 'required|email|unique:desenvolvedores,email',
            'senioridade' => 'required|in:Jr,Pl,Sr',
            'skills' => 'nullable|string',
        ];
    }

    public function filtrar()
    {
        $this->filtro = $this->search;
        $this->resetPage(); // volta para página 1 ao filtrar
    }

    public function render()
    {
        $query = Desenvolvedor::query();

        if ($this->filtro) {
            $query->where(function($query) {
                $query->where('nome', 'like', '%' . $this->filtro . '%')
                      ->orWhere('skills', 'like', '%' . $this->filtro . '%')
                      ->orWhere('senioridade', 'like', '%' . $this->filtro . '%');
            });
        }

        $desenvolvedores = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.desenvolvedor-crud', [
            'desenvolvedores' => $desenvolvedores
        ]);
    }

    public function store()
    {
        $this->validate();

        Desenvolvedor::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'senioridade' => $this->senioridade,
            'skills' => json_encode(array_map('trim', explode(',', $this->skills))),
        ]);

        session()->flash('message', 'Desenvolvedor criado com sucesso.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $dev = Desenvolvedor::findOrFail($id);
        $this->devId = $id;
        $this->nome = $dev->nome;
        $this->email = $dev->email;
        $this->senioridade = $dev->senioridade;
        $this->skills = implode(',', json_decode($dev->skills));
    }

    public function update()
    {
        $this->validate();

        $dev = Desenvolvedor::findOrFail($this->devId);
        $dev->update([
            'nome' => $this->nome,
            'email' => $this->email,
            'senioridade' => $this->senioridade,
            'skills' => json_encode(array_map('trim', explode(',', $this->skills))),
        ]);

        session()->flash('message', 'Desenvolvedor atualizado com sucesso.');
        $this->resetFields();
    }

    public function delete($id)
    {
        Desenvolvedor::findOrFail($id)->delete();
        session()->flash('message', 'Desenvolvedor deletado.');
    }

    public function resetFields()
    {
        $this->reset(['nome', 'email', 'senioridade', 'skills', 'devId']);
    }
}
