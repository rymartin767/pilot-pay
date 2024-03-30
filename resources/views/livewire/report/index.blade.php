<section class="max-w-3xl mx-auto">
    
    @auth
        @can('create', App\Models\Report::class)
            <a href="{{ route('filament.dashboard.resources.reports.create') }}">ADD REPORT!</a>
        @endcan
    @endauth

    @guest
        <a href="{{ route('register') }}">REGISTER TO ADD A REPORT!</a>
    @endguest
    
    <div class="flex flex-col space-y-8">
        @forelse ($reports as $report)
            <x-report-card :report="$report"></x-report-card>
        @empty
            <div>No Reports Found!</div>
        @endforelse
    </div>
</section>
