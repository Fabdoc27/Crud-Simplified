<?php

namespace App\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model implements HasMedia {
    use HasFactory;
    use InteractsWithMedia;

    public const PLACEHOLDER_IMAGE = 'images/placeholder.jpeg';

    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'price',
        'status',
    ];

    public function author(): BelongsTo {
        return $this->belongsTo( User::class, 'seller_id' );
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany( Category::class );
    }

    public function locations(): BelongsToMany {
        return $this->belongsToMany( Location::class );
    }
}