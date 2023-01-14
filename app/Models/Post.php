<?php

namespace App\Models;

use App\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, UploadFiles;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id',
    ];

    protected $appends = [
        'image_for_web',
        'date_for_web',
        'trashed',
    ];

    // Accessors & Mutators
    public function getImageForWebAttribute()
    {
        return asset($this->image);
    }

    public function getDateForWebAttribute()
    {
        return $this->created_at->format('Y-m-d h:i a');
    }

    public function getTrashedAttribute()
    {
        return !is_null($this->deleted_at);
    }

    public function setImageAttribute($file)
    {
        return $this->attributes['image'] = request()->hasFile('image')
            ? $this->uploadFile($file, $this->table, $this->image ?? null)
            : $file;
    }

    // Relations
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
