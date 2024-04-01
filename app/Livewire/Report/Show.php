<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class Show extends Component implements HasForms
{
    use InteractsWithForms;
    
    public ?array $data = [];
    public Report $report;

    public function mount(Report $report)
    {
        $this->report = $report;
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.report.show');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('content')
                    ->required()
                    ->minLength(10)
                    ->label(''),
            ])
            ->statePath('data');
    }
    
    public function create(): void
    {
        dd($this->form->getState()['content']);
    }
}
    
    
