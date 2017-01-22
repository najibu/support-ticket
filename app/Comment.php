<?php

namespace App;

use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function ticket()
    {
      return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
