<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;

class DepartmentList extends Component implements HasTable
{
    use InteractsWithTable;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    public function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Department::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable()
                ->sortable(),
            BadgeColumn::make('tenant_id')
                ->colors([
                    'success'
                ]),
        ];
    }

    protected function getTableFilters(): array
    {
        return [ ];
    }

    protected function getTableActions(): array
    {
        return [
            LinkAction::make('edit')
                ->url(fn (Department $record): string => '#')
                ->hidden(fn (Department $record): bool => auth()->user()->can('update', $record))
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [ ];
    }


    public function render()
    {
        return view('livewire.department-list');
    }
}
