<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;

    protected $fillable = [
        "artist_id",
        "title"
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
