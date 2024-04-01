<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('2023 Report') }}
        </h2>
    </x-slot>

    <section class="max-w-3xl mx-auto">
        <x-report-card :report="$report"></x-report-card>
    </section>

    <section class="mt-12 max-w-3xl mx-auto">
        <div class="text-2xl font-bold">REPORT COMMENTS</div>
        <div>
            NO COMMENTS. LEAVE ONE BELOW.
        </div>
    </section>

    <section class="mt-12 max-w-3xl mx-auto">
        <div class="text-2xl font-bold">ADD A COMMENT</div>
        <form wire:submit="create" class="mt-2">
            {{ $this->form }}

            <button type="submit" class="black-button mt-3">
                Submit
            </button>
        </form>
    </section>
</div>