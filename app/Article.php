<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $guarded = [];
    public function scopeTrending($query,$take = 3)
    {
        return $query->orderBy('reads', 'desc')->take($take)->get();
    }
}
