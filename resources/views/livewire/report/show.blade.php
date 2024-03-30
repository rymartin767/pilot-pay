<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('2023 Report') }}
        </h2>
    </x-slot>

    <section class="max-w-3xl mx-auto">
        <x-report-card :report="$report"></x-report-card>
    </section>

    <section class="mt-6 max-w-3xl mx-auto">
        <div>REPORT COMMENTS</div>
        <form wire:submit="create">
            {{ $this->form }}

            <button type="submit">
                Submit
            </button>
        </form>
    </section>
</div>