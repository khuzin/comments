<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\General\Store\CommentRequest;

interface CommentRepositoryInterface
{
    public function store(CommentRequest $request);
}
