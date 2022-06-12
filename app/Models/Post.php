<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Storage;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'content', 'description', 'category_id', 'thumbnail',];

    public static function UploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('thumbnail')) {
            if ($image) {
                Storage::disk('public')->delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}", 'public');
        }
        return $image;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImage()
    {
        if (str_contains($this->thumbnail, 'faker')) {
            $image = str_replace('storage/app/public/', '', $this->thumbnail);
            return asset("storage/{$image}");
        } else {
            return $this->thumbnail ? asset("storage/{$this->thumbnail}") : asset("storage/images/default.png");
        }
    }

    public function getPostDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }

    public function scopeSearch($query, $search, $fields)
    {
        if ($fields) {
            $query->where(function ($q) use ($search, $fields) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
                }
            });
        } else {
            $query->where('title', 'like', "%{$search}%");
        }

    }
}
