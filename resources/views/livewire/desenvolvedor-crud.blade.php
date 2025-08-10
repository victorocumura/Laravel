<div class="p-4">
    <input wire:model="search" type="text" placeholder="Buscar por nome, skill ou senioridade"
           class="border p-2 w-full mb-2"/>

    <button wire:click="filtrar"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
        Filtrar
    </button>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $devId ? 'update' : 'store' }}">
        <input wire:model="nome" type="text" placeholder="Nome" class="border p-2 w-full mb-2">
        <input wire:model="email" type="email" placeholder="Email" class="border p-2 w-full mb-2">
        <select wire:model="senioridade" class="border p-2 w-full mb-2">
            <option value="">Selecione a senioridade</option>
            <option value="Jr">Jr</option>
            <option value="Pl">Pl</option>
            <option value="Sr">Sr</option>
        </select>
        <input wire:model="skills" type="text" placeholder="Skills (ex: PHP,Laravel,JS)"
               class="border p-2 w-full mb-4">

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">{{ $devId ? 'Atualizar' : 'Cadastrar' }}</button>
    </form>

    <hr class="my-4"/>

    <table class="table-auto w-full">
        <thead>
        <tr class="bg-gray-200">
            <th>Nome</th>
            <th>Email</th>
            <th>Senioridade</th>
            <th>Skills</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($desenvolvedores as $dev)
            <tr>
                <td>{{ $dev->nome }}</td>
                <td>{{ $dev->email }}</td>
                <td>{{ $dev->senioridade }}</td>
                <td>
                    @foreach(json_decode($dev->skills) as $skill)
                        <span class="inline-block bg-gray-100 text-sm p-1 m-1">{{ $skill }}</span>
                    @endforeach
                </td>
                <td>
                    <button wire:click="edit({{ $dev->id }})" class="text-blue-500">Editar</button>
                    <button wire:click="delete({{ $dev->id }})" class="text-red-500 ml-2">Excluir</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $desenvolvedores->links() }}
</div>
