@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Artigos</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('artigos.create') }}" 
       style="background-color: black; color: white; display: block; width: max-content; margin: 0 auto; padding: 0.5rem 1rem; border-radius: 0.25rem; text-align: center;"
       onmouseover="this.style.backgroundColor='#333';"
       onmouseout="this.style.backgroundColor='black';"
    >
        Cadastrar Novo Artigo
    </a>

    @if($artigos->isEmpty())
        <p>Nenhum artigo cadastrado.</p>
    @else
        <table class="w-full border border-gray-300 mt-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Título</th>
                    <th class="border px-4 py-2">Slug</th>
                    <th class="border px-4 py-2">Data de Publicação</th>
                    
                    {{-- 👇 NOVO cabeçalho para Desenvolvedores --}}
                    <th class="border px-4 py-2">Desenvolvedores</th>
                    
                    <th class="border px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artigos as $artigo)
                    <tr>
                        <td class="border px-4 py-2">{{ $artigo->titulo }}</td>
                        <td class="border px-4 py-2">{{ $artigo->slug }}</td>
                        <td class="border px-4 py-2">
                            {{ $artigo->data_publicacao ? \Carbon\Carbon::parse($artigo->data_publicacao)->format('d/m/Y') : '-' }}
                        </td>

                        {{-- 👇 NOVO campo de Desenvolvedores --}}
                        <td class="border px-4 py-2">
                            @if ($artigo->desenvolvedores->isEmpty())
                                <span class="text-gray-500 italic">Nenhum</span>
                            @else
                                <div class="flex flex-wrap gap-1">
                                    @foreach($artigo->desenvolvedores as $dev)
                                        <span class="bg-blue-200 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $dev->nome }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        <td class="border px-4 py-2">
                            <a href="{{ route('artigos.edit', $artigo->id) }}" class="text-blue-600 hover:underline">Editar</a> | 

                            <form action="{{ route('artigos.destroy', $artigo->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este artigo?')" class="text-red-600 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
        <div class="mt-4">
            {{ $artigos->links() }}
        </div>
    @endif
</div>
@endsection
