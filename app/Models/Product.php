<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements FilamentUser
{
    use  HasRoles, HasPanelShield;
    protected $fillable = [
        'name',
        'product_manager_id',
        'product_leader_id',
    ];
    protected $guard_name = "web";
    public function productManager()
    {
        return $this->belongsTo(User::class, 'product_manager_id');
    }

    public function productLeader()
    {
        return $this->belongsTo(User::class, 'product_leader_id');
    }
}
