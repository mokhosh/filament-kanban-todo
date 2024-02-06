<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Collection;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class UrgentTasksKanbanBoard extends KanbanBoard
{
    protected static ?string $title = 'Urgent Tasks';

    protected function statuses(): Collection
    {
        return TaskStatus::statuses();
    }

    protected function records(): Collection
    {
        return Task::where('urgent', true)->ordered()->get();
    }

    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
        // Model::find($recordId)->update(['status' => $status]);
        // Model::setNewOrder($toOrderedIds);
    }

    public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    {
        // Model::setNewOrder($orderedIds);
    }
}
