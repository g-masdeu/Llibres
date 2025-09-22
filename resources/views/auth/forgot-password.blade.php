<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Has oblidat la teva contrasenya? No et preocupis. Només indica\'ns la teva adreça de correu electrònic i t\'enviarem un enllaç per restablir la contrasenya que et permetrà triar una nova.') }}
    </div>

    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Dirección de correo electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correu electrònic')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar l\'enllaç per restablir la contrasenya') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
