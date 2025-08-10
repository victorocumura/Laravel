<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menu Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Seus blocos fixos existentes --}}
                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-lg font-bold text-indigo-700">Documentação</h3>
                    <p class="mt-2 text-sm text-gray-600">Confira a documentação oficial do Laravel para aproveitar ao máximo sua aplicação.</p>
                    <a href="https://laravel.com/docs" class="mt-2 block text-indigo-600 hover:underline">Explore a documentação →</a>
                </div>

                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-lg font-bold text-indigo-700">Laracasts</h3>
                    <p class="mt-2 text-sm text-gray-600">Tutoriais em vídeo para aprimorar suas habilidades com Laravel e mais.</p>
                    <a href="https://laracasts.com" class="mt-2 block text-indigo-600 hover:underline">Veja Laracasts →</a>
                </div>

                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-lg font-bold text-indigo-700">Vento de cauda</h3>
                    <p class="mt-2 text-sm text-gray-600">Aproveite o poder do Tailwind CSS para estilizar sua aplicação.</p>
                    <a href="https://tailwindcss.com" class="mt-2 block text-indigo-600 hover:underline">Conheça Tailwind CSS →</a>
                </div>

                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-lg font-bold text-indigo-700">Autenticação</h3>
                    <p class="mt-2 text-sm text-gray-600">Gerencie autenticação e registro com o Laravel Jetstream integrado.</p>
                    <a href="https://jetstream.laravel.com" class="mt-2 block text-indigo-600 hover:underline">Saiba mais sobre Jetstream →</a>
                </div>

                {{-- Novo bloco: Desenvolvedores com contagem de artigos --}}
                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-lg font-bold text-indigo-700 mb-4">Desenvolvedores</h3>
                    @if($desenvolvedores->isEmpty())
                        <p class="text-gray-500">Nenhum desenvolvedor cadastrado.</p>
                    @else
                        <ul>
                            @foreach ($desenvolvedores as $dev)
                                <li class="flex justify-between items-center py-2 border-b last:border-b-0">
                                    <span>{{ $dev->nome }}</span>
                                    <span class="inline-block bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                        {{ $dev->artigos_count }} artigo{{ $dev->artigos_count !== 1 ? 's' : '' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Novo bloco: Artigos com contagem de desenvolvedores --}}
                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-lg font-bold text-green-700 mb-4">Artigos</h3>
                    @if($artigos->isEmpty())
                        <p class="text-gray-500">Nenhum artigo cadastrado.</p>
                    @else
                        <ul>
                            @foreach ($artigos as $artigo)
                                <li class="flex justify-between items-center py-2 border-b last:border-b-0">
                                    <span>{{ $artigo->titulo }}</span>
                                    <span class="inline-block bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                        {{ $artigo->desenvolvedores_count }} dev{{ $artigo->desenvolvedores_count !== 1 ? 's' : '' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
