<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function get()
    {
        return view('auth');
    }

    public function post(Request $request)
    {
        $name = $request->input('name');
        $message = [
            'name' => 'System',
            'body' => "$name joined.",
            'new_name' => $name,
        ];
        $message_json = json_encode($message);
        Redis::rpush('chat', $message_json);
        Redis::publish('chat', $message_json);
        Redis::rpush('name', $name);
        return redirect('/');
    }
}
