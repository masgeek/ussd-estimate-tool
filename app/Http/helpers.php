<?php
function notify($isSuccess, $title, $message)
{

    \Jleon\LaravelPnotify\Notify::success($message, $title)->override([
        'addclass' => $isSuccess ? 'bg-success' : 'bg-warning',
    ]);
}

function randomColor()
{
    $colors = [
        'bg-teal-400',
        'bg-orange-400',
        'bg-pink-400',
        'bg-blue-400',
        'bg-violet-400',
        'bg-indigo-400',
        'bg-warning-400',
    ];
    return $colors[array_rand($colors)];

}

function abort403()
{
    abort(403, json_encode([
        'status' => 'failed',
        'message' => 'Forbidden, you do not have enough permission to perform this action'
    ]));
}

function transformSuccess($message = null, $data = null)
{
    return [
        "message" => $message,
        "data" => $data
    ];
}

function transformErrors($message = null, $errors = null, $encode = false)
{
    $response = [
        "message" => $message,
        "errors" => $errors
    ];

    return $encode ? json_encode($response) : $response;
}
