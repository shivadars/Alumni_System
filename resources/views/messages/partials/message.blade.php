<div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
    <div class="max-w-[75%]">
        <div class="px-5 py-3 rounded-3xl shadow-sm text-sm {{ $message->sender_id == Auth::id() ? 'bg-slate-900 text-white rounded-br-none' : 'bg-white text-slate-700 border border-slate-100 rounded-bl-none' }}">
            {{ $message->content }}
        </div>
        <span class="text-[10px] font-bold text-slate-400 mt-2 block {{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
            {{ $message->created_at->format('H:i') }}
        </span>
    </div>
</div>
