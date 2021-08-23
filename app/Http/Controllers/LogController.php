<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $lastActivity = Log::orderBy('updated_at', 'desc')->get();
        return view('backend.logs.index', compact('lastActivity'));
    } 

    public function getActivity(string $model_type) 
    {
        $model_type = ucfirst($model_type);
        abort_if(!class_exists("App\\Models\\$model_type"), 404);
        $activities = "App\\Models\\$model_type"::getActivities();

        return view('backend.logs.list', compact('activities'));
    }
}
