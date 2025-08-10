<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Artigo') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">Formulário para criar um artigo</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 max-w-xl mx-auto">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artigos.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            @csrf

            <label for="titulo" class="block font-bold mb-1">Título:</label>
            <input type="text" id="titulo" name="titulo" required class="border rounded p-2 w-full mb-4" value="{{ old('titulo') }}">

            <label for="slug" class="block font-bold mb-1">Slug:</label>
            <input type="text" id="slug" name="slug" required class="border rounded p-2 w-full mb-4" value="{{ old('slug') }}">

            <label for="conteudo" class="block font-bold mb-1">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" required class="border rounded p-2 w-full mb-4 min-h-[100px]">{{ old('conteudo') }}</textarea>

            <label for="data_publicacao" class="block font-bold mb-1">Data de Publicação:</label>
            <input type="date" id="data_publicacao" name="data_publicacao" required class="border rounded p-2 w-full mb-4" value="{{ old('data_publicacao') }}">

            <label for="imagem_capa" class="block font-bold mb-1">Imagem de Capa:</label>
            <input type="file" id="imagem_capa" name="imagem_capa" accept="image/*" class="border rounded p-2 w-full mb-6">

            {{-- ✅ NOVO CAMPO PARA ASSOCIAR DESENVOLVEDORES --}}
            <label for="desenvolvedores" class="block font-bold mb-1">Desenvolvedores:</label>
            <select name="desenvolvedores[]" id="desenvolvedores" multiple class="border rounded p-2 w-full mb-6">
                @foreach($desenvolvedores as $desenvolvedor)
                    <option value="{{ $desenvolvedor->id }}" {{ in_array($desenvolvedor->id, old('desenvolvedores', [])) ? 'selected' : '' }}>
                        {{ $desenvolvedor->nome }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700 transition">Salvar</button>
        </form>

        <a href="{{ route('artigos.index') }}" class="text-center block mt-4">Voltar à Lista de Artigos</a>
    </div>
</x-app-layout>
