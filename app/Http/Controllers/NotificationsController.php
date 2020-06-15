<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }
 
    public function notifications()
    {
        return response([
            'read' => NotificationResource::collection(auth()->user()->readNotifications),
            'unread' => NotificationResource::collection(auth()->user()->unreadNotifications),
        ]);
    }

    public function markAsRead(Request $request) 
    {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
    
    }
}
