<?php

namespace App\Traits;

use App\Models\Log;

trait RecordsActivity
{
    /**
     * Register the necessary event listeners.
     *
     * @return void
     */
    protected static function bootRecordsActivity()
    {
        foreach (static::getModelEvents() as $event)                                    // PHP Manual - Anonymous functions * Note: :: = scope resolution operator
            static::$event(fn ($model) => $model->recordActivity($event));              // * Note: $model = Closures can also accept regular arguments
    }                                                

    /**
     * Record activity for the model.
     *
     * @param  string $event
     * @return void
     */
    public function recordActivity($event)
    {
        $this->logs()->create([
            'name' => $this->getActivityName($this, $event), 
        ]);
    }

    /**
     * Prepare the appropriate activity name.
     *
     * @param  mixed  $model
     * @param  string $action
     * @return string
     */
    protected function getActivityName($model, $action)
    {
        $name = strtolower(class_basename($model)); 

        return "{$action}_{$name}";
    }

    /**
     * Get the model events to record activity for.
     *
     * @return array
     */
    protected static function getModelEvents()
    {
        return static::$recordEvents ?? [
            'created', 'updated', 'deleted'
        ];
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'subject');
    }
}