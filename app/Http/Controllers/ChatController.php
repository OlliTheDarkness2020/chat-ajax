<?php

namespace App\Http\Controllers;

use DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    public function index()
    {
        $message_list = Redis::lrange('chat', -50, -1);
        $message_list = array_map(function($value) {
            return json_decode($value, true);
        }, $message_list);
        $name_list = Redis::lrange('name', -50, -1);
        return view('chat', [
            'message_list' => $message_list,
            'name_list' => $name_list,
        ]);
    }

    public function get()
    {
        Redis::subscribe(['chat'], function ($message) {
            $message = json_decode($message, true);
            $response = [
                'message' => view('chat.message', ['message' => $message])->render(),
            ];

            if (isset($message['new_name'])) {
                $response['new_name'] = view('chat.name', [
                    'name' => $message['new_name']
                ])->render();
            }
            echo json_encode($response);
            exit;
        });
    }

    public function post(Request $request)
    {
        $message = [
            'name' => $request->input('name'),
            'body' => $request->input('body'),
        ];
        $message_json = json_encode($message);
        Redis::rpush('chat', $message_json);
        Redis::publish('chat', $message_json);
        DebugBar::info(Redis::lrange('chat', 0, -1));
        return 'OK';
    }


}
