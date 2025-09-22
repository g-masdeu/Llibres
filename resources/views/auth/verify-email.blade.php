<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Gràcies per registrar-te! Abans de començar, podries verificar la teva adreça de correu electrònic fent clic a l\'enllaç que acabem d\'enviar-te per correu? Si no has rebut el correu, amb gust t\'enviem un altre.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('S\'ha enviat un nou enllaç de verificació a l\'adreça de correu electrònic que vas proporcionar durant el registre.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Reenviar Correu de Verificació') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Tancar sessió') }}
            </button>
        </form>
    </div>
</x-guest-layout>
