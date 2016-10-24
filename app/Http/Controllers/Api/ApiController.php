<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return response()->json([
            'messages' => 'Api Testing'
        ]);
    }

    /**
     * Auth Api.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Requests\ApiLoginRequest $request)
    {
        if (!Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            return response()->json(['messages' => 'Username dan Password Tidak Cocok']);
        }
        $select = $this->user->whereUsername($request['username']);
        $token = $this->createToken($select->first()->toArray());

        return response()->json([
            'token' => $token,
            'data'  => $select->first()->toArray()
        ]);
    }

    public function getLogout()
    {
        $token = $this->jwtAuth->getToken();

        $this->jwtAuth->invalidate($token);
        return response()->json(['messages' => 'Berhasil Keluar']);
    }
}
