<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FrontImage extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = ['title', 'excerpt'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('front')
            ->performOnCollections(collectionNames:'front-images')
            ->crop('crop-center', width: 1920, height: 1280)
            ->withResponsiveImages()
            ->nonQueued();        
        $this->addMediaConversion('thumb-front')
            ->performOnCollections(collectionNames:'front-images')
            ->crop('crop-center', width: 192, height: 128)
            ->nonQueued();        

    }
}
