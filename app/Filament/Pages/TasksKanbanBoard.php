<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class TasksKanbanBoard extends KanbanBoard
{
    protected static ?string $title = 'Tasks';

    protected function statuses(): Collection
    {
         return TaskStatus::statuses();
    }

    protected function records(): Collection
    {
         return Task::ordered()->get();
    }

    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
         Task::find($recordId)->update(['status' => $status]);
         Task::setNewOrder($toOrderedIds);
    }

    public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    {
         Task::setNewOrder($orderedIds);
    }

    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('title'),
            Textarea::make('description'),
        ];
    }

    protected function getEditModalRecordData($recordId, $data): array
    {
        return Task::find($recordId)->toArray();
    }

    protected function editRecord($recordId, array $data, array $state): void
    {
        Task::find($recordId)->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->model(Task::class)
                ->form([
                    TextInput::make('title'),
                    Textarea::make('description'),
                ])
        ];
    }

    protected function additionalRecordData(Model $record): Collection
    {
        return collect([
            'urgent' => $record->urgent,
        ]);
    }
}
