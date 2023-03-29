
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

 
    
    </x-slot>


    @if(Auth::check() && Auth::user()->id === $post->author_id)  


    <form method="POST" action="{{ route('posts.update', $post) }}">
                    @csrf
                    @method('PUT')

                    <div class="min-h-screen py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="py-12"> 
                                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                                        <h1 class="text-3xl font-bold mb-6">
                                            <input type="text" name="title" value="{{ $post->title }}" class="w-full p-2 rounded-lg dark:bg-gray-800 border-gray-300" required autofocus>
                                        </h1>
                                        <div class="p-6 border-t-2 border-gray-300 dark:border-gray-600 pt-4">
                                            <textarea name="content" class="w-full p-2 rounded-lg dark:bg-gray-800 border-gray-00" rows="10" required>{{ $post->content }}</textarea>
                                        </div>
                                        <div class="flex items-center gap-4 ">
                                            <x-primary-button type='submit'>{{ __('Update') }}</x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </form>

            
        @else
   
        <div class= " min-h-screen py-12">
            <div class="dark:bg-gray-900">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="py-12"> 
                                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                                    <h1 class="text-3xl font-bold mb-6">{{ $post->title }}</h1>
                                <div class=" p-6 border-t-2 border-gray-300 dark:border-gray-600 pt-4">
                            
                                    <div>
                                        <div class="text-xl mb-8">{!! $post->content !!}</div>
                                    
                                    </div>
                                </div>
                            </div>
                         

                            </div>
                           
                        </div>
                                
                        </div>     
                        
                    </div>
                    
                </div>
            </div>
        
        </div>

        @endif

</x-app-layout>