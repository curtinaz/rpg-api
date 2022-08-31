<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        if (!$req->name || !$req->password) {
            return response([
                "error" => [
                    "message" => "All the fields are required.",
                    "status" => 403
                ],
                "success" => false
            ], 403);
        }

        if (User::where('name', $req->name)->where('password', $req->password)) {
            return response(["allright"], 200);
        }
    }

    public function register(Request $req)
    {

        // Caso o usuário não preencha todos os campos
        if (!$req->name || !$req->email || !$req->password) {
            return response([
                "error" => [
                    "message" => "All the fields are required.",
                    "status" => 403
                ],
                "success" => false
            ], 403);
        }

        if (User::where('name', $req->name)->orWhere('email', $req->email)->first()) {
            return response(["error", 400]);
        }

        User::create([
            "name" => $req->name,
            "email" => $req->email,
            "password" => password_hash($req->password, PASSWORD_BCRYPT)
        ]);

        return response(["allright"], 200);
    }
}
