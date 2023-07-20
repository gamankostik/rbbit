<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Transaction;
use App\Service\CoinService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class HomeController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function address()
    {
        return view('address');
    }

    public function transaction()
    {
        return view('transaction');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $type = $request->input('type');
        $coin = CoinService::getByType($type);

        if (!$coin) {
            return response()->json();
        }

        Address::create([
            'type' => $type,
            'hash' => $coin->hash,
            'letter_code' => $letterCode = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 4),
            'number_code' => $numberCode = rand(1000, 9999),
        ]);

        $coin->update(['enabled' => false]);

        if (!CoinService::enabledCoinExists()) {
            CoinService::activateAll();
        }

        return [
            'value1' => $coin->hash,
            'value2' => $letterCode,
            'value3' => $numberCode,
        ];
    }

    public function check(Request $request)
    {
        $request->validate([
            'address_from' => 'required',
            'address_to' => 'required',
            'amount' => 'required',
        ]);

        $data = $request->all();
        $coin = CoinService::getByHash($data['address_from']);
        $success = true;
        $message = '';
        if (!$coin) {
            $success = false;
            $message = sprintf('Wrong address_from %s', $data['address_from']);
        } elseif ($coin->used_at !== null) {
            $success = false;
            $message = sprintf('Address_from %s already used', $data['address_from']);
        } elseif ((int)$request['amount'] > $coin->amount) {
            $success = false;
            $message = sprintf('Wrong amount %s - correct: %s', $request['amount'], $coin->amount);
        }

        $coin->update(['used_at' => new \DateTime(), 'success' => false]);

        Transaction::create([
            'type' => $coin->type,
            'amount' => $request['amount'],
            'address_from' => $request['address_from'],
            'address_to' => $request['address_to'],
            'success' => $success,
            'message' => $message,
        ]);

        return response()->json([], $success ? 200 : 400);
    }
}
