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

            .darken {
                filter: brightness(80%);
            }

            .dropbtn {
                background-color: #2f2f2f;
                color: white;
                padding: 10px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                min-width: 300px;
                border-radius: 20px;
                text-align: center;
                font-weight: bold;
                font-family: "poppins", sans-serif;
            }

            .dropbtn:hover {
                background-color: #0fa6d1;
            }

            .dropdown {
                position: relative;
                display: inline-block;
                padding: 10px;
                text-align: center;
            }

            .title {
                font-weight: bold;
                color: black;
            }

            .desc {
                color: black;
            }

            #bdoImg,
            #bpiImg,
            #gcashImg {
                display: none;
            }

            .img-container {
                text-align: center;
            }

            .common-img {
                width: 500px;
                /* Set your desired width */
                height: auto;
                margin-bottom: 10px;
            }

            .title,
            .desc {
                margin: 0;
            }
        </style>
    </head>

    <body class="bg-fixed" onload="defaultbank()"
        style=" background-image: url('/img/give hero.jpg'); background-size:
        cover; font-family: 'Poppins' , sans-serif; ">
        <div class="container mx-auto grid grid-cols-9">
            <div class="col-span-0 xl:col-span-3"></div>
            <div
                class="col-span-9 xl:col-span-4 flex flex-col h-screen justify-center xl:items-end text-white text-center ">
                <h1 class="text-7xl font-bold slide-down mb-4">Beyond Giving</h1>
                <p class="text-1xl slide-right mb-4">
                    The word "tithe" literally means tenth or 10%. Tithing, or giving ten percent of your income, isn't
                    merely giving something to God. It's giving back what was his to begin with. All that we have, or
                    hope
                    to have, comes from him. The bible says that tithing is a reminder that God is the supplier of
                    everything. It teaches us to always put God first in our lives.
                </p>
                <div class="fade-in mb-4 slide-right">
                    <a href="#bankSelect"
                        class="bg-slate-900 hover:bg-blue-200 text-cyan-600 rounded-full py-2 px-12 font-poppins font-bold text-xl cursor-pointer">
                        BANK DEPOSIT / TRANSFER
                    </a>
                </div>

                <div class="fade-in mb-4 slide-left">
                    <a
                        class="bg-cyan-600 hover:bg-blue-200 text-white rounded-full py-2 px-12 font-poppins font-bold text-xl cursor-pointer">
                        INTERNATIONAL PAYPAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a>
                </div>


            </div>
            <div class="col-span-0 xl:col-span-2"></div>
        </div>
        <div id="bankSelect" class="flex flex-col pt-5 bg-gray-200 text-center opacity-90">
            <h1 class="mb-4 text-5xl font-bold text-cyan-600 font-poppins slide-down">
                BANK DEPOSIT / TRANSFER
            </h1>
            <p class="mb-4 fade-in"> Select a bank where you would like to make a transaction </p>
            <div class="dropdown mb-4 slide-down">
                <select class="dropbtn" onchange="bankselect(this);">
                    <option value="BDO" selected>BDO - BANCO DE ORO</option>
                    <option value="BPI">BPI - Bank of the Philippine Islands</option>
                    <option value="GCASH">GCASH</option>
                </select>
            </div>
            <div class="img-container flex items-center justify-center mb-5 fade-in slide-up mx-5">
                <div id="bdoImg" class="mx-auto">
                    <img class="common-img" src="img/bdologo.png" alt="BDO Logo">
                    <div>
                        <p class="title">Account Name</p>
                        <p class="desc">Myrna Pedron / Nory Capili</p>
                        <br>
                        <p class="title">Peso Savings Account</p>
                        <p class="desc">001278058556</p>
                    </div>
                </div>
                <div id="bpiImg" class="mx-auto">
                    <img class="common-img" src="img/bpilogo.png" alt="BPI Logo">
                    <div>
                        <p class="title">Account Name</p>
                        <p class="desc">Myrna Pedron / Nory Capili</p>
                        <br>
                        <p class="title">Account Number</p>
                        <p class="desc">1223123423</p>
                    </div>
                </div>
                <div id="gcashImg" class="mx-auto">
                    <img class="common-img" src="img/gcash.png" alt="GCASH Logo">
                    <div>
                        <p class="title">Account Name</p>
                        <p class="desc">Myrna Pedron / Nory Capili</p>
                        <br>
                        <p class="title">Mobile Number</p>
                        <p class="desc">09998887654</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col pt-5 bg-gray-300 text-center opacity-90">
            <h1 class="mb-4 text-5xl font-bold text-gray-800 font-poppins slide-down">
                REQUEST OFFICIAL RECEIPT
            </h1>
            <p class="mb-4 fade-in"> Official receipt can only be requested after you have <br>
                completed your transaction
            </p>
            <form action="{{ route('cart.checkoutCustom') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 slide-left">
                    <label for="fullname" class="block text-gray-700 font-semibold">Full Name *</label>
                    <input type="text" id="fullname" name="fullname"
                        class="w-96 border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4 slide-right">
                    <label for="email" class="block text-gray-700 font-semibold">Email Address *</label>
                    <input type="text" id="email" name="email"
                        class="w-96 border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4 slide-up">
                    <label for="transactionDate" class="block text-gray-700 font-semibold">Date of Transaction *</label>
                    <input type="date" id="transactionDate" name="transactionDate"
                        class="w-48 border border-gray-300 rounded-md p-2" required>
                </div>
                <p class="mb-2 slide-down">Attach screenshot of transaction or deposit slip (optional)</p>
                <hr class="w-2/5 mx-auto mb-2 fade-in">
                <div class="mb-4">
                    <label for="fileAttachment" class="block text-gray-700 font-semibold fade-in">Attach File</label>
                    <input type="file" id="fileAttachment" name="fileAttachment"
                        class="bg-white w-96 border border-gray-300 rounded-md p-2 fade-in"
                        accept="image/*, application/pdf">
                    <!-- The 'accept' attribute limits file types that can be uploaded (optional) -->
                </div>
                <button type="submit"
                    class="bg-cyan-600 hover:bg-blue-200 text-white rounded-full py-3 px-12 font-poppins font-bold text-1xl mb-4 fade-in">
                    Submit
                </button>
            </form>


        </div>
        <script type="text/javascript">
            function bankselect(bank) {
                const bdoImg = document.getElementById('bdoImg');
                const bpiImg = document.getElementById('bpiImg');
                const gcashImg = document.getElementById('gcashImg');
                switch (bank.value) {
                    case 'BDO':
                        bdoImg.style.display = 'block';
                        bpiImg.style.display = 'none';
                        gcashImg.style.display = 'none';
                        break;
                    case 'BPI':
                        bdoImg.style.display = 'none';
                        bpiImg.style.display = 'block';
                        gcashImg.style.display = 'none';
                        break;
                    case 'GCASH':
                        bdoImg.style.display = 'none';
                        bpiImg.style.display = 'none';
                        gcashImg.style.display = 'block';
                        break;
                }
            }

            function defaultbank() {
                document.getElementById('bdoImg').style.display = 'block';
            }
        </script>




    </body>
</x-app-layout>
