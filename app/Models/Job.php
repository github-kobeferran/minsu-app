<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Job extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'tags',
        'company',
        'location',
        'email',
        'website',
        'descript',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    protected $appends = [
        'created_at_formatted',
        'media_url',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('M d, Y');
    }

    public function getMediaUrlAttribute()
    {
        $media = $this->getFirstMedia('photos');

        if ($media) {
            return $media->getUrl();
        }

        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
