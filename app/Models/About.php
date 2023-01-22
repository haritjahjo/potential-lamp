<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class About extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;    
    protected $fillable = ['title', 'content'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('main-about')
            ->performOnCollections(collectionNames:'abouts')
            ->crop('crop-center', width: 1024, height: 768)
            ->withResponsiveImages()
            ->nonQueued();        
        $this->addMediaConversion('thumb-about')
            ->performOnCollections(collectionNames:'abouts')
            ->crop('crop-center', width: 102, height: 76)
            ->nonQueued();        

    }

}
