<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts API"},
     *     summary="Get list of posts",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="no post yet"
     *     )
     * )
     */

    public function index()
    {
        $post = Post::latest()->get();
        return response()->json([
            'data' => PostResource::collection($post),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts API"},
     *     summary="Creating a post",
     *     @OA\Response(
     *         response=200,
     *         description="post created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error creating post"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:99'],
            'image' => ['nullable', 'image', 'file', 'max:5024'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ], 422);
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $newFileName = time() . '-' . $file->getClientOriginalName();
            $newFilePath = $file->storeAs('img-store', $newFileName, 'public');
            $validatedData['image'] = $newFilePath;
        }

        try {
            $validatedData['user'] = $request->user()->username;

            $post = Post::create($validatedData);

            // Kembalikan respons sukses
            return response()->json([
                'data' => new PostResource($post),
                'message' => 'Data post created successfully',
                'success' => true
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating post',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/post/{post}",
     *     tags={"Posts API"},
     *     summary="Get specific post by id",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="no post found"
     *     )
     * )
     */
    public function show(Post $post)
    {
        // Load comments associated with the post
        $post->load('comments');

        return response()->json([
            'data' => [
                'post' => new PostResource($post),
                'comments' => CommentResource::collection($post->comments),
            ],
            'message' => 'Data post and comments found',
            'success' => true
        ]);
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
