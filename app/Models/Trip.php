<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'trip';

    protected $fillable = [
        'start_point', 'end_point', 'state', 'user_id'
    ];

    // planningとのリレーション
    public function plannings()
    {
        return $this->hasMany(Planning::class, 'trip_id', 'trip_id');
    }
}
