<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
     * @OA\Get(
     *     path="/api/post/{post_id}/comment",
     *     tags={"Comment API"},
     *     summary="Get comment user by post id",
     *     @OA\Response(
     *         response=200,
     *         description="Fetch comment"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="No comment found"
     *     )
     * )
     */
    public function index($post_id)
    {
        // Ambil komentar yang terkait dengan post berdasarkan ID
        $comments = Comment::where('post_id', $post_id)->latest()->get();

        return response()->json([
            'data' => $comments,
            'message' => 'Comments for post ID ' . $post_id,
            'success' => true
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/post/{post_id}/comment",
     *     tags={"Comment API"},
     *     summary="Create comment",
     *     @OA\Response(
     *         response=200,
     *         description="Comment added successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error, can't create comment"
     *     )
     * )
     */
    public function store(Request $request, $post_id)
    {

        $post = Post::find($post_id);
        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
                'success' => false
            ], 404);
        }
        // dd($post_id);

        $validatedData = $request->validate([
            'body' => ['required']
        ]);

        try {
            $validatedData['post_id'] = $post_id;
            Comment::create($validatedData);

            return response()->json([
                'data' => $validatedData,
                'message' => 'Comment successfully created!',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'success' => false
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /**
     * @OA\Get(
     *     path="/api/allcomments",
     *     tags={"Comment API"},
     *     summary="Get all comment user",
     *     @OA\Response(
     *         response=200,
     *         description="Fetch all comment"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="No comment found"
     *     )
     * )
     */
    public function AllComment(){
        $comments = Comment::latest()->get();
        return response()->json([
            'data' => $comments,
            'message' => 'Comments fetch success ',
            'success' => true
        ]);
    }
}
