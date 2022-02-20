<?php

namespace App\Http\Controllers;

use App\Http\Resources\General\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'comments' => CommentResource::collection(Comment::orderBy('id','desc')->paginate(3)),
            'comments_slider' => CommentResource::collection(Comment::inRandomOrder()->paginate(5))
        ]);
    }



}
