<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    protected $table= "articles";

    public function tags()
    {
       return $this->belongsToMany(Tag::class, 'articles_tags');

    }
}
