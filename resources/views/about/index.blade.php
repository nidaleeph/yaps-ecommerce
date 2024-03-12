<x-app-layout>

    <head>
        <style scoped>
            .background-ministryhead {
                background-image: url("img/ministry head.jpg");
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

            .background-location {
                background-image: url("img/location.jpg");
                /* Replace with your image URL */
                background-size: cover;
                /* Ensure the background image covers the entire div */
                background-position: center;
                /* Center the background image */
                align-items: center;
                color: #fff;
                /* Set text color to contrast with the background */
            }

            .map-container {
                position: relative;
                width: calc(100% - 40px);
                /* Adjusted to account for left and right margins */
                max-width: 1200px;
                margin: 0 auto;
                overflow: hidden;
                padding-bottom: 35%;
                /* Adjust the aspect ratio */
            }

            .map-container iframe {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 100%;
                height: 100%;
                border: 0;
                z-index: 1;
            }


            .flex {
                display: flex;
                /* Adjust this property based on your spacing preference */
            }

            .darken {
                filter: brightness(80%);
            }
        </style>
    </head>

    <body class="bg-fixed"
        style="
            background-image: url('/img/about.jpg');
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        ">
        <div class="container mx-auto p-8 grid grid-cols-6">
            <div class="col-span-0 xl:col-span-1"></div>
            <div
                class="col-span-6 xl:col-span-2 flex flex-col h-screen justify-center text-white text-center xl:text-left">
                <h1 class="text-7xl font-bold slide-down">About us</h1>
                <p class="text-1xl slide-right mb-4 ">
                    learn more about what we stand for<br>
                    and what we believe in
                </p>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 py-6 sm:py-8 lg:py-12 fade-in-on-scroll opacity-95 font-poppins">
            <div class="grid grid-cols-6">
                <div class="col-span-0 sm:col-span-0 md:col-span-0 lg:col-span-0 xl:col-span-1"></div>
                <div id="div2"
                    class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-2 px-20 leading-8 text-left ">
                    <p class="text-cyan-600 text-opacity-100 font-bold text-4xl mb-4 mt-4 slide-left">
                        WHO WE ARE
                    </p>
                    <p class="mb-4 slide-right">
                        Welcome to Metronorth DayByDay Church, where we are all about growing in our faith and building
                        a community that is centered around God's love. We believe that every person has a unique
                        purpose and calling, and we are here to support and encourage you on your journey. Whether
                        you're just starting out in your faith or have been walking with God for years, you'll find a
                        place to belong at Metronorth DayByDay Church. Come as you are and experience the power of
                        authentic worship, meaningful relationships, and practical teaching that will help you apply
                        biblical truths to your everyday life. We invite you to join us and see what God can do through
                        your life - day by day!
                    </p>
                </div>
                <div id="div1"
                    class="mx-10 lg:mx-20 xl:mx-0 2xl:mx-0 col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-2 py-20 my-3 leading-8 text-left ">
                    <img class="fade-in" src="{{ asset('img/pastor.jpg') }}" />
                </div>
                <div class="col-span-0 sm:col-span-0 md:col-span-0 lg:col-span-0 xl:col-span-1"></div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-gray-800 py-6 sm:py-8 lg:py-12 fade-in-on-scroll opacity-95 font-poppins border-t-2 border-black">
            <div class="grid grid-cols-6">
                <div class="col-span-0 sm:col-span-0 md:col-span-0 lg:col-span-0 xl:col-span-1"></div>
                <div id="div1"
                    class="mx-10 lg:mx-20 xl:mx-0 2xl:mx-0 col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-2 py-20 my-3 leading-8 text-left ">
                    <img class="fade-in" src="{{ asset('img/missionvision.jpg') }}" />
                </div>
                <div id="div2"
                    class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-2 px-20 leading-8 text-left ">
                    <p class="text-cyan-600 text-opacity-100 font-bold mb-4 mt-4 slide-left">
                        Mission
                    </p>
                    <p class="mb-4 slide-left ml-5">
                        At our church, we strive to embody the love of God and advance His kingdom. Our mission is to
                        love God with all our heart, soul, mind, and strength, to love our neighbors as ourselves, and
                        to make disciples of Jesus Christ who will in turn make more disciples. We believe that as we
                        love God and love others, we participate in the building of His kingdom on earth and advance His
                        mission to redeem and restore all things.
                    </p>
                    <p class="text-cyan-600 text-opacity-100 font-bold mb-4 mt-4 slide-left">
                        Vision
                    </p>
                    <p class="mb-4 slide-left ml-5">
                        Our vision is to be a community of believers who are marked by our love for God and one another.
                        We envision a church that is passionate about pursuing God's heart, committed to living out His
                        values, and empowered by His Spirit to make a difference in the world. We desire to be a church
                        that reflects the beauty and diversity of God's kingdom, where people of all backgrounds and
                        walks of life can experience the transformative power of His love. We want to be a church that
                        is known for its hospitality, its generosity, and its commitment to serving others. Above all,
                        we want to be a church that brings glory to God by loving Him and loving our neighbors with our
                        whole lives.
                    </p>
                </div>
                <div class="col-span-0 sm:col-span-0 md:col-span-0 lg:col-span-0 xl:col-span-1"></div>
            </div>
        </div>
        <div>
            <div class="background-ministryhead py-6 sm:py-8 lg:py-12">
                <div class="text-center">
                    <h1 class="mb-4 text-5xl font-bold text-black font-poppins slide-down">
                        Ministry Heads
                    </h1>
                    <div class="grid grid-cols-6">
                        <div class="cols-span-0 xl:col-span-1"></div>
                        <div class="px-10 leading-5 text-center mb-4 col-span-6 xl:col-span-2">
                            <div class="fade-in mb-4 slide-right text-black">
                                <p class="font-bold">Head Pastor: <span class="font-normal">Ptr. Edwin Rivera</span></p>
                                <p class="font-bold">Presiding Ministry: <span class="font-normal">Atty. Armee
                                        Filamor</span></p>
                                <p class="font-bold">Music Ministry: <span class="font-normal">Ms. Camille
                                        Carandang</span>
                                </p>
                                <p class="font-bold">Kaagapay: <span class="font-normal">Mr. Danilo Datul</span></p>
                                <p class="font-bold">Ushering Ministry: <span class="font-normal">Ms. Meriam
                                        Rivera</span></p>
                            </div>
                        </div>
                        <div class="px-10 leading-5 text-center mb-4 col-span-6 xl:col-span-2">
                            <div class="fade-in mb-4 slide-left text-black">
                                <p class="font-bold">Yaps Ministry: <span class="font-normal">Ms.Alyana
                                        Barrinuevo</span>
                                </p>
                                <p class="font-bold">Couples Ministry: <span class="font-normal">Ms. Lovely Amago</span>
                                </p>
                                <p class="font-bold">Senior Ministry: <span class="font-normal">Ptr. Ernize Bañez</span>
                                </p>
                                <p class="font-bold">Youth : <span class="font-normal">Mr. Shem Japhet Rivera</span></p>
                                <p class="font-bold">Kaloob Ministry: <span class="font-normal">Ms. Crystell
                                        Capili</span></p>
                            </div>
                        </div>
                        <div class="cols-span-0 xl:col-span-1"></div>
                        <div class="fade-in mb-4 slide-up col-span-6">
                            <button
                                class="bg-cyan-600 hover:bg-blue-200 text-white rounded-full py-2 px-12 font-poppins font-bold text-2xl">
                                JOIN A COMMUNITY
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="background-location py-6 sm:py-8 lg:py-12">
                <div class="text-center mb-8">
                    <h1 class="mb-4 mt-5 text-5xl font-bold font-poppins slide-down">
                        Location
                    </h1>

                    <h1 class="mb-4 mx-2 text-2xl  font-poppins slide-down">
                        Metro North Day by Day Jesus Ministries Inc. Worship center
                    </h1>

                    <p class="mb-4 mx-2 text-1xl  font-poppins slide-down">
                        2nd floor 1165 Quirino Highway, Zabarte Novaliches Quezon City<br>
                        0933-859-3071
                    </p>
                </div>

                <!-- Google Maps iframe -->
                <div class="map-container fade-in">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.255490762773!2d121.04779431525364!3d14.732761592834857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ce365387907d%3A0x5416fef778ac7f34!2sMetro%20North%20Day%20By%20Day%20Jesus%20Ministries%20INC.!5e0!3m2!1sen!2sph!4v1642697329651!5m2!1sen!2sph"
                        allowfullscreen="" loading="lazy"></iframe>
                    <div class="white-background"></div>
                </div>
            </div>

        </div>


    </body>
</x-app-layout>
