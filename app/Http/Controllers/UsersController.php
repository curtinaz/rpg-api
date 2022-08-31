<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/users/login",
     *      summary="User Login",
     *      tags={"Users"},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="username",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "username":"johndoe",
     *                     "password":"johnbatista"
     *                }
     *             )
     *         )
     *      ),
     * ),
     */

    public function login(Request $req)
    {

        // Caso o usuário não preencha todos os campos
        if (!$req->username || !$req->password) {
            return response([
                "error" => [
                    "message" => "All the fields are required.",
                    "status" => 403
                ],
                "success" => false
            ], 403);
        }

        $user = User::where('email', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($req->device_name)->plainTextToken;
    }

    /**
     * @OA\Post(
     *      path="/api/users/register",
     *      summary="User Register",
     *      tags={"Users"},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="username",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "email":"john@doe.com",
     *                     "username":"johndoe",
     *                     "password":"johnbatista"
     *                }
     *             )
     *         )
     *      ),
     * ),
     */

    public function register(Request $req)
    {

        // Caso o usuário não preencha todos os campos
        if (!$req->username || !$req->email || !$req->password) {
            return response([
                "error" => [
                    "message" => "All the fields are required.",
                    "status" => 403
                ],
                "success" => false
            ], 403);
        }

        if (User::where('name', $req->username)->orWhere('email', $req->email)->first()) {
            return response(["error", 400]);
        }

        User::create([
            "name" => $req->username,
            "email" => $req->email,
            "password" => password_hash($req->password, PASSWORD_BCRYPT)
        ]);

        return response(["allright"], 200);
    }
}
