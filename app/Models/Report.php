<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;
use App\Models\Reason;



class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $guarded = false;

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    public function from_user_id()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}
