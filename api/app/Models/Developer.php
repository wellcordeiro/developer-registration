<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $table = 'developers';

    protected $fillable = [
        'name',
        'email',
        'level_id',
        'gender',
        'birthdate',
        'hobby',
    ];

    protected $casts = [
        'level_id' => 'int',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }
}
