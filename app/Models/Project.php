<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Model;

class Project extends Model implements FilamentUser
{
    use  HasRoles, HasPanelShield;
    protected $fillable = [
        'name',
        'project_manager_id',
        'project_leader_id',
    ];
    protected $guard_name = "web";
    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function projectLeader()
    {
        return $this->belongsTo(User::class, 'project_leader_id');
    }
}
