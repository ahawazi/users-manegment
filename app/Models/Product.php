<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'results', 'product_manager_id', 'product_leader_id'];

    public function productManager()
    {
        return $this->belongsTo(User::class, 'product_manager_id');
    }

    public function productLeader()
    {
        return $this->belongsTo(User::class, 'product_leader_id');
    }
}
