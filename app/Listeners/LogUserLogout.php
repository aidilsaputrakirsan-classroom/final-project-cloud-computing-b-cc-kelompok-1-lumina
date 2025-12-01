<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogUserLogout
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Logout $event)
    {
        if ($event->user) {
            ActivityLog::create([
                'user_id'     => $event->user->id,
                'action'      => 'Logout',
                'description' => 'User keluar sistem',
                'details'     => 'IP: ' . $this->request->ip(),
            ]);
        }
    }
}