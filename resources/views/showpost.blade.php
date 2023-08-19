<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-12">
                    @if(Auth::check() && Auth::user()->id === $post->author_id)
                        <!-- Post Update Form -->
                        <form method="POST" action="{{ route('posts.update', $post) }}">
                            @csrf
                            @method('PUT')

                            <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                                <h1 class="text-3xl font-bold mb-6">
                                    <input type="text" name="title" value="{{ $post->title }}" class="w-full p-2 rounded-lg dark:bg-gray-800 border-gray-300" required autofocus>
                                </h1>
                                <div class="border-t-2 border-gray-300 dark:border-gray-600 pt-4">
                                    <textarea name="content" class="w-full p-2 rounded-lg dark:bg-gray-800 border-gray-300" rows="10" required>{{ $post->content }}</textarea>
                                </div>
                                <div class="flex items-center gap-4 mt-4">
                                    <x-primary-button type="submit">{{ __('Update') }}</x-primary-button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                            <h1 class="text-3xl font-bold mb-6">{{ $post->title }}</h1>
                            <div class="border-t-2 border-gray-300 dark:border-gray-600 pt-4">
                                <div class="text-xl mb-8">{!! $post->content !!}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="min-h-screen py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-12">
                            <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                                <h2 class="text-xl font-bold mb-4">Comments</h2>
                                <ul>
                                @foreach ($post->comments as $comment)
                                <div class="py-4 bg-white-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                                        <div class="p-4">
                                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">By {{ $comment->user->name }}</div>
                                            <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                                        </div>
                                        @auth
                                            @if ($comment->user_id === auth()->user()->id)
                                                <div class="flex justify-end p-4">
                                                    <form action="{{ route('comments.delete', ['comment' => $comment]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button type="submit">Delete</x-danger-button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                                </ul>
                            </div>
                            @auth
                                <!-- Comment Form -->
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="py-12">
                                        <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                                            <form method="POST" action="{{ route('comments.comment', $post) }}">
                                                @csrf
                                                <div class="my-4">
                                                    <label for="comment" class="block font-bold mb-1">Leave a comment:</label>
                                                    <textarea name="comment_content" id="comment" rows="4" class="w-full p-2 rounded-lg dark:bg-gray-800 border-gray-300" required></textarea>
                                                </div>
                                                <x-primary-button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"> Comment</x-primary-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="my-4 text-center">You must be logged in to leave a comment.</p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</x-app-layout>