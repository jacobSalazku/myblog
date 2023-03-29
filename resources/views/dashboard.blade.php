<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        @if (Auth::check())
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("Create a new Post") }}
                            
                                <form method="POST" action="{{ route('posts.submit') }}">
                                    @csrf
                                    <!-- Name -->
                                    <div>
                                        <x-input-label for="name" :value="__('title')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required  />
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <x-input-label for="email" :value="__('Content')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="content" :value="old('content')" required  />
                                 
                                    </div>
                                    <br>
                                    <x-primary-button class="ml-2 py-12 ">
                                    {{ __('Add Post ') }}
                                    </x-primary-button>
                                </form>
                                
                            </div>
                        </div>
                </div>
            </div>
        @endif 
          
        @foreach ($posts as $post)
    <div class="py-12">
         <div class="p-6 text-gray-900 dark:text-gray-100">
            <span class=" dark:text-gray-100">By {{ $post->author->name }}</span>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border border-gray-200 rounded-lg rounded-b-none bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold"><a href="{{ route('posts.showpost', $post) }}">{{ $post->title }}</a></h3>
                        <div class="mt-4">
                            <p class="text-gray-700 dark:text-gray-300">{{ $post->content }}</p>
                        </div>   
                    </div>
                    <div class="py-4 px-6 pb-6 pt-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center">
                        <form action="{{ route('posts.like', $post->id) }}" method="post">
                            @csrf
                            <button type="submit" class="bg-white border border-gray-300 rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:border-gray-400">
                                {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'Unlike' : 'Like' }}
                            </button>
                        </form>
                        <span class="ml-4 font-bold text-white">{{ $post->likes()->count() }} {{ Str::plural('like', $post->likes()->count()) }}</span>
                    </div>
                    
                </div>
            </div>  
        </div>
    </div>
@endforeach
            
</x-app-layout>

