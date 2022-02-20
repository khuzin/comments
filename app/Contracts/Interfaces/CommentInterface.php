<?php


namespace App\Contracts\Interfaces;


interface CommentInterface
{
    const USER_ID = 'user_id';
    const VALUE = 'value';


    const FILLABLE = [
      self::USER_ID,
      self::VALUE
    ];
}
