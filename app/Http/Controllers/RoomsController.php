<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{

    /**
     * @OA\get(
     *      path="/api/rooms",
     *      summary="Retrieve all rooms",
     *      tags={"Rooms"},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *      )
     * ),
     */
    public function index()
    {
        return Room::all();
    }


    /**
     * @OA\Post(
     *      path="/api/rooms",
     *      summary="Create a room",
     *      tags={"Rooms"},
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
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="max_players",
     *                          type="int32"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name": "Room's name",
     *                     "max_players": 4,
     *                     "password": "roomspassword"
     *                }
     *             )
     *         )
     *      ),
     * ),
     */
    public function create(Request $req)
    {
        if (!$req->name || !$req->max_players) {
            return response([
                "error" => "all fields must be filled"
            ], 200);
        }

        $room = Room::create([
            "name" => $req->name,
            "max_players" => $req->max_players,
            "password" => $req->password
        ]);

        return response($room, 200);
    }
}
