<?php

namespace App\Repositories;

use App\Interfaces\ITransactionRepository;
use Illuminate\Support\Facades\DB;

class DbTransactionRepository implements ITransactionRepository
{

    public function dbTransaction($callback)
    {
        DB::beginTransaction();
        try {
            $result = $callback();

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
