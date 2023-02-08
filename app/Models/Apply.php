<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Apply extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'apply';

    protected $fillable = [
        'name',
        'email',
        'number',
        'user_id',
        'job_id',
    ];

    protected $appends = [
        'created_at_formatted',
        'media_url',
    ];

    public function getMediaUrlAttribute()
    {
        $media = $this->getFirstMedia('resume');

        if ($media) {
            return $media->getUrl();
        }

        return null;
    }
}
