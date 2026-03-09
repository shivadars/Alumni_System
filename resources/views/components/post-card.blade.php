@props(['post'])

<div x-data="{ showComments: false }" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
    <!-- Post Author & Category -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            @if($post->user->profile && $post->user->profile->profile_picture)
                <img src="{{ asset('storage/' . $post->user->profile->profile_picture) }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-50 shadow-sm">
            @else
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            @endif
            <div>
                <a href="{{ route('profile.show', $post->user) }}" class="font-bold text-slate-900 text-[14px] leading-tight hover:text-blue-600 transition-colors">{{ $post->user->name }}</a>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ $post->created_at->format('M d, Y') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 text-[10px] font-bold rounded-full bg-blue-50 text-blue-700 uppercase tracking-widest border border-blue-100">
                {{ $post->category }}
            </span>
            @if(Auth::id() === $post->user_id || Auth::user()->role === 'admin')
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-full transition-colors" title="Delete Post">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Post Content -->
    <div class="mb-8">
        <h3 class="text-xl md:text-2xl font-black text-slate-900 mb-2 leading-tight">{{ $post->title }}</h3>
        <p class="text-slate-600 text-base md:text-lg leading-relaxed mb-4 whitespace-pre-wrap">{{ $post->content }}</p>
        @if($post->image)
            <div class="mt-4 rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>
        @endif

        @if($post->video)
            <div class="mt-4 rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-slate-900">
                <video controls class="w-full h-auto max-h-[500px]">
                    <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif
    </div>

    <!-- Post Interactions -->
    <div x-data="{ 
        liked: {{ $post->likes->where('user_id', auth()->id())->isNotEmpty() ? 'true' : 'false' }},
        likesCount: {{ $post->likes->count() }},
        toggleLike() {
            fetch('{{ route('posts.like.toggle', $post) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                this.liked = data.liked;
                this.likesCount = data.likes_count;
            })
            .catch(error => {
                console.error('Error toggling like:', error);
            });
        }
    }" class="flex items-center gap-6 pt-6 border-t border-slate-50 text-slate-400">
        <button @click="toggleLike()" type="button" class="flex items-center gap-2 hover:text-rose-600 transition-colors group px-1" :class="{ 'text-rose-600': liked }">
            <svg class="w-5 h-5" :class="{ 'fill-current': liked, 'group-hover:fill-current': !liked }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            <span class="font-bold text-sm" x-text="likesCount"></span>
        </button>
        <button @click="showComments = !showComments" class="flex items-center gap-2 hover:text-blue-600 transition-colors px-1" :class="{ 'text-blue-600': showComments }">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            <span class="font-bold text-sm">{{ $post->comments->count() }}</span>
        </button>
        <button class="flex items-center gap-2 hover:text-slate-900 transition-colors ml-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
            <span class="font-bold text-sm">Share</span>
        </button>
    </div>

    <!-- Comments Section -->
    <div x-show="showComments" style="display: none;" x-transition class="mt-8 pt-8 border-t border-slate-50">
        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-6 font-display">Comments</h4>
        
        <div class="space-y-6 mb-8">
            @forelse($post->comments as $comment)
                <div class="flex gap-4">
                    @if($comment->user->profile && $comment->user->profile->profile_picture)
                        <img src="{{ asset('storage/' . $comment->user->profile->profile_picture) }}" alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                    @else
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 text-slate-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif
                    <div class="flex-1">
                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/50">
                            <a href="{{ route('profile.show', $comment->user) }}" class="font-extrabold text-slate-900 text-[13px] mb-1 leading-tight hover:text-blue-600 transition-colors">{{ $comment->user->name }}</a>
                            <p class="text-slate-600 text-[13px] leading-relaxed">{{ $comment->content }}</p>
                        </div>
                        <p class="text-[9px] text-slate-400 font-black mt-2 ml-2 tracking-widest uppercase">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="py-4 text-center">
                    <p class="text-xs text-slate-400 font-bold italic tracking-wide">No comments yet. Share your thoughts!</p>
                </div>
            @endforelse
        </div>

        <!-- Comment Form -->
        <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="flex gap-4 mt-8">
            @csrf
            <div class="flex-1 relative">
                <textarea name="content" rows="1" class="w-full bg-slate-50/50 rounded-2xl border-slate-100 text-[13px] focus:ring-4 focus:ring-blue-50 focus:border-blue-400 focus:bg-white placeholder-slate-400 py-3.5 px-4 transition-all duration-300" placeholder="Write a comment..." required></textarea>
                <button type="submit" class="absolute right-2 top-2 p-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-md shadow-blue-100 group">
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
