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
}
