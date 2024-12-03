<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $primaryKey = 'facility_id';

    public function planning()
    {
        return $this->belongsTo(Planning::class, 'planning_id');
    }
}
