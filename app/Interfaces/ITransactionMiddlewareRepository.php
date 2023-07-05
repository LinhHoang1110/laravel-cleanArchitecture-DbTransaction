<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Closure;

interface ITransactionMiddlewareRepository
{
    public function dbTransaction($request, Closure $next);
}
