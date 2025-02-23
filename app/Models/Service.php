<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'created_by_id',
        'name',
        'description',
        'price',
        'service_image_id',
        'sector_id',
    ];

    /**
     * Get the user that created the service.
     */
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Get the sector that owns the service.
     */
    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
