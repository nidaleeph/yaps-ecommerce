<?php
/** @var \Illuminate\Database\Eloquent\Collection $watch */
$categoryList = \App\Models\CategoryWatch::getActiveAsTree();
$live_flag = \App\Models\YoutubeFlag::all()->first();
?>

<x-app-layout>

    <x-watch-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4" />
    <div style="background-image: url('{{ asset('img/watch 1-hero.jpg') }}'); background-size: cover; " class="bg-fixed">
        <div class=" mx-auto flex flex-wrap gap-2 items-center justify-center p-3 pb-0" x-data="{
            selectedSort: '{{ request()->get('sort', '-updated_at') }}',
            searchKeyword: '{{ request()->get('search') }}',
            updateUrl() {
                const params = new URLSearchParams(window.location.search)
                if (this.selectedSort && this.selectedSort !== '-updated_at') {
                    params.set('sort', this.selectedSort)
                } else {
                    params.delete('sort')
                }
        
                if (this.searchKeyword) {
                    params.set('search', this.searchKeyword)
                } else {
                    params.delete('search')
                }
                window.location.href = window.location.origin + window.location.pathname + '?' +
                    params.toString();
            }
        }">

            <form action="" method="GET" class="flex-auto relative" @submit.prevent="updateUrl">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <!-- Add your logo SVG or image here -->
                    <svg xmlns="http://www.w3.org/2000/svg" x=" 0px" y="0px" width="20" viewBox="0 0 50 50">
                        <path
                            d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
                        </path>
                    </svg>
                </div>
                <x-input type="text" name="search" placeholder="Search for content" x-model="searchKeyword"
                    autocomplete="off" class="pl-10" />
            </form>

            <x-input x-model="selectedSort" @change="updateUrl" type="select" name="sort"
                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                {{-- <option value="price">Price (ASC)</option>
            <option value="-price">Price (DESC)</option> --}}
                <option value="title">Title (ASC)</option>
                <option value="-title">Title (DESC)</option>
                <option value="-updated_at">Last Modified at the top</option>
                <option value="updated_at">Last Modified at the bottom</option>
            </x-input>
        </div>

        {{-- <div class="flex items-center justify-center w-full h-full">
        <div class="mx-auto w-auto my-10">
            <div class="fb-video my-10" data-href="https://www.facebook.com/acmalakas01/live" data-show-text="false"
                data-allowfullscreen="true" data-autoplay="true" data-width="1080">
            </div>
        </div>
    </div> --}}

        <div class=" min-h-screen py-3" id="player-title">
            <?php if ($watch->count() === 0): ?>
            <div class="text-center text-white py-16 text-xl">
                There are no content published
            </div>
            <?php else: ?>
            @if ($live_flag->live_flag)
                @php
                    $parameters = request()->query();
                    $urlPath = request()->path();
                @endphp
                @if (empty($parameters) && $urlPath == 'watch')
                    <div class="container mx-auto flex flex-col items-center justify-center mx-4 py-5">
                        <h1 class="text-center text-white text-2xl flex items-center order-1 font-poppin">LIVE</h1>
                        <div id="player" class="order-2">
                        </div>
                        <h1 class="text-center text-white text-2xl flex items-center order-3 font-poppin pt-4">Watch
                            other
                            content</h1>
                    </div>
                @endif
            @endif
            <script>
                let player;
                const videoId = {!! json_encode($live_flag->video_id) !!}; // Use json_encode to ensure proper formatting

                function onYouTubeIframeAPIReady() {
                    player = new YT.Player('player', {
                        // width: '70%', // Full width of the container
                        height: '400px',
                        width: '100%',
                        videoId: videoId,
                        playerVars: {
                            controls: 1, // Hide video controls
                            disablekb: 1, // Disable keyboard control
                            autoplay: 1, // Autoplay the video
                            loop: 0, // Do not loop the video
                            modestbranding: 1, // Hide YouTube logo
                            playsinline: 1, // Play inline on mobile devices
                            rel: 0 // Disable related videos
                        },
                    });
                }
            </script>
            <div class="container mx-auto grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($watch as $watchItem)
                    <!-- Change the loop variable name -->
                    <!-- Product Item -->
                    <!-- Product Item -->
                    <div x-data="{
                        id: {{ $watchItem->id }},
                        slug: '{{ $watchItem->slug }}',
                        image: '{{ $watchItem->image ?: '/img/noimage.png' }}',
                        title: '{{ $watchItem->title }}',
                    }" {{-- class="border border-1 border-gray-200 rounded-lg hover:border-purple-600 transition-colors text-white"> --}}
                        class=" rounded-lg hover:border-purple-600 transition-colors text-white text-center">

                        <a href="{{ route('watch.view', $watchItem->slug) }}"
                            class="aspect-w-4 aspect-h-3 block overflow-hidden relative">
                            <img :src="image" alt="{{ $watchItem->title }}"
                                class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform" />
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-bold">{{ $watchItem->title }}</h3>
                        </div>
                    </div>
                    <!--/ Product Item -->

                    <!--/ Product Item -->
                @endforeach
            </div>
            {{ $watch->appends(['sort' => request('sort'), 'search' => request('search')])->links() }}
            <?php endif; ?>
        </div>
    </div>
</x-app-layout>

<style scoped>
    .error-message {
        color: #dc3545;
        /* Red color */
    }

    /* Small screens (sm) */
    @media (min-width: 640px) {
        #player {
            height: 400px;
            width: 100%;
        }
    }

    /* Medium screens (md) */
    @media (min-width: 768px) {
        #player {
            height: 400px;
            width: 100%;

        }
    }

    /* Large screens (lg) */
    @media (min-width: 1024px) {
        #player {
            height: 500px;
            width: 100%;
        }
    }

    /* Extra-large screens (xl) */
    @media (min-width: 1280px) {
        #player {
            height: 600px;
            width: 75%;
        }
    }

    /* 2x-large screens (2xl) */
    @media (min-width: 1536px) {
        #player {
            height: 700px;
            width: 75%;
        }
    }
</style>
