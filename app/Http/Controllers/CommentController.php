<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
{




    
/**-------------------コメントページ遷移------------------------ */

    public function create()
    {
        $q = \Request::query();

        return view('comments.create', [
            'post_id' => $q['post_id'],
        ]);
    }





 /**-------------------コメントページ保存------------------------ */

    public function store(CommentRequest $request,Comment $comment )
    {
        
        $input = $request->only($comment->getFillable());

        $comment = $comment->create($input);
        return redirect('/posts/'.$comment->post_id);
    }





/**-------------------コメントページ編集ページ遷移------------------------ */
 

    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }





   /**-------------------コメントページ更新------------------------ */
    public function update(CommentRequest $request,Comment $comment)
    {
        $comment->fill($request->all())->save();
         return redirect('/posts/'.$comment->post_id);
    }





/**-------------------コメントページ削除------------------------ */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('/posts/'.$comment->post_id);
    }
}