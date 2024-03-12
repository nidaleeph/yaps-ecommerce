<?php
/** @var \Illuminate\Database\Eloquent\Collection $watch */
$live_flag = \App\Models\YoutubeFlag::all()->first();
?>
<header x-data="{ mobileMenuOpen: false, cartItemsCount: {{ \App\Helpers\Cart::getCartItemsCount() }} }" @cart-change.window="cartItemsCount = $event.detail.count"
    class="flex justify-between bg-slate-900 shadow-md text-white fixed w-full top-0 z-50 items-center">

    <div class="logo">
        <a href="{{ route('home') }}" class="block py-navbar-item pl-5">
            <img style="width: 100px"
                src="https://daybydayjesusness.com/wp-content/uploads/2022/04/DBD-Jesusness-logo-horizontal-1.png"
                alt="YouTube Logo" />
        </a>
    </div>
    <!-- Responsive Menu -->
    <div class="block fixed z-10 top-0 bottom-0 height h-full w-[220px] transition-all bg-slate-900 xl:hidden"
        :class="mobileMenuOpen ? 'left-0' : '-left-[220px]'">
        <ul>
            <a href="{{ route('home') }}"
                class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                <div class="flex items-center">Home</div>
            </a>
            <a href="{{ route('about.index') }}"
                class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                <div class="flex items-center">About</div>
            </a>
            <a href="{{ route('watch.index') }}"
                class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                <div class="flex items-center">Watch</div>
            </a>
            <li x-data="{ open: false }" class="relative">
                <a @click="open = !open" @mouseenter="open = true" @mouseleave="open = false"
                    class="cursor-pointer flex justify-between items-center py-2 px-3 hover:bg-slate-800">
                    <span class="flex items-center"> Give </span>
                    <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-2 transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </a>
                <ul x-show="open" x-transition class="z-10 right-0 bg-slate-800 py-2" @mouseenter="open = true"
                    @mouseleave="open = false">
                    <li>
                        <a href="{{ route('profile') }}" class="flex px-3 py-2 hover:bg-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Bank Transfer
                        </a>
                    </li>
                    <li class="hover:bg-slate-900">
                        <a href="{{ route('order.index') }}" class="flex items-center px-3 py-2 hover:bg-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            International
                        </a>
                    </li>
                </ul>
            </li>
            <a href="{{ route('cart.index') }}"
                class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                <div class="flex items-center">Groups</div>
            </a>
            <a href="{{ route('ministries.index') }}"
                class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                <div class="flex items-center">Ministries</div>
            </a>
            <li x-data="{ open: false, salvationOpen: false, growthOpen: false }" class="relative">
                <a @click="open = !open" @mouseenter="open = true" @mouseleave="open = false"
                    class="cursor-pointer relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                    <span class="flex items-center"> Resources </span>
                    <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-2 transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </a>
                <ul @mouseenter="open = true" @mouseleave="open = false" @click.outside="open = false" x-show="open"
                    x-transition x-cloak class="z-10 right-0 bg-slate-800 py-2">
                    <li class="relative">
                        <a @click="salvationOpen = !salvationOpen"
                            class="cursor-pointer flex px-3 py-2 hover:bg-slate-900">
                            <span class="flex items-center"> Salvation </span>
                            <svg :class="{ 'transform rotate-180': salvationOpen }"
                                class="w-4 h-4 ml-2 transition-transform" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <ul @click.outside="salvationOpen = false" x-show="salvationOpen" x-transition x-cloak
                            class="z-10 right-0 bg-slate-800 py-2 w-48">
                            <li>
                                <a href="{{ route('resources.salvation.lesson1') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 1
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.salvation.lesson2') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 2
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.salvation.lesson3') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 3
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.salvation.lesson4') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 4
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="relative">
                        <a @click="growthOpen = !growthOpen" class="cursor-pointer flex px-3 py-2 hover:bg-slate-900">
                            <span class="flex items-center"> Growth </span>
                            <svg :class="{ 'transform rotate-180': growthOpen }"
                                class="w-4 h-4 ml-2 transition-transform" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <ul @click.outside="growthOpen = false" x-show="growthOpen" x-transition x-cloak
                            class="z-10 right-100 bg-slate-800 py-2 w-48">
                            <li>
                                <a href="{{ route('resources.growth.lesson1') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Growth Lesson 1
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.growth.lesson2') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Growth Lesson 2
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.growth.lesson3') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Growth Lesson 3
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <a href="{{ route('product.index') }}"
                class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                <div class="flex items-center">Shop</div>
            </a>

            <li>
                <a href="{{ route('cart.index') }}"
                    class="relative flex items-center justify-between py-2 px-3 transition-colors hover:bg-slate-800">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -mt-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Cart
                    </div>
                    <!-- Cart Items Counter -->
                    <small x-show="cartItemsCount" x-transition x-text="cartItemsCount" x-cloak
                        class="py-[2px] px-[8px] rounded-full bg-red-500"></small>
                    <!--/ Cart Items Counter -->
                </a>
            </li>
            @if (!Auth::guest())
                <li x-data="{ open: false }" class="relative">
                    <a @click="open = !open"
                        class="cursor-pointer flex justify-between items-center py-2 px-3 hover:bg-slate-800">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Account
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <ul x-show="open" x-transition class="z-10 right-0 bg-slate-800 py-2">
                        <li>
                            <a href="{{ route('profile') }}" class="flex px-3 py-2 hover:bg-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                My Profile
                            </a>
                        </li>
                        <li class="hover:bg-slate-900">
                            <a href="{{ route('order.index') }}"
                                class="flex items-center px-3 py-2 hover:bg-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                My Orders
                            </a>
                        </li>
                        <li class="hover:bg-slate-900">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"
                                    class="flex items-center px-3 py-2 hover:bg-slate-900"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                        class="flex items-center py-2 px-3 transition-colors hover:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                </li>
            @endif
            @if ($live_flag->live_flag)
                <li class="px-3 py-3 animate-pulse animate-infinite animate-duration-500">
                    <a href="{{ route('watch.index') }}#player-title" id="live-now-link"
                        class="block text-center text-white bg-red-700 py-2 px-3 rounded shadow-md hover:bg-red-400 active:bg-red-800 transition-colors w-full">
                        Watch Live Now
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!--/ Responsive Menu -->
    <nav class="hidden xl:block mr-5">
        <ul class="flex items-center">
            <a href="{{ route('about.index') }}"
                class="relative inline-flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                About
            </a>
            <a href="{{ route('watch.index') }}"
                class="relative inline-flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                Watch
            </a>
            <li x-data="{ open: false }" class="relative">
                <a @click="open = !open" @mouseenter="open = true" @mouseleave="open = false"
                    class="cursor-pointer flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                    <span class="flex items-center"> Give </span>
                    <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-2 transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </a>
                <ul @mouseenter="open = true" @mouseleave="open = false" @click.outside="open = false"
                    x-show="open" x-transition x-cloak class="absolute z-10 right-100 bg-slate-800 py-2 w-48">
                    <li>
                        <a href="{{ route('give.index') }}" class="flex px-3 py-2 hover:bg-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Bank Transfer
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('give.index') }}" class="flex px-3 py-2 hover:bg-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            International
                        </a>
                    </li>
                </ul>
            </li>
            <a href="{{ route('cart.index') }}"
                class="relative inline-flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                Groups
            </a>
            <a href="{{ route('ministries.index') }}"
                class="relative inline-flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                Ministries
            </a>
            <li x-data="{ open: false, salvationOpen: false, growthOpen: false }" class="relative">
                <a @click="open = !open" @mouseenter="open = true" @mouseleave="open = false"
                    class="cursor-pointer flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                    <span class="flex items-center"> Resources </span>
                    <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-2 transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </a>
                <ul @mouseenter="open = true" @mouseleave="open = false" @click.outside="open = false"
                    x-show="open" x-transition x-cloak class="absolute z-10 right-100 bg-slate-800 py-2 w-48">
                    <li class="relative">
                        <a @click="salvationOpen = !salvationOpen"
                            class="cursor-pointer flex px-3 py-2 hover:bg-slate-900">
                            <span class="flex items-center"> Salvation </span>
                            <svg :class="{ 'transform rotate-180': salvationOpen }"
                                class="w-4 h-4 ml-2 transition-transform" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <ul @click.outside="salvationOpen = false" x-show="salvationOpen" x-transition x-cloak
                            class="z-10 right-0 bg-slate-800 py-2 w-48">
                            <li>
                                <a href="{{ route('resources.salvation.lesson1') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 1
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.salvation.lesson2') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 2
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.salvation.lesson3') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 3
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.salvation.lesson4') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Salvation Lesson 4
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="relative">
                        <a @click="growthOpen = !growthOpen" class="cursor-pointer flex px-3 py-2 hover:bg-slate-900">
                            <span class="flex items-center"> Growth </span>
                            <svg :class="{ 'transform rotate-180': growthOpen }"
                                class="w-4 h-4 ml-2 transition-transform" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <ul @click.outside="growthOpen = false" x-show="growthOpen" x-transition x-cloak
                            class="z-10 right-100 bg-slate-800 py-2 w-48">
                            <li>
                                <a href="{{ route('resources.growth.lesson1') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Growth Lesson 1
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.growth.lesson2') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Growth Lesson 2
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resources.growth.lesson3') }}"
                                    class="flex px-3 py-2 hover:bg-slate-900">
                                    Growth Lesson 3
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <a href="{{ route('product.index') }}"
                class="relative inline-flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                Shop
            </a>

            <li>
                <a href="{{ route('cart.index') }}"
                    class="relative inline-flex items-center py-navbar-item px-navbar-item hover:bg-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Cart
                    <small x-show="cartItemsCount" x-transition x-cloak x-text="cartItemsCount"
                        class="absolute z-[100] top-4 -right-3 py-[2px] px-[8px] rounded-full bg-red-500"></small>
                </a>
            </li>
            @if (!Auth::guest())
                <li x-data="{ open: false }" class="relative">
                    <a @click="open = !open" @mouseenter="open = true" @mouseleave="open = false"
                        class="cursor-pointer flex items-center py-navbar-item px-navbar-item pr-5 hover:bg-slate-900">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Account
                        </span>
                        <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-2 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                    <ul @mouseenter="open = true" @mouseleave="open = false" @click.outside="open = false"
                        x-show="open" x-transition x-cloak class="absolute z-10 right-0 bg-slate-800 py-2 w-48">
                        <li>
                            <a href="{{ route('profile') }}" class="flex px-3 py-2 hover:bg-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('order.index') }}" class="flex px-3 py-2 hover:bg-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                My Orders
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" class="flex px-3 py-2 hover:bg-slate-900"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                        class="flex items-center py-navbar-item px-navbar-item hover:bg-slate-900 bg-emerald-600 py-2 px-3 rounded shadow-md hover:bg-emerald-700 active:bg-emerald-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                </li>
            @endif
            @if ($live_flag->live_flag)
                <li class="animate-pulse animate-infinite animate-duration-500">
                    <a href="{{ route('watch.index') }}#player-title"
                        class="inline-flex items-center text-white py-1 px-1 rounded shadow-md hover:bg-red-700 active:bg-red-800 transition-colors mx-5">
                        <img src="{{ asset('img/youtubelivelogo.png') }}" alt="YouTube Logo"
                            class=" h-12 w-12 mr-2">
                        Live Now
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-4 block xl:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

</header>

<style>
    .logo img:hover {
        transform: scale(1.2);
        /* Increase the size on hover (adjust the scale factor as needed) */
    }
</style>
