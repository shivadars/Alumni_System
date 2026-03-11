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
            
        return view('events.show', compact('event', 'otherEvents'));
    }

    public function create()
    {
        // Only Admin, Alumni, or Department can create events
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
