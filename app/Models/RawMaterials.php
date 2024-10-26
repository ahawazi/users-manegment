<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterials extends Model
{
    protected $fillable = [
        'size',
        'user_id',
        'project_name',
        'commoditie_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project_name()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function commodity()
    {
        return $this->belongsTo(Commodity::class, 'commoditie_id');
    }
}
