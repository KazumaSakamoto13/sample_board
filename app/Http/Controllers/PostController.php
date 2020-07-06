<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;

class PostController extends Controller
{




    /**-------------------投稿一覧------------------------ */
    public function index()
    {

        /**-------------------カテゴリーで一覧表示------------------------ */
        $q = \Request::query();

        if(isset($q['category_id'])){
            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(3);
            $posts->load('category', 'user', 'tags');

            return view('posts.index', [
                'posts' => $posts,
                'category_id' => $q['category_id']
            ]);

          /**-------------------カテゴリーネームで一覧表示------------------------ */      
        } if(isset($q['tag_name'])){

            $posts = Post::latest()->where('content', 'like', "%{$q['tag_name']}%")->paginate(3);
            $posts->load('category', 'user', 'tags');

            return view('posts.index', [
                'posts' => $posts,
                'tag_name' => $q['tag_name']
            ]);

            /**-------------------一覧表示------------------------ */  
        }else {
            $posts = Post::latest('updated_at')->paginate(3);
            $posts->load('category', 'user', 'tags');

            return view('posts.index', [
                'posts' => $posts,
            ]);
        }

    }


  /**-------------------スレッド作成ページ遷移------------------------ */  
    public function create()
    {
        return view('posts.create');   
    }





   /**-------------------スレッド保存------------------------ */  
    public function store(PostRequest $request)
    {

        if($request->file('image')->isValid()) {
            $post = new Post;
            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;
            $post->content = $request->content;
            $post->title = $request->title;

            $filename = $request->file('image')->store('public/image');

            $post->image = basename($filename);

            preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->content, $match);

            $tags = [];
            foreach ($match[1] as $tag) {
                $found = Tag::firstOrCreate(['tag_name' => $tag]);

                array_push($tags, $found);
            }

            $tag_ids = [];

            foreach ($tags as $tag) {
                array_push($tag_ids, $tag['id']);
            }

            $post->save();
            $post->tags()->attach($tag_ids);
        }

        return redirect('/');
    }





/**-------------------スレッド詳細ページ遷移------------------------ */  
    public function show(Post $post)
    { 
        $post->load('category', 'user', 'comment.user' );
  
        return view('posts.show', [
            'post' => $post,
            ]);
    }




    /**-------------------編集ページ遷移------------------------ */  
    public function edit(Post $post)
    {
        $post->load('tags' );
        return view('posts.edit', [
            'post' => $post,
        ]);
    }




    /**-------------------スレッド更新------------------------ */  
    public function update(PostRequest $request, Post $post)
    {     
            // $input = $request->only($post->getFillable());
            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;
            $post->content = $request->content;
            $post->title = $request->title;
            $filename = $request->file('image')->store('public/image');

            $post->image = basename($filename);

            $post->save();


        return redirect('/')->with('message', '更新されました！');
    }




    /**-------------------スレッド削除------------------------ */  
    public function destroy(Post $post)
    {
    
        $post->delete();
        return redirect()->route('posts.index')->with('message', '削除されました！');
    }




    /**-------------------スレッド------------------------ */  
    public function search(Request $request)
    {
     $title = $request->get('title');
       $content = $request->get('content');

       if(!empty($title&&$content)){
        $posts = Post::where('title','LIKE','%'.$title.'%')
                ->Where('content','LIKE','%'.$content.'%')
                ->paginate(3);
                return view('posts.index', [
                    'posts' => $posts,
                    'title'=>$title,
                    'content'=>$content
                    ]);
       }elseif(!empty($title)){
        $posts = Post::where('title','LIKE','%'.$title.'%')
        ->paginate(3);
        return view('posts.index', [
            'posts' => $posts,
            'title'=>$title,
            ]);

       }elseif(!empty($content)){
        $posts = Post::where('content','LIKE','%'.$content.'%')
        ->paginate(3);
        return view('posts.index', [
            'posts' => $posts,
            'content'=>$content,
            ]);



       }elseif($title===null && $content===null){
        return redirect('/')->with('message', 'キーワードを入力してください！');
       }
       
}


}