<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'platform',
        'genre',
        'category',
        'release_year',
        'prices',
    ];

    protected $casts = [
        'prices' => 'json',
    ];

    public function getImageUrlAttribute(): ?string
    {
        $imagePath = $this->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            return asset($imagePath);
        }

        $searchNames = [];

        if ($imagePath) {
            $filename = pathinfo($imagePath, PATHINFO_FILENAME);
            if ($filename) {
                $searchNames[] = $filename;
            }
        }

        if ($this->name) {
            $searchNames[] = Str::slug($this->name, '_');
            $searchNames[] = Str::slug($this->name, '-');
            $searchNames[] = Str::of($this->name)->lower()->replace(' ', '_')->snake('_')->toString();
        }

        $searchNames = array_unique(array_filter($searchNames));

        foreach ($searchNames as $nameCandidate) {
            foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                $candidatePath = "images/{$nameCandidate}.{$ext}";
                if (file_exists(public_path($candidatePath))) {
                    return asset($candidatePath);
                }
            }
        }

        return null;
    }
}
