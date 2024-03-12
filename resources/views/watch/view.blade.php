<x-app-layout>
    <div x-data="watchItem({{ json_encode([
        'id' => $watch->id,
        'slug' => $watch->slug,
        'image' => $watch->image ?: '/img/noimage.png',
        'title' => $watch->title,
        'url' => $watch->url,
    ]) }})" class="container mx-auto">
        <div class="grid gap-6 grid-cols-1 lg:grid-cols-5">
            <div class="lg:col-span-3">
                <div x-data="{
                    images: {{ $watch->images->count() ? $watch->images->map(fn($im) => $im->url) : json_encode(['/img/noimage.png']) }},
                    url: '{{ $watch->url }}',
                    activeImage: null,
                    prev() {
                        let index = this.images.indexOf(this.activeImage);
                        if (index === 0)
                            index = this.images.length;
                        this.activeImage = this.images[index - 1];
                    },
                    next() {
                        let index = this.images.indexOf(this.activeImage);
                        if (index === this.images.length - 1)
                            index = -1;
                        this.activeImage = this.images[index + 1];
                    },
                    init() {
                        this.activeImage = this.images.length > 0 ? this.images[0] : null
                    }
                }">
                    @if (str_contains($watch->url, 'youtube'))
                        <div class="mx-auto w-auto  aspect-w-3 aspect-h-2 my-10">
                            <iframe src="{{ $watch->url }}" frameborder="0"
                                allow="accelerometer; autoplay:1; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    @elseif (str_contains($watch->url, 'fb.watch') || str_contains($watch->url, 'facebook'))
                        <div class="fb-video my-10" data-href="{{ $watch->url }}" data-show-text="false"
                            data-allowfullscreen="true" data-autoplay="true">
                        </div>
                    @endif
                    <div class="relative">
                        <h1 class="text-4xl font-bold slide-down text-center mb-2">Thumbnails</h1>
                        <template x-for="image in images">
                            <div x-show="activeImage === image" class="aspect-w-3 aspect-h-2">
                                <img :src="image" alt="" class="w-auto mx-auto" />
                            </div>
                        </template>
                        <a @click.prevent="prev"
                            class="cursor-pointer bg-black/30 text-white absolute left-0 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d=" M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <a @click.prevent="next"
                            class="cursor-pointer bg-black/30 text-white absolute right-0 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex">
                        <template x-for="image in images">
                            <a @click.prevent="activeImage = image"
                                class="cursor-pointer w-[80px] h-[80px] border border-gray-300 hover:border-purple-500 flex items-center justify-center"
                                :class="{ 'border-purple-600': activeImage === image }">
                                <img :src="image" alt="" class="w-auto max-auto max-h-full" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 mt-10">
                <h1 class="text-lg font-semibold">{{ $watch->title }}</h1>

                <h1 class="text-md ">{{ $watch->subtitle }}</h1>


                <div class="mb-6" x-data="{ expanded: false }">
                    <div x-show="expanded" x-collapse.min.400px class="text-gray-500 wysiwyg-content">
                        {!! $watch->description !!}
                    </div>

                    <p class="text-right">
                        <a @click="expanded = !expanded" href="javascript:void(0)"
                            class="text-purple-500 hover:text-purple-700"
                            x-text="expanded ? 'Read Less' : 'Read More'"></a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<style scoped>
    .error-message {
        color: #dc3545;
        /* Red color */
    }
</style>
