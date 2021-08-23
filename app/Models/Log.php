<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Log extends Model
{
    protected $guarded = []; 

    public function contracts()
    {
        return $this->morphTo(Contract::class);
    }

    public function products()
    {
        return $this->morphTo(Product::class);
    }

    public function providers()
    {
        return $this->morphTo(Provider::class);
    }
}
