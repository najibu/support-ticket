<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
}
