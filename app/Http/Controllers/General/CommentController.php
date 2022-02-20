<?php

namespace App\Http\Controllers\General;

use App\Contracts\Interfaces\CommentInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Store\CommentRequest;
use App\Http\Resources\General\CommentResource;
use App\Models\Comment;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    private $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function store(CommentRequest $request)
    {
        return $this->commentRepository->store($request);
    }

    public function index(Request $request)
    {
        return CommentResource::collection(Comment::where(function ($query) use ($request) {
            if ($request->has('user_id'))
                $query->where(CommentInterface::USER_ID, $request->user_id);
        })->orderBy('id', 'desc')->paginate(3));
    }
}
