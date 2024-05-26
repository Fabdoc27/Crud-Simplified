<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model {
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'price',
        'status',
    ];

    public function categories(): BelongsToMany {
        return $this->belongsToMany( Category::class );
    }

    public function locations(): BelongsToMany {
        return $this->belongsToMany( Location::class );
    }
}