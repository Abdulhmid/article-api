<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use App\Library\Token;
use App\Models as Md;
use App\User;

class ApiController extends Controller
{

    use Token;

    private $user, $jwtAuth;

    public function __construct(
        User $user,
        JWTAuth $jwtAuth
    )
    {
        $this->middleware(
                'auth.jwt.api', 
                ['except' => ['postLogin']]
        );
        $this->user     = $user;
        $this->jwtAuth  = $jwtAuth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "s";
    }

    /**
     * Auth Api.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Requests\ApiLoginRequest $request)
    {
        $select = $this->user->whereUsername($request['username']);
        $token = $this->createToken($select->first()->toArray());

        return response()->json([
            'token' => $token,
            'data'  => $select->first()->toArray()
        ]);
    }
}
