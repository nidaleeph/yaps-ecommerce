<x-app-layout>

    <head>
        <style scoped>
            .background-div {
                background-image: url("img/evangelism-1.jpg");
                /* Replace with your image URL */
                background-size: cover;
                /* Ensure the background image covers the entire div */
                background-position: center;
                /* Center the background image */
                display: flex;
                justify-content: center;
                align-items: center;
                color: #fff;
                /* Set text color to contrast with the background */
            }

            .flex {
                display: flex;
                /* Adjust this property based on your spacing preference */
            }

            .gallery-container {
                width: 100%;
            }

            .darken {
                filter: brightness(80%);
            }

            #carouselExampleIndicators .carousel-control-prev,
            #carouselExampleIndicators .carousel-control-next,
            #carouselExampleIndicators .carousel-indicators {
                opacity: 0;
                /* Initially hide the controls and indicators */
                transition: opacity 0.3s ease-in-out;
                /* Add a smooth transition effect */
            }

            #carouselExampleIndicators:hover .carousel-control-prev,
            #carouselExampleIndicators:hover .carousel-control-next,
            #carouselExampleIndicators:hover .carousel-indicators {
                opacity: 1;
                /* Display the controls and indicators on hover */
            }

            #carouselExampleIndicators .carousel-indicators {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #carouselExampleIndicators .carousel-indicators li {
                border-radius: 50%;
                /* Make the indicators round */
                width: 10px;
                /* Set the width of each indicator */
                height: 10px;
                /* Set the height of each indicator */
                margin: 0 5px;
                /* Adjust spacing between indicators */
                background-color: #ddd;
                /* Set the background color of indicators */
                border: 1px solid #ccc;
                /* Set the border color of indicators */
                cursor: pointer;
            }

            #carouselExampleIndicators .carousel-indicators .active {
                background-color: #333;
                /* Set the background color of the active indicator */
                border-color: #111;
                /* Set the border color of the active indicator */
            }

            #carouselExampleIndicators2 .carousel-control-prev,
            #carouselExampleIndicators2 .carousel-control-next,
            #carouselExampleIndicators2 .carousel-indicators {
                opacity: 0;
                /* Initially hide the controls and indicators */
                transition: opacity 0.3s ease-in-out;
                /* Add a smooth transition effect */
            }

            #carouselExampleIndicators2:hover .carousel-control-prev,
            #carouselExampleIndicators2:hover .carousel-control-next,
            #carouselExampleIndicators2:hover .carousel-indicators {
                opacity: 1;
                /* Display the controls and indicators on hover */
            }

            #carouselExampleIndicators2 .carousel-indicators {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #carouselExampleIndicators2 .carousel-indicators li {
                border-radius: 50%;
                /* Make the indicators round */
                width: 10px;
                /* Set the width of each indicator */
                height: 10px;
                /* Set the height of each indicator */
                margin: 0 5px;
                /* Adjust spacing between indicators */
                background-color: #ddd;
                /* Set the background color of indicators */
                border: 1px solid #ccc;
                /* Set the border color of indicators */
                cursor: pointer;
            }

            #carouselExampleIndicators2 .carousel-indicators .active {
                background-color: #333;
                /* Set the background color of the active indicator */
                border-color: #111;
                /* Set the border color of the active indicator */
            }

            .carousel1-dimension {
                width: 300px;
                /* Set your desired width */
                height: 400px;
                /* Set your desired height */
                object-fit: cover;
                /* Maintain aspect ratio and cover the container */
            }
        </style>
    </head>

    <body class="bg-fixed"
        style="
            background-image: url('/img/hero-1.jpg');
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        ">
        <div class="container mx-auto p-8">
            <div class="flex flex-col h-screen justify-center items-center text-white text-center">
                <h1 class="text-7xl font-bold slide-down">Welcome home!</h1>
                <p class="text-2xl slide-in mb-4">
                    Join us for a transformative worship experience, where
                    we seek to connect with God and one another through
                    prayer, music, and the Word. Whether you're new to
                    church or a lifelong believer, you'll find a home here.
                </p>
                <div class="fade-in mb-4">
                    <button
                        class="bg-cyan-600 hover:bg-blue-200 text-white rounded-full py-3 px-12 font-poppins font-bold text-1xl">
                        WHO WE ARE
                    </button>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800  py-6 sm:py-8 lg:py-12 fade-in-on-scroll">
                <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                    <div class="mb-4 flex items-center justify-between gap-8 sm:mb-8 md:mb-12">
                        <div class="flex items-center gap-12">
                            <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl dark:text-white">
                                Upcoming Events
                            </h2>
                            <p class="hidden max-w-screen-sm text-gray-500 dark:text-gray-300 md:block">
                                Discover the future at our Upcoming Events hub!
                                Engage with our vibrant community through a
                                carousel gallery highlighting soulful sermons,
                                dynamic workshops, and joyous celebrations. Stay
                                connected, mark your calendar, and join us on
                                this exciting journey of faith and fellowship!
                            </p>
                        </div>
                        <a href="#"
                            class="inline-block rounded-lg border bg-white dark:bg-gray-700 dark:border-none px-4 py-2 text-center text-sm font-semibold text-gray-500 dark:text-gray-200 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">More</a>
                    </div>

                    <div class="grid md:grid-cols-4 lg:grid-cols-4 gap-4 xl:gap-8">
                        <!-- image - start -->
                        <div
                            class="group relative flex h-100 items-end overflow-hidden rounded-lg bg-gray-100 md:col-span-2 shadow-lg md:h-80 slide-right">
                            <div class="gallery-container">
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="3000">
                                    <ol class="carousel-indicators">
                                        @foreach ($images as $key => $image)
                                            <li data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $key }}"
                                                class="{{ $key === 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($images as $key => $image)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <a href="{{ $image['navigationUrl'] }}">
                                                    <img class="d-block w-100 carousel1-dimension rounded-lg group-hover:scale-110"
                                                        src="{{ $image['url'] }}" alt="Slide {{ $key + 1 }}" />
                                                </a>

                                                <div class="carousel-caption">
                                                    <h1 class="font-bold text-2xl">
                                                        {{ $image['title'] }}
                                                    </h1>
                                                    <button onclick="onClick('{{ $image['navigationUrl'] }}')"
                                                        class="mx-auto block bg-cyan-500 hover:bg-blue-200 text-white rounded-full py-2 px-4 font-poppins font-bold text-1xl">
                                                        {{ $image['buttonText'] }}
                                                    </button>

                                                    <!-- <p>
                                            {{ $image['desc'] }}
                                        </p> -->
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- image - end -->

                        <!-- image - start -->
                        <div
                            class="group relative flex h-100 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:col-span-2 md:h-80 slide-down">
                            <div class="gallery-container">
                                <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="3000">
                                    <ol class="carousel-indicators">
                                        @foreach ($images as $key => $image)
                                            <li data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $key }}"
                                                class="{{ $key === 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($images as $key => $image)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <a href="{{ $image['navigationUrl'] }}">
                                                    <img class="d-block w-100 carousel1-dimension rounded-lg group-hover:scale-110"
                                                        src="{{ $image['url'] }}" alt="Slide {{ $key + 1 }}" />
                                                </a>

                                                <div class="carousel-caption">
                                                    <h1 class="font-bold text-2xl">
                                                        {{ $image['title'] }}
                                                    </h1>
                                                    <button onclick="onClick('{{ $image['navigationUrl'] }}')"
                                                        class="mx-auto block bg-cyan-500 hover:bg-blue-200 text-white rounded-full py-2 px-4 font-poppins font-bold text-1xl">
                                                        {{ $image['buttonText'] }}
                                                    </button>

                                                    <!-- <p>
                                            {{ $image['desc'] }}
                                        </p> -->
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- image - end -->

                        <!-- image - start -->
                        <a href="#"
                            class="group relative flex h-72 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg xl:col-span-3 md:col-span-2 md:h-80 slide-up">
                            <img src="https://images.unsplash.com/photo-1610465299996-30f240ac2b1c?auto=format&q=75&fit=crop&w=1000"
                                loading="lazy" alt="Photo by Martin Sanchez"
                                class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110 fade-in" />
                            <div
                                class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                            </div>
                            <span
                                class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Dev</span>
                        </a>
                        <!-- image - end -->

                        <!-- image - start -->
                        <a href="#"
                            class="group relative flex h-72 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80 slide-left md:col-span-2 xl:col-span-1">
                            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&q=75&fit=crop&w=600"
                                loading="lazy" alt="Photo by Lorenzo Herrera"
                                class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110 fade-in" />
                            <div
                                class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                            </div>
                            <span
                                class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Retro</span>
                        </a>
                        <!-- image - end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 py-6 sm:py-8 lg:py-12 fade-in-on-scroll opacity-95 font-poppins">
            <h1 class="mb-4 text-5xl font-bold text-center text-cyan-600 text-opacity-100 slide-down">
                Kingdom of God
            </h1>
            <p class="text-center text-opacity-100 mb-4 justify-center slide-up">
                - LOOKING FOR ANSWERS? THINK YOUR VISITING THIS SITE A
                COINCIDENCE? -
            </p>
            <p class="text-center text-opacity-100 mb-4 justify-center slide-up">
                YOUR BEING HERE TODAY IS NO ACCIDENT!
            </p>
            <div class="grid grid-cols-6">
                <div class="col-span-0 sm:col-span-0 md:col-span-0 lg:col-span-0 xl:col-span-1"></div>

                <div id="div1"
                    class="mx-10 lg:mx-20 xl:mx-0 2xl:mx-0 col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-2 px-10 py-10 my-3 leading-8 text-left border-5 border-black">
                    <img class="fade-in" src="{{ asset('img/kingdomofGod.jpg') }}" />
                </div>


                <div id="div2"
                    class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-2 bg-gray-100 px-20 leading-8 text-left ">
                    <p class="text-cyan-600 text-opacity-100 font-bold mb-4 mt-4 slide-left">
                        GOD BROUGHT YOU HERE FOR HIS PURPOSE
                    </p>
                    <p class="mb-4 slide-right">
                        Your Life Has Meaning: Each of us has a unique set of skills, experiences, and perspectives that
                        make us
                        valuable and worthy. Even when we face challenges or setbacks, we can find comfort in the belief
                        that our
                        lives have meaning and purpose. By focusing on our strengths and passions, we can make a
                        positive impact in
                        the world and create a fulfilling life for ourselves.
                    </p>
                    <p class="mb-4 slide-right">
                        Trust in Divine Guidance: Even when we don't have all the answers or understand the reasons
                        behind our
                        experiences, we can trust that there is a higher power guiding us towards our best possible
                        path. By staying
                        open to new opportunities and trusting in our intuition, we can connect with this divine
                        guidance and make
                        choices that align with our values and goals. Through faith and perseverance, we can overcome
                        obstacles and
                        achieve our dreams.
                    </p>
                    <a href="/" class="text-cyan-600 fade-in">About us > </a>
                </div>

                <div class="col-span-0 sm:col-span-0 md:col-span-0 lg:col-span-0 xl:col-span-1"></div>
            </div>


        </div>

        <div class="py-12">
            <div class="background-div py-6 sm:py-8 lg:py-12">
                <div class="text-center">
                    <h1 class="mb-4 text-5xl font-bold text-white font-poppins slide-down">
                        What's next?
                    </h1>
                    <div class="mb-4 slide-up">
                        Ready for what's next in your faith journey? Join a
                        ministry or community. Deepen your growth and make an
                        impact. Step forward today
                    </div>

                    <div class="grid grid-cols-6">
                        <div class="cols-span-0 xl:col-span-1"></div>
                        <div class="px-10 leading-5 text-center mb-4 col-span-6 xl:col-span-2">
                            <div class="fade-in mb-4 slide-right">
                                <button
                                    class="bg-cyan-600 hover:bg-blue-200 text-white rounded-full py-2 px-12 font-poppins font-bold text-2xl">
                                    JOIN A MINISTRY
                                </button>
                            </div>
                            <p class="mb-4 slide-up">
                                Looking for a way to serve and grow in your
                                faith? Join a ministry in your church. Whether
                                it's music, outreach, or children's ministry,
                                there's a place for you to use your unique gifts
                                and talents to make a difference. Plus, you'll
                                build meaningful relationships and connect with
                                others who share your values. Take the next step
                                in your journey and join a ministry today
                            </p>
                        </div>
                        <div class="px-10 leading-5 text-center mb-4 col-span-6 xl:col-span-2">
                            <div class="fade-in mb-4 slide-left">
                                <button
                                    class="bg-cyan-600 hover:bg-blue-200 text-white rounded-full py-2 px-12 font-poppins font-bold text-2xl">
                                    JOIN A COMMUNITY
                                </button>
                            </div>
                            <p class="mb-4 slide-up">
                                Life is better when we do it together! Joining a
                                faith community can bring so much joy, support,
                                and love into your life. From Bible studies to
                                small groups, there are so many ways to connect
                                with others who share your values and passions.
                                You'll find encouragement, accountability, and
                                deep friendships that will help you navigate
                                life's ups and downs. Don't go it alone - join a
                                community today and experience the power of
                                togetherness!
                            </p>
                        </div>
                        <div class="cols-span-0 xl:col-span-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
