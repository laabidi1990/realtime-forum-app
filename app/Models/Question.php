<?php

namespace App\Models;

use App\User;
use App\Models\Reply;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'slug';    
    }

    protected $with = ['replies'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    function getPathAttribute()
    {
        return "/questions/$this->slug";
    }
}
