<?php

namespace App\Service;

use App\Model\Coin;
use App\Model\Transaction;

class CoinService
{
    public static function getByType(string $type): ?Coin
    {
        return Coin::where(['type' => $type, 'enabled' => true])->first();
    }

    public static function getByHash(string $hash): ?Coin
    {
        return Coin::where(['hash' => $hash])->first();
    }

    public static function activateAll(): void
    {
        Coin::chunk(500, function ($coins) {
           foreach ($coins as $coin) {
               $coin->update(['enabled' => true, 'used_at' => null]);
           }
        });
    }

    public static function enabledCoinExists(): bool
    {
        return Coin::where(['enabled' => true])->exists();
    }

    public static function transaction(string $hash): ?Transaction
    {
        return Transaction::where(['address_from' => $hash, 'success' => true])->first();
    }
}
