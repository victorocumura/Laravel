<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">Perfil</h2>
  </x-slot>

  <div class="bg-white rounded-lg shadow p-6 space-y-6">
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
      @livewire('profile.update-profile-information-form')
      <x-section-border />
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
      @livewire('profile.update-password-form')
      <x-section-border />
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
      @livewire('profile.two-factor-authentication-form')
      <x-section-border />
    @endif

    @livewire('profile.logout-other-browser-sessions-form')

    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
      <x-section-border />
      @livewire('profile.delete-user-form')
    @endif
  </div>
</x-app-layout>
