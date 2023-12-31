<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

interface ITransactionRepository
{
    public function dbTransaction($callback);
}
