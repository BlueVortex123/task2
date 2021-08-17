<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'provider_id', 'name', 'date'];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');

    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'contract_product','contract_id','product_id');
    }
}
