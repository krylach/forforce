<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Clients\Client;
use App\Models\Clients\Number;
use Faker\Factory as Faker;
use App\Http\Resources\ClientResource;

class ClientController extends Controller
{
    public function index(Client $clients)
    {
        return ClientResource::collection($clients->paginate(10));
    }

    public function get(Client $client)
    {
        return new ClientResource($client);
    }

    public function clear(Client $client)
    {
        if ($client) {
            $numbers = $client->numbers();
            $numbers->delete();
            $numbers->detach();

            $client->name = null;
            $client->birthday = null;
            $client->save();
        }

        return new ClientResource($client);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'birthday' => 'required|date'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $client = Client::create([
            'name' => $request->name,
            'birthday' => $request->birthday
        ]);

        return new ClientResource($client);
    }

    public function newNumber(Client $client, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'operator_id' => 'required|exists:operators,id',
            'number' => 'required|min:7|max:7|unique:numbers'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $number = Number::create([
            'operator_id' => $request->operator_id,
            'number' => $request->number,
            'balance' => 0
        ]);

        $client->numbers()->attach($number->id);

        return $number;
    }
}
