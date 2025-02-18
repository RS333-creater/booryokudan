<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $table = 'facility';
    protected $primaryKey = 'facility_id';

    protected $fillable = [
        'name',
        'location',
        'latitude',
        'longitude',
        'price'
    ];

    public function planning()
    {
        return $this->belongsTo(Planning::class, 'planning_id');
    }
}
