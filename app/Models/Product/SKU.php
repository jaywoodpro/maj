<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SKU extends Model
{
    protected $table = "sku";
    protected $fillable = [
        'sku',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function model()
    {
        return $this->morphTo();
    }
}
