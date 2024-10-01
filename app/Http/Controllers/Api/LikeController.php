<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * @OA\Post(
     *     path="/post/{postId}/like",
     *     tags={"Like API"},
     *     summary="Creating like for specific post",
     *     @OA\Response(
     *         response=200,
     *         description="Like created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error can't adding like"
     *     )
     * )
     */
    public function toggleLike(Request $request, $postId)
    {
        $user = $request->user();

        $post = Post::findOrFail($postId);

        $like = Like::where('post_id', $postId)->where('user_id', $user->id)->first();

        if ($like) {
            // Jika sudah like, hapus like (unlike)
            $like->delete();
            return response()->json([
                'success' => true,
                'message' => 'Post unliked',
                'like_status' => false,
            ]);
        } else {
            // Jika belum like, tambahkan like
            Like::create([
                'post_id' => $postId,
                'user_id' => $user->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post liked',
                'like_status' => true, 
                'total_likes' => $post->likes()->count()
            ]);
        }
    }


    // public function toggleLike(Request $request, $postId)
    // {
    //     $ipAddress = $request->ip();
    //     $post = Post::findOrFail($postId);

    //     $like = Like::where('post_id', $postId)->where('ip_address', $ipAddress)->first();

    //     if ($like) {
    //         $like->delete();
    //         return response()->json(['success' => true, 'message' => 'Post unliked']);
    //     } else {
    //         Like::create([
    //             'post_id' => $post->id, // Ambil ID post
    //             'ip_address' => $ipAddress
    //         ]);
    //         return response()->json(['success' => true, 'message' => 'Post liked']);
    //     }
    // }


    /**
     * @OA\Get(
     *     path="/post/{postId}/likes",
     *     tags={"Like API"},
     *     summary="Get number of like",
     *     @OA\Response(
     *         response=200,
     *         description="Like fetch successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error can't fetch data like"
     *     )
     * )
     */
    public function getLikes($postId)
    {
        $post = Post::withCount('likes')->findOrFail($postId);
        return response()->json([
            'likes_count' => $post->likes_count
        ]);
    }
}
