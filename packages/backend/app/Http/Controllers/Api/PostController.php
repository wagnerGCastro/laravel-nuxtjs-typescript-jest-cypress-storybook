<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PostStoreUpdate;
use App\Models\Post;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = $this->post->all();
            // $posts = $this->post->where('user_id', auth('api')->user()->id)->get();

        } catch (\Exception $e) {
            return response()->json([
                'error'=> 'Error internal server!',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'posts' =>  $posts,
            // 'authors' => $authors
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreUpdate $request)
    {
        $request->validated();

        try {
            $post = $this->post->create($request->all());

        } catch (\Exception $e) {
            return response()->json([
                'error'=> 'Error internal server!',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(compact('post') , Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  Post  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $id)
    {
        return response()->json($id, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreUpdate $request, $id)
    {
        $request->validated();

        try {
            $this->post->where('id', $id)->update($request->all());

        } catch (\Exception $e) {
            return response()->json([
                'error'=> 'Error internal server!',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json('Post successfully updated!', Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
