<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('2023 Report') }}
        </h2>
    </x-slot>

    <section wire:ignore class="max-w-2xl mx-auto px-3">
        <x-report-card :report="$report"></x-report-card>
    </section>

    <section class="mt-12 max-w-2xl mx-auto px-3">
        <div class="text-2xl font-bold mb-2">REPORT COMMENTS</div>
        @forelse ($comments as $comment)
            <x-comment :comment="$comment"></x-comment>
        @empty
            <div>
                NO COMMENTS. LEAVE ONE BELOW.
            </div>
        @endforelse
    </section>

    <section class="mt-12 max-w-2xl mx-auto px-3">
        <div class="text-2xl font-bold mb-2">ADD A COMMENT</div>
        <form wire:submit="create" class="">
            {{ $this->form }}

            <button type="submit" class="black-button mt-3">
                Submit
            </button>
        </form>
    </section>
</div>