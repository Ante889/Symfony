<?php

namespace App\Services;

class GiftsServices{

    public $gifts= ['flowers','car','piano','money'];

    public function __construct()
    {
        shuffle($this->gifts);
    }
}