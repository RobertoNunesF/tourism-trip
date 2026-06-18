<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LogsCreationToJson
{
    private const FILE = 'registros.json';

    public function created(Model $model): void
    {
        $entries = $this->readEntries();

        $entries[] = [
            'type' => class_basename($model),
            'id' => $model->getKey(),
            'data' => $model->toArray(),
            'created_at' => now()->toIso8601String(),
        ];

        Storage::disk('local')->put(
            self::FILE,
            json_encode($entries, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readEntries(): array
    {
        if (! Storage::disk('local')->exists(self::FILE)) {
            return [];
        }

        return json_decode(Storage::disk('local')->get(self::FILE), true) ?? [];
    }
}