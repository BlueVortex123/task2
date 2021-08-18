<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['operation','models_log'];
    public function logs()
    {
        return $this->morphTo('models_log');
    }
}
