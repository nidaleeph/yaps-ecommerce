<!DOCTYPE html>
<html lang="en">
    <head>
        <style scoped>
            body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            footer {
                display: flex;
                justify-content: space-around;
                align-items: center;
                background-color: black;
                color: white;
                padding: 20px;
            }

            .contact-section,
            .services-section,
            .social-media-section {
                flex: 1;
                padding: 20px;
                width: 400px;
            }

            .contact-section h3,
            .services-section h3,
            .social-media-section h3 {
                font-size: 1.2em;
                font-weight: bold;
            }

            .social-media-section-images {
                display: flex;
                align-items: center;
            }

            .social-media-section h3 {
                margin-right: 20px;
                font-size: 1.2em;
                font-weight: bold;
            }

            .social-media-section img {
                width: 30px;
                margin-right: 10px;
                transition: transform 0.3s;
                /* Add transition for a smooth effect */
            }

            .social-media-section img:hover {
                transform: scale(1.2);
                /* Increase the size on hover (adjust the scale factor as needed) */
            }

            .social-media-section img:last-child {
                margin-right: 0;
                /* Remove the margin for the last child to avoid unnecessary space */
            }

            .contact-services-container {
                display: flex;
            }

            /* Media queries for responsive design */

            @media screen and (max-width: 992px) {
                footer {
                    flex-direction: column;
                    text-align: center;
                }

                .contact-section,
                .services-section,
                .social-media-section {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .contact-services-container {
                    display: block;
                }

                .social-media-section {
                    text-align: center;
                    /* Center the content horizontally */
                }

                .social-media-section-images {
                    display: flex;
                    justify-content: center;
                    /* Center the content horizontally */
                    align-items: center;
                }

                .social-media-section img {
                    width: 30px;
                    margin-right: 10px;
                    transition: transform 0.3s;
                }

                .social-media-section img:hover {
                    transform: scale(1.2);
                }
            }
        </style>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
        />
    </head>

    <body>
        <!-- Your Website Content -->
        <footer>
            <div class="contact-services-container">
                <div class="contact-section text-center">
                    <h3 class="mb-2">Contact Us</h3>
                    <hr class="mb-2" />
                    <p>2nd floor Riscord Bldg. 1165 Quirino Highway,</p>
                    <p>Brgy. Kaligayahan Novaliches, Quezon City</p>
                    <p>0933-859-3071</p>
                    <p>metronorthdaybyday@gmail.com</p>
                </div>

                <div class="services-section text-center">
                    <h3 class="mb-2">Services</h3>
                    <hr class="mb-2" />
                    <p><strong>Sunday Service:</strong></p>
                    <p>Bible Study - 9:00AM – 10:00 AM</p>
                    <p>Regular Service - 10:00AM – 12:00 PM</p>
                    <p><strong>Midweek Service:</strong></p>
                    <p>Thursdays - 8:00PM - 9:30PM</p>
                </div>

                <div class="text-center">
                    <div class="social-media-section">
                        <h3 class="mb-2">Follow Us</h3>
                        <hr class="mb-2" />
                        <div
                            class="social-media-section-images flex justify-center"
                        >
                            <a
                                href="https://www.facebook.com/DBDMetroNorth"
                                target="_blank"
                                class="mx-2"
                            >
                                <img
                                    src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Facebook_f_logo_%282021%29.svg/1024px-Facebook_f_logo_%282021%29.svg.png"
                                    alt="Facebook Logo"
                                />
                            </a>
                            <a
                                href="https://www.twitter.com/your-twitter-page"
                                target="_blank"
                                class="mx-2"
                            >
                                <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Logo_of_Twitter.svg/512px-Logo_of_Twitter.svg.png"
                                    alt="Twitter Logo"
                                />
                            </a>
                            <a
                                href="https://www.youtube.com/your-youtube-channel"
                                target="_blank"
                                class="mx-2"
                            >
                                <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052"
                                    alt="YouTube Logo"
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Your Website Scripts -->
    </body>
</html>
