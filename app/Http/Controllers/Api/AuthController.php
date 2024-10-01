<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Pinterest API Documentation",
 *      description="All documentation for using Pinterest API",
 *      @OA\Contact(
 *          email="mhanifrobbani51@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/user",
     *     tags={"Users API"},
     *     summary="Get list of all users",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No user found"
     *     )
     * )
     */
    public function index()
    {
        $user = User::latest()->get();
        return response()->json([
            "data" => [
                "user" => $user,
                "message" => "fetch all user"
            ]
        ]);
    }
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Users API"},
     *     summary="Resgiter user",
     *     @OA\Response(
     *         response=200,
     *         description="User created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error creating user"
     *     )
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->username,
                'email' => $user->email,
            ]
            
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Users API"},
     *     summary="Authenticate user",
     *     @OA\Response(
     *         response=200,
     *         description="Login successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Username or password incorrect"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Incorrect Email or Password'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        // Mengembalikan response dengan data user dan token
        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->username,
                'email' => $user->email,
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Users API"},
     *     summary="Logout user",
     *     @OA\Response(
     *         response=200,
     *         description="Logout successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error can't logout"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();

        // Revoke (hapus) token saat ini
        $token->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
            'success' => true,
        ], 200);
    }
}
