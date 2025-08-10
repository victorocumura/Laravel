<div>
    <h2 class="text-lg font-bold mb-4">Criar Novo Artigo</h2>

    @if (session()->has('mensagem'))
        <div class="bg-green-200 p-2 mb-3">
            {{ session('mensagem') }}
        </div>
    @endif

    <form wire:submit.prevent="salvar">
        <div class="mb-3">
            <label for="titulo" class="block">Título</label>
            <input type="text" id="titulo" wire:model="titulo" class="border p-1 w-full">
            @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="conteudo" class="block">Conteúdo</label>
            <textarea id="conteudo" wire:model="conteudo" class="border p-1 w-full"></textarea>
            @error('conteudo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Salvar</button>
    </form>
</div>
