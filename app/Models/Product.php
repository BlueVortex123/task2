<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function contracts()
    {
        return $this->belongsToMany(Contract::class,'contract_product', 'product_id', 'contract_id');
    }
}
