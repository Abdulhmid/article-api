<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Serializers\ArticlesSerializer;
use App\Transformers\ArticlesTransformer;
use Tymon\JWTAuth\JWTAuth;
use App\Models as Md;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;


class ArticlesController extends Controller
{
    public function __construct(
        Md\News $news,
        JWTAuth $jwtAuth
    )
    {
        $this->middleware(
                'auth.jwt.api', 
                ['except' => ['']]
        );
        $this->news     = $news;
        $this->jwtAuth  = $jwtAuth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->news->whereStatus('1')->get(['id', 'title', 'slug', 'content','user_id']);
        $resource = new Collection($articles, new ArticlesTransformer());
        $array = $this->serializeOutput($resource);
        
        return response()->json([
            // $request, 
            $array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = $this->news->find($id);
        return response()->json([
            'data' => $articles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = $this->news->find($id)->delete();
        return response()->json([
            'message' => "Article Berhasil Dihapus"
        ]);
    }

    public function serializeOutput($resource)
    {
        $manager = new Manager();
        $manager->setSerializer(new ArticlesSerializer());

        $articles = $manager->createData($resource)->toArray();
        $count = count($articles['articles']);

        return array_add($articles, "count", $count);
    }
}
