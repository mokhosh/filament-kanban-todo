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

    protected static string $headerView = 'tasks-kanban.kanban-header';

    protected static string $recordView = 'tasks-kanban.kanban-record';

    protected static string $statusView = 'tasks-kanban.kanban-status';

    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('title'),
            Textarea::make('description'),
            TextInput::make('progress')->numeric(),
        ];
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
                ->mutateFormDataUsing(function ($data) {
                    $data['user_id'] = auth()->id();

                    return $data;
                })
        ];
    }
}
