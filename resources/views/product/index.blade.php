<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
$categoryList = \App\Models\Category::getActiveAsTree();
?>

<x-app-layout>
    <x-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4" />
    <div class="bg-gray-900">
        <div class="flex gap-2 items-center p-3 pb-0" x-data="{
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
            <form action="" method="GET" class="flex-1 relative" @submit.prevent="updateUrl">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <!-- Add your logo SVG or image here -->
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" viewBox="0 0 50 50">
                        <path
                            d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
                        </path>
                    </svg>
                </div>
                <x-input type="text" name="search" placeholder="Search for products" x-model="searchKeyword"
                    autocomplete="off" class="pl-10" />
            </form>
            <x-input x-model="selectedSort" @change="updateUrl" type="select" name="sort"
                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                <option value="price">Price (ASC)</option>
                <option value="-price">Price (DESC)</option>
                <option value="title">Title (ASC)</option>
                <option value="-title">Title (DESC)</option>
                <option value="-updated_at">Last Modified at the top</option>
                <option value="updated_at">Last Modified at the bottom</option>
            </x-input>
        </div>

        <div class="h-screen h-full min-h-screen py-3">

            <?php if ( $products->count() === 0 ): ?>
            <div class="text-center text-white py-16 text-xl">
                There are no products published
            </div>
            <?php else: ?>
            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 p-3">
                @foreach ($products as $product)
                    <!-- Product Item -->
                    <div x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image ?: '/img/noimage.png',
                        'title' => $product->title,
                        'price' => $product->price,
                        'quantity' => $product->quantity,
                        'addToCartUrl' => route('cart.add', $product),
                    ]) }})"
                        class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white">
                        <a href="{{ route('product.view', $product->slug) }}"
                            class="aspect-w-3 aspect-h-2 block overflow-hidden relative">
                            <img :src="product.image" alt=""
                                class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform" />
                            @if ($activeEvent)
                                <div class="absolute bottom-0 left-0 right-0 text-white p-4"
                                    style="
                        background: linear-gradient(
                            to top left,
                            rgba(0, 0, 0, 0),
                            rgba(0, 0, 0, 1)
                        );
                    ">
                                    <p class="font-bold text-lg mb-2 error-message">
                                        {{ $activeEvent->name }}
                                    </p>
                                    <p class="font-bold text-lg mb-2 error-message">
                                        -{{ $activeEvent->percentage }}%
                                    </p>
                                </div>
                            @endif
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-bold">{{ $product->title }}</h3>
                            <p>
                                <span class="font-bold">Code: </span>
                                <span>{{ $product->product_code }}</span>
                                <span class="font-bold" style="float: right; margin-right: 50px">Stock:
                                    <span class="error-message">{{ $product->quantity }}</span></span>
                            </p>
                            <p>
                                <span
                                    class="font-bold @if ($activeEvent) line-through @endif">₱{{ $product->price }}</span>
                                @if ($activeEvent)
                                    <span class="font-bold">→
                                        <span
                                            class="error-message">₱{{ number_format($product->price - $product->price * ($activeEvent->percentage / 100), 2) }}</span></span>
                                @endif
                            </p>
                        </div>
                        <div class="flex justify-between py-3 px-4">
                            <button class="btn-primary bg-cyan-600" @click="addToCart()">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <!--/ Product Item -->
                @endforeach
            </div>
            {{ $products->appends(['sort' => request('sort'), 'search' => request('search')])->links() }}
            <?php endif; ?>
        </div>
    </div>
</x-app-layout>

<style scoped>
    .error-message {
        color: #dc3545;
        /* Red color */
    }
</style>
