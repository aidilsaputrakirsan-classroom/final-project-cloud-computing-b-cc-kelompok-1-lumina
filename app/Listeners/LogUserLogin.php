<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogUserLogin
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event)
    {
        ActivityLog::create([
            'user_id'     => $event->user->id,
            'action'      => 'Login',
            'description' => 'User masuk ke sistem',
            'details'     => 'IP: ' . $this->request->ip(),
        ]);
    }
}