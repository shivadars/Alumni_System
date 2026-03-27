<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::with('user')->where('event_date', '>=', now())->orderBy('event_date', 'asc')->get();
        $pastEvents = Event::with('user')->where('event_date', '<', now())->orderBy('event_date', 'desc')->paginate(10);
        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function show(Event $event)
    {
        $otherEvents = Event::where('id', '!=', $event->id)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        $isAttending = $event->attendees()->where('user_id', auth()->id())->exists();
        $attendeeCount = $event->attendees()->count();

        return view('events.show', compact('event', 'otherEvents', 'isAttending', 'attendeeCount'));
    }

    public function attend(Event $event)
    {
        $user = auth()->user();

        if ($event->attendees()->where('user_id', $user->id)->exists()) {
            // Already attending — toggle off
            $event->attendees()->detach($user->id);
            $message = 'You are no longer attending this event.';
        } else {
            // Not attending — toggle on
            $event->attendees()->attach($user->id);
            $message = 'You are now attending this event!';
        }

        return back()->with('success', $message);
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'alumni', 'department'])) {
            abort(403);
        }
        return view('events.create');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'alumni', 'department'])) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after:now',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function destroy(Event $event)
    {
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}
