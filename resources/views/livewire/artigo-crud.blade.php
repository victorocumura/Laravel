<div class="p-6">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="space-y-4">
        <div>
            <label class="block font-bold mb-1">Título:</label>
            <input type="text" wire:model="titulo" class="w-full border rounded p-2" />
            @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-bold mb-1">Conteúdo:</label>
            <textarea wire:model="conteudo" class="w-full border rounded p-2"></textarea>
            @error('conteudo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-bold mb-1">Data de Publicação:</label>
            <input type="date" wire:model="data_publicacao" class="w-full border rounded p-2" />
            @error('data_publicacao') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-bold mb-1">Imagem de Capa:</label>
            <input type="file" wire:model="imagem_capa" class="w-full" />
            @error('imagem_capa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($imagem_capa)
                <div class="mt-2">
                    <strong>Preview:</strong>
                    <img src="{{ $imagem_capa->temporaryUrl() }}" class="w-32 h-32 object-cover mt-1 rounded" />
                </div>
            @endif
        </div>

        <div>
            <label class="block font-bold mb-1">Desenvolvedores:</label>
            <select multiple wire:model="desenvolvedoresSelecionados" class="w-full border rounded p-2">
                @foreach($todosDesenvolvedores as $dev)
                    <option value="{{ $dev->id }}">{{ $dev->nome }} ({{ $dev->senioridade }})</option>
                @endforeach
            </select>
            @error('desenvolvedoresSelecionados') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEditMode ? 'Atualizar' : 'Salvar' }}
            </button>

            @if($isEditMode)
                <button type="button" wire:click="resetFields" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Cancelar
                </button>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <h2 class="text-xl font-bold mb-4">Artigos</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($artigos as $artigo)
            <div class="p-4 border rounded shadow">
                <h3 class="text-lg font-bold">{{ $artigo->titulo }}</h3>
                <p class="text-sm text-gray-600">{{ $artigo->data_publicacao }}</p>
                <p class="mt-2">{{ Str::limit($artigo->conteudo, 100) }}</p>

                <div class="mt-2 text-sm">
                    <strong>Devs:</strong>
                    @foreach($artigo->desenvolvedores as $dev)
                        <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">
                            {{ $dev->nome }}
                        </span>
                    @endforeach
                </div>

                <div class="mt-4 flex gap-2">
                    <button wire:click="edit({{ $artigo->id }})" class="text-blue-500">Editar</button>
                    <button wire:click="delete({{ $artigo->id }})" class="text-red-500">Excluir</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
