<x-app-layout>
    <div class="py-8 h-[calc(100vh-64px)] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden flex h-full">
                
                <!-- Sidebar (Left Column) -->
                <div class="hidden md:flex w-80 lg:w-96 border-r border-slate-100 flex-col bg-slate-50/30">
                    <!-- Search Header -->
                    <div class="p-6 border-b border-slate-100 bg-white">
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" placeholder="Search messages..." class="block w-full pl-10 pr-4 py-2 bg-slate-100/50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all placeholder:text-slate-400">
                        </div>
                    </div>

                    <!-- Conversations List -->
                    <div class="flex-grow overflow-y-auto">
                        @foreach($conversations as $conversation)
                            <a href="{{ route('messages.show', $conversation->id) }}" class="flex items-center gap-4 p-5 hover:bg-white hover:shadow-sm transition-all border-b border-slate-50 group {{ $user->id == $conversation->id ? 'bg-white shadow-sm ring-1 ring-slate-100' : '' }}">
                                <div class="relative flex-shrink-0">
                                    @if($conversation->profile && $conversation->profile->profile_picture)
                                        <img src="{{ asset('storage/' . $conversation->profile->profile_picture) }}" alt="{{ $conversation->name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-white">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 font-bold border-2 border-white">
                                            {{ substr($conversation->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-bold text-slate-900 truncate">{{ $conversation->name }}</h4>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase">
                                            {{ $conversation->last_message ? $conversation->last_message->created_at->format('H:i') : '' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center pr-2">
                                        <p class="text-[11px] font-medium text-slate-500 truncate mt-0.5 max-w-[180px] {{ $user->id == $conversation->id ? 'text-slate-900' : '' }}">
                                            {{ $conversation->last_message ? $conversation->last_message->content : 'Start a conversation...' }}
                                        </p>
                                        @php
                                            $unreadCount = \App\Models\Message::where('sender_id', $conversation->id)
                                                ->where('receiver_id', Auth::id())
                                                ->where('is_read', false)
                                                ->count();
                                        @endphp
                                        @if($unreadCount > 0)
                                            <span class="bg-blue-600 text-white text-[9px] font-black w-4 h-4 flex items-center justify-center rounded-full shadow-lg shadow-blue-200 ring-2 ring-white">
                                                {{ $unreadCount }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Main Chat Window (Right Column) -->
                <div class="flex-grow flex flex-col bg-white">
                    <!-- Chat Header -->
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('messages.index') }}" class="md:hidden text-slate-400 hover:text-slate-600 mr-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            </a>
                            <div class="relative">
                                @if($user->profile && $user->profile->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-slate-50">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold border border-slate-200">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 tracking-tight leading-none mb-1">{{ $user->name }}</h3>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-slate-400">
                            <!-- Icons removed as requested -->
                        </div>
                    </div>

                    <!-- Chat Messages Area -->
                    <div class="flex-grow p-8 overflow-y-auto space-y-6 bg-slate-50/20" id="chat-messages">
                        @forelse($messages as $message)
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
                        @empty
                            <div class="flex flex-col items-center justify-center h-full text-center py-12">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100 shadow-inner">
                                    <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                </div>
                                <h4 class="text-slate-900 font-black">Start of a new journey</h4>
                                <p class="text-xs text-slate-400 mt-1">Send your first message to {{ $user->name }}</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Message Input Area -->
                    <div class="p-6 bg-white border-t border-slate-100">
                        <form method="POST" action="{{ route('messages.store', $user->id) }}" class="flex items-center gap-4">
                            @csrf
                            <div class="relative flex-grow">
                                <input name="content" type="text" placeholder="Type your message..." class="block w-full py-3 px-5 bg-slate-100/50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/10 focus:bg-white transition-all placeholder:text-slate-400 shadow-inner" required autocomplete="off">
                            </div>
                            <button type="submit" class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center hover:bg-black transition-all shadow-lg shadow-slate-200">
                                <svg class="w-5 h-5 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</x-app-layout>
