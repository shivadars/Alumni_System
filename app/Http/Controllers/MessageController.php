<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of conversations.
     */
    public function index()
    {
        $conversations = $this->getConversations();
        return view('messages.index', compact('conversations'));
    }

    /**
     * Display the specified conversation.
     */
    public function show(User $user)
    {
        $userId = Auth::id();
        
        // Mark messages from this user as read
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Get chat history
        $messages = Message::where(function($q) use ($userId, $user) {
                $q->where('sender_id', $userId)->where('receiver_id', $user->id);
            })
            ->orWhere(function($q) use ($userId, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        $conversations = $this->getConversations();

        return view('messages.show', compact('user', 'messages', 'conversations'));
    }

    /**
     * Get the list of conversations for the current user.
     */
    protected function getConversations()
    {
        $userId = Auth::id();
        
        // Get unique user IDs of people we've chatted with
        $sharedUserIds = DB::table('messages')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->select(DB::raw('CASE WHEN sender_id = ' . $userId . ' THEN receiver_id ELSE sender_id END as user_id'))
            ->distinct()
            ->pluck('user_id');

        return User::whereIn('id', $sharedUserIds)
            ->with(['profile'])
            ->get()
            ->map(function ($contact) use ($userId) {
                // Fetch the latest message
                $contact->last_message = Message::where(function($q) use ($userId, $contact) {
                        $q->where('sender_id', $userId)->where('receiver_id', $contact->id);
                    })
                    ->orWhere(function($q) use ($userId, $contact) {
                        $q->where('sender_id', $contact->id)->where('receiver_id', $userId);
                    })
                    ->latest()
                    ->first();
                return $contact;
            })
            ->sortByDesc(function ($contact) {
                return $contact->last_message ? $contact->last_message->created_at->timestamp : 0;
            });
    }

    /**
     * Store a newly created message.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);

        $user->notify(new \App\Notifications\NewMessageNotification(Auth::user()->name, $message->content, Auth::id()));

        return back()->with('status', 'Message sent!');
    }
}
