<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationContorller extends Controller
{
    public function markAsRead($id)
    {

        auth()->user()->unreadNotifications()->find($id)->markAsRead();
        return back();
    }
    public function markAllAsRead()
    {

        auth()->user()->unreadNotifications->map(function ($n) {
            $n->markAsRead();
        });
        return back();
    }
}
