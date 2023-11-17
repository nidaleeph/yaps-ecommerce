<x-app-layout>
    <div class="container lg:w-2/3 xl:w-2/3 mx-auto">
        <h1 class="text-3xl font-bold mb-6">Your Cart Items</h1>

        <div x-data="{
            cartItems: {{
                json_encode(
                    $products->map(fn($product) => [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image ?: '/img/noimage.png',
                        'title' => $product->title,
                        'price' => $product->price,
                        'quantity' => $cartItems[$product->id]['quantity'],
                        'inStock' => $product->quantity,
                        'discount' => $activeEvent,
                        'discountedPrice' =>$activeEvent ? ($product->price - ($product->price * ($activeEvent->percentage/100))) : '',
                        'href' => route('product.view', $product->slug),
                        'removeUrl' => route('cart.remove', $product),
                        'updateQuantityUrl' => route('cart.update-quantity', $product)
                    ])
                )
            }},
            get cartTotal() {
                return this.cartItems.reduce((accum, next) => accum + next.price * next.quantity, 0).toFixed(2)
            },
            get cartTotalDiscount(){
                return this.cartItems.reduce((accum, next) => accum + next.discountedPrice * next.quantity, 0).toFixed(2)
            },
        }" class="bg-white p-4 rounded-lg shadow">
            <!-- Product Items -->
            <template x-if="cartItems.length">
                <div>
                    <!-- Product Item -->
                    <template x-for="product of cartItems" :key="product.id">
                        <div x-data="productItem(product)">
                            <div
                                class="w-full flex flex-col sm:flex-row items-center gap-4 flex-1">
                                <a :href="product.href"
                                   class="w-36 h-32 flex items-center justify-center overflow-hidden">
                                    <img :src="product.image" class="object-cover" alt=""/>
                                </a>
                                <div class="flex flex-col justify-between flex-1">
                                <div class="flex justify-between mb-3">
                                    <h3 x-text="product.title"></h3>
                                    <div class="text-lg font-semibold">
                                        <span class="@if($activeEvent) line-through @endif">₱<span x-text="product.price"></span></span>
                                        @if($activeEvent)
                                            <span >→ <span class="error-message" 
                                            x-text="
                                            new Intl.NumberFormat('en-PH', {
                                                style: 'currency',
                                                currency: 'PHP',
                                                minimumFractionDigits: 2
                                            }).format((product.price - (product.price * (product.discount.percentage/100))))">
                                            </span></span>
                                        @endif
                                    </div>
                                </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            Qty:
                                            <input
                                                type="number"
                                                min="1"
                                                x-model="product.quantity"
                                                @change="changeQuantity()"
                                                class="ml-3 py-1 border-gray-200 focus:border-purple-600 focus:ring-purple-600 w-16"
                                            />
                                        </div>
                                        <span class="text-lg font-semibold">
                                            <span>Stock: </span><span class="error-message" x-text="product.inStock"></span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between mb-3">
                                        <span>&nbsp;</span>
                                        <a
                                            href="#"
                                            @click.prevent="removeItemFromCart()"
                                            class="text-purple-600 hover:text-purple-500"
                                        >Remove</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <!--/ Product Item -->
                            <hr class="my-5"/>
                        </div>
                    </template>
                    <!-- Product Item -->

                    <div class="border-t border-gray-300 pt-4">
    <form action="{{ route('cart.checkoutCustom') }}" method="post">
        @csrf
        <div class="mb-4">
            <p class="font-semibold text-lg">Customer Fullname</p>
            <label for="firstname" class="block text-gray-700">First Name</label>
            <input type="text" id="firstname" name="firstname" class="w-full border border-gray-300 rounded-md p-2" required>
        </div>
        <div class="mb-4">
            <label for="lastname" class="block text-gray-700 font-semibold">Last Name</label>
            <input type="text" id="lastname" name="lastname" class="w-full border border-gray-300 rounded-md p-2" required>
        </div>
        <div class="mb-4">
            <label for="isPaid" class="block text-gray-700 font-semibold">
                Payment Received
            </label>
            <input type="checkbox" id="isPaid" name="isPaid">
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Subtotal</span>
            @if($activeEvent)
                <span id="cartTotal" class="text-xl" x-text="`₱${cartTotalDiscount}`"></span>
            @else
                <span id="cartTotal" class="text-xl" x-text="`₱${cartTotal}`"></span>
            @endif
        </div>
        <p class="text-gray-500 mb-6">
            Shipping and taxes calculated at checkout.
        </p>
        <button type="submit" class="btn-primary w-full py-3 text-lg" >
            Proceed to Checkout
        </button>
    </form>
</div>

                </div>
                <!--/ Product Items -->
            </template>
            <template x-if="!cartItems.length">
                <div class="text-center py-8 text-gray-500">
                    You don't have any items in cart
                </div>
            </template>

        </div>
    </div>
</x-app-layout>

<style scoped>
.error-message {
  color: #dc3545; /* Red color */
}
</style>