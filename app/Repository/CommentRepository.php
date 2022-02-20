<?php


namespace App\Repository;


use App\Contracts\Interfaces\CommentInterface;
use App\Http\Requests\General\Store\CommentRequest;
use App\Http\Resources\General\CommentResource;
use App\Models\Comment;
use App\Repository\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function store(CommentRequest $request)
    {
        // TODO: Implement store() method.

        return response(new CommentResource(Comment::create(array_merge($request->validated(), [
            CommentInterface::USER_ID => $request->user()->id
        ]))), 201);
    }
}
