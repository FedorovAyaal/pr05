<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;

class BanUserController extends Controller
{
    public function __invoke(User $user)
    {

        $user->status = 2;
        $user->save();
        foreach ($user->comments as $comment) {
            $re = Report::where('comment_id', $comment->id)->get();
            $re->each->delete();
        }
        Comment::where('user_id', $user->id)->delete();
        $answer = [
            'response' => 'good'
        ];
        return json_encode($answer);
    }
}
