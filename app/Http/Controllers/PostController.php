<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\UserReaction;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPosts()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function addNewPost(UpdatePostRequest $request)
    {
        $post_data = [];
        $post_data['user_id'] = $request->get('user_id');
        $post_data['topic'] = $request->get('topic');
        $post_data['tags'] = $request->get('tag');
        $post_data['post_content'] = $request->get('post_content');
        $save = Post::create($post_data);
        return response()->json($save, 200);
    }

    public function updatePost(UpdatePostRequest $request)
    {
        $post_data = [];
        $postId = $request->get('post_id');
        $post_data['user_id'] = $request->get('user_id');
        $post_data['topic'] = $request->get('topic');
        $post_data['tags'] = $request->get('tag');
        $post_data['post_content'] = $request->get('post_content');
        $post_data = Post::where('id', $postId)->update($post_data);
        return response()->json($post_data, 200);
    }

    public function getAllPostsByUser(Request $request)
    {
        $userId = $request->route()->parameter('user_id');
        $post = Post::where('user_id', $userId)->get();
        return response()->json($post);
    }

    public function getPostById(Request $request)
    {
        $postId = $request->route()->parameter('id');
        $post = Post::where('id', $postId)->get();
        return response()->json($post);
    }

    public function deletePost(Request $request)
    {
        $postId = $request->route()->parameter('id');
        UserReaction::where('post_id', $postId)->delete();
        $post = Post::find($postId)->delete();
        return response()->json($post);
    }

    public function isUserReactedPost(Request $request)
    {
        $postId = $request->route()->parameter('id');
        $userId = $request->get('userId');
        $react = UserReaction::where(['user_id' => $userId, 'post_id' => json_decode($postId)])->first();
        return response()->json($react);
    }

    public function reactPost(Request $request)
    {
        $postId = $request->route()->parameter('id');
        $reactType = $request->get('react');
        $userId = $request->get('userId');
        $post = Post::where('id', $postId)->first();
        $post_data = [];
        $react = UserReaction::where(['user_id' => $userId, 'post_id' => json_decode($postId)])->first();

        if ($react) {
            if ($react->reaction == 'like' && $reactType == 'dislike') {
                $post_data['likes'] = $post->likes - 1;
                $post_data['dislikes'] = $post->dislikes + 1;
                UserReaction::where(['user_id' => $userId, 'post_id' => json_decode($postId)])->update(['reaction' => $reactType]);

            } else if ($react->reaction == 'dislike' && $reactType == 'like') {
                $post_data['dislikes'] = $post->dislikes - 1;
                $post_data['likes'] = $post->likes + 1;
                UserReaction::where(['user_id' => $userId, 'post_id' => json_decode($postId)])->update(['reaction' => $reactType]);
            }
        } else {
            UserReaction::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'reaction' => $reactType,
            ]);

            if ($reactType == 'like') {
                $post_data['likes'] = $post->likes + 1;

            } else if ($reactType == 'dislike') {
                $post_data['dislikes'] = $post->dislikes + 1;
            }
        }
        $post_data = Post::where('id', $postId)->update($post_data);
        return response()->json($post_data);
    }
}
