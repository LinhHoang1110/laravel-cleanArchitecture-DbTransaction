<?php

namespace App\Repositories;

use App\Interfaces\ITransactionMiddlewareRepository;
use App\Interfaces\ITransactionRepository;
use Illuminate\Support\Facades\DB;
use Closure;

class DbTransactionMiddlewareRepository implements ITransactionMiddlewareRepository
{
    public function dbTransaction($request, Closure $next)
    {
        DB::beginTransaction();

        try {
            $response = $next($request);

            DB::commit();

            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
