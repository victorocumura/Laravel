@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-center">Editar Artigo</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-6 max-w-xl mx-auto">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('artigos.update', $artigo->id) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <label for="titulo" class="block font-bold mb-1">Título:</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $artigo->titulo) }}" required class="border rounded p-2 w-full mb-4">

        <label for="slug" class="block font-bold mb-1">Slug:</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $artigo->slug) }}" required class="border rounded p-2 w-full mb-4">

        <label for="conteudo" class="block font-bold mb-1">Conteúdo:</label>
        <textarea id="conteudo" name="conteudo" required class="border rounded p-2 w-full mb-4 min-h-[100px]">{{ old('conteudo', $artigo->conteudo) }}</textarea>

        <label for="data_publicacao" class="block font-bold mb-1">Data de Publicação:</label>
        <input type="date" id="data_publicacao" name="data_publicacao" value="{{ old('data_publicacao', $artigo->data_publicacao ? $artigo->data_publicacao->format('Y-m-d') : '') }}" required class="border rounded p-2 w-full mb-4">

        <label for="imagem_capa" class="block font-bold mb-1">Imagem de Capa:</label>
        @if ($artigo->imagem_capa)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $artigo->imagem_capa) }}" alt="Imagem de capa" class="max-w-xs rounded shadow">
            </div>
        @endif
        <input type="file" id="imagem_capa" name="imagem_capa" accept="image/*" class="border rounded p-2 w-full mb-6">

        {{-- ✅ NOVO CAMPO: Desenvolvedores --}}
        <label for="desenvolvedores" class="block font-bold mb-1">Desenvolvedores:</label>
        <select name="desenvolvedores[]" id="desenvolvedores" multiple class="border rounded p-2 w-full mb-6">
            @foreach($desenvolvedores as $desenvolvedor)
                <option value="{{ $desenvolvedor->id }}"
                    {{ in_array($desenvolvedor->id, old('desenvolvedores', $artigo->desenvolvedores->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $desenvolvedor->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700 transition">Atualizar</button>
    </form>

    <a href="{{ route('artigos.index') }}" class="block mt-4 text-center text-gray-700 hover:underline">
        Voltar para lista de artigos
    </a>
</div>
@endsection
