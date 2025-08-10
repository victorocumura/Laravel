<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>

  <title>{{ config('app.name', 'Mini Sistema') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
  <x-banner />

  <div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!-- Cabeçalho da página -->
    @isset($header)
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endisset

    <!-- Conteúdo das views -->
    <main class="container mx-auto px-6 py-4">
      {{ $slot }}
    </main>
  </div>

  @stack('modals')
  @livewireScripts
</body>
</html>
