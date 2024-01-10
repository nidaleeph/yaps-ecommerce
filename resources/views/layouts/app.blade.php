<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Bootstrap CSS -->
        <link
            href="{{ asset('bootstrap/css/bootstrap.min.css') }}"
            rel="stylesheet"
        />
        <link
            rel="icon"
            href="https://daybydayjesusness.com/wp-content/uploads/2022/04/DBD-Jesusness-logo-horizontal-1.png"
        />
        <title>{{ config("app.name", "Laravel E-commerce Website") }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </head>

    <body>
        @include('layouts.navigation')

        <main class="min-h-screen">
            {{ $slot }}
        </main>

        <!-- Toast -->
        <div
            x-data="toast"
            x-show="visible"
            x-transition
            x-cloak
            @notify.window="show($event.detail.message, $event.detail.type || 'success')"
            class="fixed w-[400px] left-1/2 -ml-[200px] top-16 py-2 px-4 pb-4 text-white"
            :class="type === 'success' ? 'bg-emerald-500' : 'bg-red-500'"
        >
            <div class="font-semibold" x-text="message"></div>
            <button
                @click="close"
                class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
            <!-- Progress -->
            <div>
                <div
                    class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10"
                    :style="{'width': `${percent}%`}"
                ></div>
            </div>
        </div>
        <!--/ Toast -->
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"
        ></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="{{
                asset('bootstrap/js/bootstrap.bundle.min.js')
            }}"></script>
    </body>
    @include('layouts.footer')

    <script>
        $(document).ready(function () {
            // Function to check if an element is in the viewport
            function isInViewport(element) {
                var rect = element.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <=
                        (window.innerHeight ||
                            document.documentElement.clientHeight) &&
                    rect.right <=
                        (window.innerWidth ||
                            document.documentElement.clientWidth)
                );
            }

            // Function to handle the animation on scroll
            function handleAnimation() {
                $(
                    ".slide-in, .fade-in, .slide-up, .slide-left, .slide-right, .slide-down, .visible"
                ).each(function () {
                    if (isInViewport(this)) {
                        $(this).addClass("active");
                    }
                });
            }

            // Initial check on page load
            handleAnimation();

            // Check on scroll
            $(window).scroll(function () {
                handleAnimation();
            });
        });

        function onClick(navigation) {
            // Add your navigation logic here
            // For example, navigate to a specific URL
            window.location.href = navigation;
        }
    </script>
</html>
