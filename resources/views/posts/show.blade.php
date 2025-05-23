<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-post-card :post="$post" />
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('posts.make_a_comment') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('posts.what_do_you_think') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('comment', $post) }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-textarea id="comment" name="comment" class="mt-1 block w-full h-32 resize-none" :value="old('comment')" required autofocus autocomplete="comment"></x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('posts.comment') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>

                @foreach($comments as $comment)
                    <div class="border-t border-gray-200 relative p-6 text-gray-900">
                        <section>
                            <header>
                                <div class="inline">
                                    <img src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full inline">

                                    <a href="{{ route('profile', $comment->user->username) }}"><h2 class="inline ml-1 text-lg font-medium text-indigo-400">{{ $comment->user->name }}<span class="ml-2 text-sm font-medium text-gray-900">{{ __('@') . $comment->user->username }}</span></h2></a>
                                </div>
                                <span class="mt-1 text-sm text-gray-600">
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </header>

                            <div class="mt-4">
                                <p>{{ $comment->comment }}</p>
                            </div>

                            @if ($comment->user->is(auth()->user()))
                                <div class="mt-3 absolute top-4 right-6">
                                    <a href="{{ route('edit-comment', $comment) }}" class="text-indigo-400"><img class="w-6" src="{{ asset('images/icons/edit.svg') }}" alt="Edit Comment" /></a>
                                </div>
                            @endif
                        </section>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
