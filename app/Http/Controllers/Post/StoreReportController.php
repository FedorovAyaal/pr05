<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Report;

class StoreReportController extends BasePostController
{
    public function __invoke(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'reason_id' => 'required|integer'
        ]);
        $data['from_user_id'] = auth()->user()->id;
        $data['comment_id'] = $comment->id;
        Report::create($data);
        return json_encode(['answer' => 'Ваша жалоба будет рассмотрена модераторами']);
    }
}
