<x-app-layout>

    <head>

        <style scoped>
            /* Buttons */
            .dropbtnMinistry {
                background-color: #2f2f2f;
                color: white;
                padding: 10px;
                margin-top: 10px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                width: 250px;
                border-radius: 20px;
                text-align: center;
                font-weight: bold;
                font-family: "poppins";
            }

            .dropbtnMinistry:hover {
                background-color: #0fa6d1 !important;
            }

            .btnMusic:hover,
            .btnMulti:hover,
            .btnPrayer:hover,
            .btnPresiding:hover,
            .btnUshering:hover,
            .btnSam:hover,
            .btnYouth:hover,
            .btnYaps:hover,
            .btnJss:hover {
                color: #0fa6d1 !important;
            }


            /* Text description */
            .button-class-ministry {
                font-style: "poppins";
                font-weight: bold;
                font-size: 30px;
                cursor: pointer;
                border: 0px;
                background-color: transparent;
            }

            .descMin {
                text-align: left;
                padding: 5px;
                font-style: "poppins";
                font-size: 15px;
                color: black;
            }

            /* Select */
            select {
                text-align: center;
                text-align-last: center;
                -moz-text-align-last: center;
            }

            /* Image gallery */
            .rowMin {
                display: flex;
                flex-wrap: wrap;
            }

            .columnMin {
                flex: 1 1 30%;
                /* Use flex instead of float */
                padding: 5px;
                text-align: center;
                height: 250px;
                /* Set a fixed height */
                width: 30%;
                /* Set a fixed width */
            }

            .imgThispage {
                display: block;
                max-width: 100%;
                height: 100%;
                object-fit: cover;
                /* Fill the container without stretching or squishing */
            }


            /* Lightbox */
            #lightbox {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #lightbox #close-button {
                font-size: 30px;
                color: #fff;
                cursor: pointer;
            }

            #lightbox img {
                max-width: 80%;
                max-height: 80%;
                display: block;
                margin: auto;
            }


            .columnMin:hover img {
                transform: scale(1.5);
                transition: transform 0.3s ease;
                cursor: pointer;
            }

            .magnifier {
                position: absolute;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                border: 2px solid #000;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                cursor: none;
                display: none;
            }

            .columnMin:hover .magnifier {
                display: block;
            }

            .magnifier img {
                width: 100%;
                height: auto;
            }
        </style>
    </head>

    <body class="bg-fixed font-poppins" onload="defaultbank()"
        style=" background-image: url({{ asset('/img/Ministries-hero.jpg') }}); background-size:
        cover; font-family: 'Poppins' , sans-serif; ">
        <div class="container mx-auto grid grid-cols-9">
            <div class="col-span-0 xl:col-span-3"></div>
            <div
                class="col-span-9 xl:col-span-4 flex flex-col h-screen justify-center xl:items-end text-white text-center ">
                <h1 class="text-7xl font-bold slide-down mb-4">Ministries</h1>
                <p class="text-1xl slide-right mb-4">
                    Experience purpose, growth,<br>
                    and impact in our ministry
                </p>
            </div>
            <div class="col-span-0 xl:col-span-2"></div>
        </div>
        <div class=" bg-white  py-4" id="church-ministry">
            <div class="container mx-auto">
                <h1 style="font-size: 40px;"
                    class="text-cyan-600 flex justify-center items-center text-center font-poppins font-semibold">
                    Church
                    Ministries</h1>
                <hr class="solid my-2">
                <div>
                    <div class="flex justify-between py-2">
                        <button class="btnMusic button-class-ministry">Music</button>
                        <button class="btnMusic button-class-ministry" id="btnMusic">+</button>
                    </div>
                    <div id="displayMusic" style="display:none;">
                        <div class="flex flex-wrap">
                            <div
                                class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                <img src="img/IMG_2192.JPG" class="imgThispage thumbnail-image" style="width:100%">
                            </div>
                            <div
                                class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                <img src="img/KIK05869.JPG" class="imgThispage thumbnail-image" style="width:100%">
                            </div>
                            <div
                                class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                <img src="img/KIK05880.JPG" class="imgThispage thumbnail-image" style="width:100%">
                            </div>
                        </div>

                        <p class='descMin'>Our music ministry is a community of talented musicians and singers who use
                            their
                            gifts to glorify God and inspire others. We believe that music has the power to uplift,
                            encourage,
                            and connect people to God in a special way. Through our ministry, we provide opportunities
                            for
                            people to share their musical talents, develop their skills, and create a worshipful
                            atmosphere
                            that
                            brings people closer to God.</p>
                        <div class="flex justify-center items-center">
                            <button class="dropbtnMinistry mx-2" onclick="changeFormValue('Music')">Join Music</button>
                            <button class="dropbtnMinistry mx-2" onclick="window.location.replace('music.html')">See
                                More</button>
                        </div>
                    </div>
                </div>
                <hr class="solid my-2">
                <div>
                    <div class="flex justify-between py-2">
                        <button class="btnMulti button-class-ministry">Multimedia</button>
                        <button class="btnMulti button-class-ministry" id="btnMulti">+</button>
                    </div>
                    <div id="displayMulti" style="display:none;">
                        <div class="flex flex-wrap">
                            <div
                                class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                <img src="img/KIK05891.JPG"class="imgThispage thumbnail-image" style="width:100%">
                            </div>
                            <div
                                class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                <img src="img/KIK05889.JPG"class="imgThispage thumbnail-image" style="width:100%">
                            </div>
                            <div
                                class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                <img src="img/DSC_0005.JPG"class="imgThispage thumbnail-image" style="width:100%">
                            </div>
                        </div>
                        <p class='descMin'>Our multimedia ministry is a team of creative individuals who use their
                            talents
                            to
                            support the church's mission through technology and media. We believe that the message of
                            the
                            gospel
                            can be communicated in powerful and relevant ways through visuals, sound, and digital media.
                            Through
                            our ministry, we seek to create engaging and meaningful content that inspires and informs,
                            while
                            also providing technical support for church events and services.</p>

                        <div class="flex justify-center items-center">
                            <button class="dropbtnMinistry" onclick="changeFormValue('Multimedia')">Join
                                Multimedia</button>

                        </div>
                    </div>
                    <hr class="solid my-2">
                    <div>
                        <div class="flex justify-between py-2">
                            <button class="btnJss button-class-ministry">JSS Teacher</button>
                            <button class="btnJss button-class-ministry" id="btnJss">+</button>
                        </div>
                        <div id="displayJss" style="display:none;">
                            <div class="flex flex-wrap">
                                <div
                                    class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                    <img src="img/IMG_8382.JPG"class="imgThispage thumbnail-image" style="width:100%">
                                </div>
                                <div
                                    class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                    <img src="img/DSC_0029.JPG"class="imgThispage thumbnail-image" style="width:100%">
                                </div>
                                <div
                                    class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                    <img src="img/IMG_8353.JPG"class="imgThispage thumbnail-image" style="width:100%">
                                </div>
                            </div>
                            <p class='descMin'>Our Junior Sunday School teacher ministry is a group of dedicated
                                volunteers
                                who
                                love
                                working with children and sharing the love of Jesus with them. We believe that every
                                child
                                is a
                                precious gift from God and that nurturing their faith and character is essential.
                                Through
                                our
                                ministry, we provide a safe and fun environment for children to learn about God, engage
                                in
                                age-appropriate activities, and develop meaningful relationships with each other and
                                with
                                our
                                teachers.</p>
                            <div class="flex items-center justify-center">

                                <button class="dropbtnMinistry" onclick="changeFormValue('Jss')">Join JSS
                                    Teacher</button>

                            </div>
                        </div>
                        <hr class="solid my-2">
                        <div>
                            <div class="flex justify-between py-2">
                                <button class="btnPresiding button-class-ministry">Presiding</button>
                                <button class="btnPresiding button-class-ministry" id="btnPresiding">+</button>
                            </div>
                            <div id="displayPresiding" style="display:none;">
                                <div class="flex flex-wrap">
                                    <div
                                        class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                        <img src="img/IMG_8567.JPG"class="imgThispage thumbnail-image"
                                            style="width:100%">
                                    </div>
                                    <div
                                        class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                        <img src="img/DSC_8344.JPG"class="imgThispage thumbnail-image"
                                            style="width:100%">
                                    </div>
                                    <div
                                        class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                        <img src="img/KIK06064.JPG"class="imgThispage thumbnail-image"
                                            style="width:100%">
                                    </div>
                                </div>
                                <p class='descMin'>Our presiding ministry is a team of dedicated leaders who serve the
                                    church by
                                    overseeing and guiding its activities and programs. We believe that effective
                                    leadership
                                    is
                                    essential for fulfilling the church's mission and vision. Through our ministry, we
                                    provide
                                    direction, support, and accountability for the various ministries and volunteers in
                                    the
                                    church,
                                    while also ensuring that the church is aligned with its values and goals.</p>
                                <br>
                                <div class="flex items-center justify-center">
                                    <button class="dropbtnMinistry" onclick="changeFormValue('Presiding')">Join
                                        Presiding</button>
                                </div>
                            </div>
                            <hr class="solid my-2">
                            <div>
                                <div class="flex justify-between py-2">
                                    <button class="btnUshering button-class-ministry">Ushering</button>
                                    <button class="btnUshering button-class-ministry" id="btnUshering">+</button>
                                </div>
                                <div id="displayUshering" style="display:none;">
                                    <div class="flex flex-wrap">
                                        <div
                                            class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                            <img src="img/DSC_8328.JPG"class="imgThispage thumbnail-image"
                                                style="width:100%">
                                        </div>
                                        <div
                                            class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                            <img src="img/DSC_8329.JPG"class="imgThispage thumbnail-image"
                                                style="width:100%">
                                        </div>
                                        <div
                                            class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                            <img src="img/IMG_8789.JPG"class="imgThispage thumbnail-image"
                                                style="width:100%">
                                        </div>
                                    </div>
                                    <p class='descMin'>Our ushering ministry is a team of friendly and welcoming
                                        volunteers
                                        who
                                        serve
                                        as
                                        the first point of contact for visitors and members of the church. We believe
                                        that
                                        creating
                                        a
                                        warm
                                        and inviting atmosphere is essential for helping people feel at home and
                                        connected
                                        to
                                        the
                                        church.
                                        Through our ministry, we greet and assist people as they enter the church,
                                        provide
                                        direction
                                        and
                                        information, and ensure that the service runs smoothly</p>
                                    <div class="flex items-center justify-center">
                                        <button class="dropbtnMinistry" onclick="changeFormValue('Ushering')">Join
                                            Ushering</button>
                                    </div>
                                </div>
                                <hr class="solid my-2">
                                <div>
                                    <div class="flex justify-between py-2">
                                        <button class="btnKaagapay button-class-ministry">Kaagapay</button>
                                        <button class="btnKaagapay button-class-ministry" id="btnKaagapay">+</button>
                                    </div>
                                </div>
                                <div id="displayKaagapay" style="display:none;">
                                    <div class="flex flex-wrap">
                                        <div
                                            class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                            <img src="img/DSC_8328.JPG"class="imgThispage thumbnail-image"
                                                style="width:100%">
                                        </div>
                                        <div
                                            class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                            <img src="img/DSC_8329.JPG"class="imgThispage thumbnail-image"
                                                style="width:100%">
                                        </div>
                                        <div
                                            class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                            <img src="img/IMG_8789.JPG"class="imgThispage thumbnail-image"
                                                style="width:100%">
                                        </div>
                                    </div>
                                    <p class='descMin'>The kaagapay ministry in our church is a group of men
                                        dedicated
                                        to
                                        providing
                                        physical and spiritual support to the church. They play a vital role in
                                        ensuring
                                        the
                                        safety
                                        and
                                        security of the church, as well as maintaining peace and order during church
                                        services.
                                        By
                                        joining
                                        this ministry, you will have the opportunity to serve and support your
                                        fellow
                                        church
                                        members,
                                        and
                                        contribute to the overall growth and well-being of our church community.</p>
                                    <div class="flex items-center justify-center">
                                        <button class="dropbtnMinistry" onclick="changeFormValue('Kaagapay')">Join
                                            Kaagapay</button>
                                    </div>
                                </div>
                                <hr class="solid my-2">
                                <div>
                                    <div class="flex justify-between py-2">
                                        <button class="btnPrayer button-class-ministry">Prayer</button>
                                        <button class="btnPrayer button-class-ministry" id="btnPrayer">+</button>
                                    </div>
                                    <div id="displayPrayer" style="display:none;">
                                        <div class="flex flex-wrap">
                                            <div
                                                class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                <img src="img/IMG_9744.JPG"class="imgThispage thumbnail-image"
                                                    style="width:100%">
                                            </div>
                                            <div
                                                class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                <img src="img/DSC_0135.JPG"class="imgThispage thumbnail-image"
                                                    style="width:100%">
                                            </div>
                                            <div
                                                class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                <img src="img/IMG_8777.JPG"class="imgThispage thumbnail-image"
                                                    style="width:100%">
                                            </div>
                                        </div>
                                        <p class='descMin'>Our prayer ministry is a community of believers who are
                                            committed to
                                            praying
                                            for
                                            the
                                            needs of the church and its members. We believe that prayer is a powerful
                                            way to
                                            connect
                                            with
                                            God
                                            and to seek His guidance and intervention. Through our ministry, we provide
                                            opportunities
                                            for
                                            people
                                            to share their prayer requests, to intercede on behalf of others, and to
                                            experience
                                            the
                                            comfort
                                            and
                                            peace that comes from knowing that others are praying for them</p>
                                        <div class="flex items-center justify-center">
                                            <button class="dropbtnMinistry" onclick="changeFormValue('Prayer')">Join
                                                Prayer
                                                Team</button>
                                        </div>
                                    </div>
                                    <hr class="solid my-2">
                                    <div>
                                        <div class="flex justify-between py-2">
                                            <button class="btnSam button-class-ministry">SAM</button>
                                            <button class="btnSam button-class-ministry" id="btnSam">+</button>
                                        </div>
                                        <div id="displaySam" style="display:none;">
                                            <div class="flex flex-wrap">
                                                <div
                                                    class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                    <img src="img/sam3.png"class="imgThispage thumbnail-image"
                                                        style="width:100%">
                                                </div>
                                                <div
                                                    class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                    <img src="img/sam2.png"class="imgThispage thumbnail-image"
                                                        style="width:100%">
                                                </div>
                                                <div
                                                    class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                    <img src="img/sam1.png"class="imgThispage thumbnail-image"
                                                        style="width:100%">
                                                </div>
                                            </div>
                                            <p class='descMin'>Our senior adult ministry is a group of caring and
                                                supportive
                                                volunteers
                                                who
                                                provide
                                                fellowship, encouragement, and spiritual growth opportunities for our
                                                elderly
                                                members.
                                                We
                                                believe
                                                that seniors have a wealth of wisdom, experience, and knowledge that can
                                                benefit
                                                the
                                                church
                                                and
                                                the
                                                community. Through our ministry, we offer a range of activities and
                                                events
                                                that
                                                cater to
                                                the
                                                needs
                                                and interests of our senior members, while also providing opportunities
                                                for
                                                them
                                                to
                                                serve
                                                and
                                                share
                                                their gifts with others</p>
                                            <div class="flex justify-center items-center">
                                                <button class="dropbtnMinistry" onclick="changeFormValue('Sam')">Join
                                                    Senior
                                                    Adult
                                                    Ministry</button>
                                            </div>
                                        </div>

                                        <hr class="solid my-2">
                                        <div>
                                            <div class="flex justify-between py-2">
                                                <button class="btnYouth button-class-ministry">Youth &
                                                    Yaps</button>
                                                <button class="btnYouth button-class-ministry"
                                                    id="btnYouth">+</button>
                                            </div>
                                            <div id="displayYouth" style="display:none;">
                                                <div class="flex flex-wrap">
                                                    <div
                                                        class="w-full  lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                        <img src="img/DSC_8324.JPG"class="imgThispage thumbnail-image"
                                                            style="width:100%">
                                                    </div>
                                                    <div
                                                        class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                        <img src="img/DSC_8421.JPG"class="imgThispage thumbnail-image"
                                                            style="width:100%">
                                                    </div>
                                                    <div
                                                        class="w-full md:w-1/2 lg:w-1/3 mb-1 transform transition-transform hover:scale-125 cursor-pointer">
                                                        <img src="img/DSC_8413.JPG"class="imgThispage thumbnail-image"
                                                            style="width:100%">
                                                    </div>
                                                </div>
                                                <p class='descMin'>Our youth and young adult professionals ministry is
                                                    a
                                                    vibrant
                                                    and
                                                    dynamic
                                                    community
                                                    of young people who are passionate about growing in their faith and
                                                    making a
                                                    positive
                                                    impact
                                                    on
                                                    the
                                                    world. We believe that young people have a unique role to play in
                                                    the
                                                    church
                                                    and
                                                    society,
                                                    and we
                                                    seek to empower them to live out their calling with purpose and
                                                    passion.
                                                    Through
                                                    our
                                                    ministry,
                                                    we
                                                    offer opportunities for fellowship, learning, and service, as well
                                                    as
                                                    support
                                                    and
                                                    mentorship
                                                    for
                                                    young adults as they navigate the challenges and opportunities of
                                                    adulthood.
                                                </p>
                                                <div class="flex items-center justify-center">
                                                    <button class="dropbtnMinistry mx-2"
                                                        onclick="changeFormValue('Youth')">Join
                                                        Youth</button>
                                                    <button class="dropbtnMinistry mx-2"
                                                        onclick="changeFormValue('Yaps')">Join
                                                        Yaps</button>
                                                </div>
                                            </div>
                                            <div id="lightbox" style="display: none;">
                                                <span id="close-button">&times;</span>
                                                <img id="lightbox-image" src="" alt="Full-size Image">
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        const sections = [{
                                                name: "Music",
                                                className: "btnMusic",
                                                displayId: "displayMusic",
                                                buttonId: "btnMusic",
                                                boolVar: "boolMusic",
                                            },
                                            {
                                                name: "Multi",
                                                className: "btnMulti",
                                                displayId: "displayMulti",
                                                buttonId: "btnMulti",
                                                boolVar: "boolMulti",
                                            },
                                            {
                                                name: "Jss",
                                                className: "btnJss",
                                                displayId: "displayJss",
                                                buttonId: "btnJss",
                                                boolVar: "boolJss",
                                            },
                                            {
                                                name: "Presiding",
                                                className: "btnPresiding",
                                                displayId: "displayPresiding",
                                                buttonId: "btnPresiding",
                                                boolVar: "boolPresiding",
                                            },
                                            {
                                                name: "Ushering",
                                                className: "btnUshering",
                                                displayId: "displayUshering",
                                                buttonId: "btnUshering",
                                                boolVar: "boolUshering",
                                            },
                                            {
                                                name: "Kaagapay",
                                                className: "btnKaagapay",
                                                displayId: "displaKaagapay",
                                                buttonId: "btnKaagapay",
                                                boolVar: "boolKaagapay",
                                            },
                                            {
                                                name: "Prayer",
                                                className: "btnPrayer",
                                                displayId: "displayPrayer",
                                                buttonId: "btnPrayer",
                                                boolVar: "boolPrayer",
                                            },
                                            {
                                                name: "Sam",
                                                className: "btnSam",
                                                displayId: "displaySam",
                                                buttonId: "btnSam",
                                                boolVar: "boolSam",
                                            },
                                            {
                                                name: "Youth",
                                                className: "btnYouth",
                                                displayId: "displayYouth",
                                                buttonId: "btnYouth",
                                                boolVar: "boolYouth",
                                            },
                                        ];

                                        function toggleSection(section) {
                                            const boolVar = window[section.boolVar];
                                            const display = document.getElementById(section.displayId);
                                            const buttons = document.getElementsByClassName(section.className);
                                            const button = document.getElementById(section.buttonId);

                                            if (boolVar) {
                                                display.style.display = "none";
                                                buttons[0].classList.remove("active");
                                                buttons[1].classList.remove("active");
                                                button.textContent = "+";
                                            } else {
                                                display.style.display = "block";
                                                buttons[0].classList.add("active");
                                                buttons[1].classList.add("active");
                                                button.textContent = "-";
                                            }

                                            window[section.boolVar] = !boolVar;
                                        }

                                        function changeFormValue(sectionName) {

                                            const select = document.getElementById("imObjectForm_62_4");
                                            // Set the value of the select option to your desired value
                                            select.value = sectionName;
                                            const form = document.getElementById("ministryForm");
                                            form.scrollIntoView({
                                                behavior: "smooth"
                                            });
                                        }

                                        document.addEventListener("DOMContentLoaded", function() {
                                            const buttons = document.querySelectorAll(
                                                '.btnMusic, .btnMulti, .btnJss, .btnPresiding, .btnUshering, .btnKaagapay, .btnPrayer, .btnSam, .btnYouth'
                                            );
                                            buttons.forEach(button => {
                                                const className = button.classList[0];
                                                const displayId = 'display' + className.slice(3);
                                                const buttonId = 'btn' + className.slice(3);
                                                const boolVar = 'bool' + className.slice(3);
                                                button.addEventListener('click', () => toggleSection({
                                                    className,
                                                    displayId,
                                                    buttonId,
                                                    boolVar
                                                }));
                                            });

                                            //   const joinButtons = document.querySelectorAll('.dropbtnMinistry');
                                            //   joinButtons.forEach(button => {
                                            //     button.addEventListener('click', () => changeFormValue(button.dataset.section));
                                            //   });

                                            function showFullImage(imageUrl) {
                                                // create a new image element
                                                var fullImage = new Image();

                                                // set the source of the new image to the full-size image URL
                                                fullImage.src = imageUrl;

                                                // create a new div element to hold the full-size image
                                                var overlay = document.createElement('div');
                                                overlay.style.position = 'fixed';
                                                overlay.style.top = 0;
                                                overlay.style.left = 0;
                                                overlay.style.width = '100%';
                                                overlay.style.height = '100%';
                                                overlay.style.backgroundColor = 'rgba(0,0,0,0.8)';

                                                // add the new image element to the div
                                                overlay.appendChild(fullImage);

                                                // add the div to the page
                                                document.body.appendChild(overlay);

                                                // add an onclick event to the div to remove it when clicked
                                                overlay.onclick = function() {
                                                    document.body.removeChild(overlay);
                                                }
                                            }

                                        });

                                        // Get the thumbnail images
                                        var thumbnailImages = document.querySelectorAll('.thumbnail-image');

                                        // Get the lightbox elements
                                        var lightbox = document.getElementById('lightbox');
                                        var closeButton = document.getElementById('close-button');
                                        var lightboxImage = document.getElementById('lightbox-image');

                                        // Add event listeners to the thumbnail images
                                        thumbnailImages.forEach(function(thumbnailImage) {
                                            thumbnailImage.addEventListener('click', function() {
                                                // Get the URL of the full-size image
                                                var fullImageUrl = thumbnailImage.src.replace('-thumbnail', '');

                                                // Set the src attribute of the lightbox image
                                                lightboxImage.src = fullImageUrl;

                                                // Show the lightbox
                                                lightbox.style.display = 'flex';
                                            });
                                        });

                                        // Add an event listener to the close button
                                        closeButton.addEventListener('click', function() {
                                            // Hide the lightbox
                                            lightbox.style.display = 'none';
                                        });

                                        // Add an event listener to the lightbox
                                        lightbox.addEventListener('click', function(event) {
                                            // Check if the click occurred outside the image
                                            if (event.target == lightbox) {
                                                // Hide the lightbox
                                                lightbox.style.display = 'none';
                                            }
                                        });

                                        function centerLightbox() {
                                            var width = window.innerWidth;
                                            var height = window.innerHeight;

                                            if (width <= 768) { // set the width of mobile view
                                                lightbox.style.display = 'none';
                                                lightbox.style.top = '0';
                                                lightbox.style.left = '0';
                                                lightbox.style.width = '100%';
                                                lightbox.style.height = '100%';
                                                lightbox.style.alignItems = 'center';
                                                lightbox.style.justifyContent = 'center';
                                                lightbox.style.padding = '0';

                                                lightboxImage.style.maxWidth = '100%';
                                                lightboxImage.style.maxHeight = '100%';
                                            } else {
                                                lightbox.style.width = '';
                                                lightbox.style.height = '';
                                                lightbox.style.alignItems = '';
                                                lightbox.style.justifyContent = '';
                                                lightbox.style.padding = '';

                                                lightboxImage.style.maxWidth = '';
                                                lightboxImage.style.maxHeight = '';
                                            }
                                        }

                                        window.addEventListener('resize', centerLightbox);
                                        centerLightbox();



                                        var imageContainer = document.querySelector('.columnMin');
                                        var magnifier = imageContainer.querySelector('.magnifier');
                                        var magnifierImg = document.createElement('img');
                                        magnifierImg.src = imageContainer.querySelector('img').src;
                                        magnifier.appendChild(magnifierImg);

                                        var img = imageContainer.querySelector('img');
                                        magnifier.style.backgroundImage = 'url(' + img.src + ')';
                                        magnifier.style.backgroundSize = (img.width * 2) + 'px ' + (img.height * 2) + 'px';

                                        imageContainer.addEventListener('mousemove', function(e) {
                                            var x = e.clientX - imageContainer.getBoundingClientRect().left;
                                            var y = e.clientY - imageContainer.getBoundingClientRect().top;

                                            var mx = x / img.width * 100;
                                            var my = y / img.height * 100;

                                            magnifier.style.left = (mx - 50) + '%';
                                            magnifier.style.top = (my - 50) + '%';
                                            magnifierImg.style.left = -mx + '%';
                                            magnifierImg.style.top = -my + '%';
                                        });
                                    </script>
    </body>
</x-app-layout>
