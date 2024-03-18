<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="max-w-3xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-report-card></x-report-card>
            </section>
        </div>
    </div>
</x-app-layout>
