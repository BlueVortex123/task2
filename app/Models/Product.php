<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function contracts()
    {
        return $this->belongsToMany(Contract::class,'contract_product', 'product_id', 'contract_id');
    }
}
