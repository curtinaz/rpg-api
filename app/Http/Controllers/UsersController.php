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

        if (User::where('name', $req->name)->where('password', $req->password)) {
            return response(["allright"], 200);
        }
    }
}
