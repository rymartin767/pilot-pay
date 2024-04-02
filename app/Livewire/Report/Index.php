<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.report.index', [
            'reports' => Report::withoutGlobalScopes()->with(['user', 'comments', 'earnings' => function ($query) {
                $query->withoutGlobalScopes();
            }])->latest()->get()
        ]);
    }
}
