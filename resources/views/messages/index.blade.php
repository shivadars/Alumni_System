<x-app-layout>
    <div class="py-8 h-[calc(100vh-80px)] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden flex h-full">
                
                <!-- Sidebar (Left Column) -->
                <div class="w-full md:w-80 lg:w-96 border-r border-slate-100 flex flex-col bg-[#F3F2EF]/30">
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
                        @forelse($conversations as $conversation)
                            <a href="{{ route('messages.show', $conversation->id) }}" class="flex items-center gap-4 p-5 hover:bg-white hover:shadow-sm transition-all border-b border-slate-50 group">
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
                                        <p class="text-[11px] font-medium text-slate-500 truncate mt-0.5 max-w-[180px]">
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
                        @empty
                            <div class="p-8 text-center text-slate-400">
                                <p class="text-sm">No conversations yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Main Content (Right Column - Empty State) -->
                <div class="hidden md:flex flex-grow flex-col items-center justify-center bg-white p-12 text-center">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 border border-slate-100 shadow-inner">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">Select a Message</h3>
                    <p class="text-sm text-slate-500 max-w-xs leading-relaxed">Choose a conversation from the sidebar to view messages or start a new chat with our alumni.</p>
                    <a href="{{ route('alumni.search') }}" class="mt-8 px-6 py-2.5 bg-slate-900 text-white text-xs font-black rounded-full hover:bg-black transition-all shadow-lg shadow-slate-200 tracking-widest uppercase">
                        Find Alumni
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
