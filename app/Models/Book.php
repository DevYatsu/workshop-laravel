<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Columns that may be mass-assigned. Without this, Book::create($request->all())
     * and ->update($request->all()) silently drop every attribute.
     */
    protected $fillable = ['title', 'pages', 'quantity', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
