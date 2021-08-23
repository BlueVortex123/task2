<?php 

namespace App\Traits; 

trait ActivityScope 
{
    public function scopeWithActivities($query)
    {
        return $query->with('activities');
    }

    public static function getWithActivities()
    {
        return self::withActivities()->get();
    }

    public static function getActivities()
    {
        return self::getWithActivities()->pluck('logs')->flatten()->sortByDesc('created_at');
    }
}