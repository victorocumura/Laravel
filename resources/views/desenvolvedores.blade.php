<div class="p-6 max-w-7xl mx-auto">

    <!-- Campo de busca -->
    <input 
        wire:model="search" 
        type="text" 
        placeholder="Buscar por nome, skill ou senioridade"
        class="border p-2 w-full mb-4 rounded"
    />

    <!-- Mensagem de sucesso -->
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulário criar/editar -->
    <form wire:submit.prevent="{{ $devId ? 'update' : 'store' }}" class="mb-6 space-y-4">
        <input 
            wire:model.defer="nome" 
            type="text" 
            placeholder="Nome" 
            class="border p-2 w-full rounded"
        >
        @error('nome') <span class="text-red-600">{{ $message }}</span> @enderror

        <input 
            wire:model.defer="email" 
            type="email" 
            placeholder="Email" 
            class="border p-2 w-full rounded"
        >
        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror

        <select wire:model.defer="senioridade" class="border p-2 w-full rounded">
            <option value="">Selecione a senioridade</option>
            <option value="Jr">Jr</option>
            <option value="Pl">Pl</option>
            <option value="Sr">Sr</option>
        </select>
        @error('senioridade') <span class="text-red-600">{{ $message }}</span> @enderror

        <input 
            wire:model.defer="skills" 
            type="text" 
            placeholder="Skills (ex: PHP,Laravel,JS)" 
            class="border p-2 w-full rounded"
        >
        @error('skills') <span class="text-red-600">{{ $message }}</span> @enderror

        <button 
            type="submit" 
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
        >
            {{ $devId ? 'Atualizar' : 'Cadastrar' }}
        </button>

        @if($devId)
            <button 
                type="button" 
                wire:click="resetFields" 
                class="ml-4 bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 transition"
            >
                Cancelar
            </button>
        @endif
    </form>

    <!-- Tabela listando os desenvolvedores -->
    <table class="min-w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">Nome</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Senioridade</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Skills</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($desenvolvedores as $dev)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $dev->nome }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $dev->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $dev->senioridade }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @foreach(json_decode($dev->skills) ?? [] as $skill)
                            <span class="inline-block bg-gray-200 text-sm px-2 py-1 rounded m-1">{{ $skill }}</span>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                        <button wire:click="edit({{ $dev->id }})" class="text-blue-600 hover:underline mr-3">Editar</button>
                        <button wire:click="delete({{ $dev->id }})" class="text-red-600 hover:underline" 
                            onclick="confirm('Confirma a exclusão?') || event.stopImmediatePropagation()"
                        >
                            Excluir
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                        Nenhum desenvolvedor encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $desenvolvedores->links() }}
    </div>
</div>
