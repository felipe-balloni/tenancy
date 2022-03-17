<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Departament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

/**
 * @property ComponentContainer|mixed $form
 */
class DepartmentForm extends Component implements HasForms
{
    use InteractsWithForms, LivewireAlert;

    public ? string $name = '';

    public function mount()
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {

        return [
            Forms\Components\TextInput::make('name')
                ->unique()
                ->maxLength(200)
                ->required(),
        ];
    }

    public function submit(): void
    {
        Departament::create($this->form->getState());

        $this->alert('success', 'Record saved successfully!');

        $this->reset();
    }

    protected function getFormModel(): string
    {
        return Departament::class;
    }

    public function render()
    {
        return view('livewire.department-form');
    }
}
