<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Script for font awesome -->
    <script src="https://kit.fontawesome.com/f648aa3f20.js" crossorigin="anonymous"></script>
    <!-- Script for Atilwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- external style -->
    <link rel="stylesheet" href="./assets/css/home.css">
    <title>Hospital</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar px-3 md:px-[70px] py-3 md:py-[20px]">
        <h2 class="text-2xl font-bold">HealthCare</h2>
        <div class="navbar__s2 hidden md:flex gap-2">
            <a href="" class="font-medium">Home</a>
            <a href="#about">About Us</a>
            <a href="#why">Choose Us</a>
            <a href="#quality">Quality</a>
        </div>
        <a class="login" href="./receptionist/login.php">Login</a>
    </nav>
    <!-- Banner -->
    <div class="banner px-[5px] md:px-[70px]">
        <div class="banner__s1 pt-[120px] md:pt-[160px] pb-[30px] md:pb-[70px]">
            <div>
                <span>Health Harmony</span>
            </div>
            <div>
                <h1 class="md:text-[85px]/25 text-4xl/12">Your Gateway to <i>Optimal</i><br>Health Solution</h1>
            </div>
            <div>
                <p class="text-lg md:text-[20px]">Our platform serves as your gateway to a healthier life, offering personalized <br class="hidden md:block"> guidance, valuable insights, and support for your well-being.</p>
            </div>
        </div>
        <div class="banner__s2">
            <div>
                <img src="./assets/images/banner/b1.png" alt="" width="330" class="hidden md:block">
            </div>
            <div class="relative">
                <img src="./assets/images/banner/b2.png" alt="" width="560px">
                <button class="bg-[#96ae9700] backdrop-blur-lg block md:hidden absolute top-5 left-5 z-1 text-white border-l-5 border-[#96ae97] md:border-none">Book Appointment</button>
            </div>
            <div class="banner__s2s3">
                <div>
                    <img src="./assets/images/banner/b3.png" alt="" width="465" class="hidden md:block">
                </div>
                <div class="banner__card hidden md:block">
                    <h2>Find more Services</h2>
                    <p>One Stop Shop for All Medical<br> Needs for Complete Recovery</p>
                    <button class="bg-white text-black">Book Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="body px-[10px] md:px-[70px]">

        <!-- brands -->
        <div class="brands hidden md:flex justify-between">
            <img src="./assets/images/brands/b1.png" alt="">
            <img src="./assets/images/brands/b2.png" alt="">
            <img src="./assets/images/brands/b3.png" alt="">
            <img src="./assets/images/brands/b4.png" alt="">
        </div>

        <!-- About Us -->
        <div class="about flex justify-between md:gap-30 pt-15 md:pt-[140px] pb-15 md:pb-[40px] border-[#96ae97] border-b-1 md:border-0" id="about">
            <div class="relative">
                <img src="./assets/images/about.png" alt="" class="rounded-2xl w-450 hidden md:block">
                <div class="absolute bottom-5 left-10 bg-white p-3 rounded-2xl w-100 hidden md:block">
                    <h1 class="text-2xl font-medium"><i class="fa-solid fa-circle-check text-[#96ae97]"></i> 25 Years of Experience</h1>
                    <p class="text-lg text-gray-500">We have been serving the community eith excellence and compassion for liver 25 years</p>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-5 text-center md:text-justify">
                <div class="">
                    <span>About Us</span>
                    <h1 class="text-3xl md:text-5xl mt-6 md:mt-8">We Provide Quality Care<br>for Your Health</h1>
                    <p class="text-lg md:text-2xl mt-5 md:mt-8 text-gray-500">We are committed to delivering exceptional healthcare services to prioritize your well-being with our experienced professionals strive to create an environment that fosters healing and promotes a healthy lifestyle.</p>
                </div>
                <div class="grid grid-cols-3 gap-1">
                    <div class="about__sCard  md:w-[200px] p-1 md:p-[10px]">
                        <h1 class="text-2xl md:text-[50px]">350+</h1>
                        <p class="text-[16px] md:text-[20px]">Companies Affliated</p>
                    </div>
                    <div class="about__sCard md:w-[200px] p-1 md:p-[10px]">
                        <h1 class="text-2xl md:text-[50px]">567+</h1>
                        <p class="text-[16px] md:text-[20px]">Expert doctors</p>
                    </div>
                    <div class="about__sCard md:w-[200px] p-1 md:p-[10px]">
                        <h1 class="text-2xl md:text-[50px]">780+</h1>
                        <p class="text-[16px] md:text-[20px]">Happy patient</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="why pt-15 md:pt-[100px] pb-15 md:pb-0 text-center md:text-start border-[#96ae97] border-b-1 md:border-0" id="why">
            <div class="mb-6 md:mb-8">
                <span>Why Choose Us</span>
            </div>
            <div class="md:flex justify-between mb-8">
                <h1 class="text-3xl md:text-[50px]">Treatment available for you</h1>
                <p class="hidden md:block text-xl text-gray-500">Our dedicated team of professionals is committed <br class="hidden md:block"> to providing personalized care medical solutions.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-5">
                <div class="why__card p-2 md:p-[20px]">
                    <i class="fa-solid fa-flask-vial md:text-[30px] p-3 md:p-[20px]"></i>
                    <h1 class="md:text-[26px]">24/7 Pharmacy Services</h1>
                    <p class="md:text-[18px] text-sm">Access to a fully stocked pharmacy round the clock for medications and healthcare essentials.</p>
                </div>
                <div class="why__card p-2 md:p-[20px]">
                    <i class="fa-solid fa-bell md:text-[30px] p-3 md:p-[20px]"></i>
                    <h1 class="md:text-[26px]">Emergency Care</h1>
                    <p class="md:text-[18px] text-sm">A fully-equipped emergency department ensures swift and effective response to critical situations.</p>
                </div>
                <div class="why__card p-2 md:p-[20px]">
                    <i class="fa-solid fa-comments md:text-[30px] p-3 md:p-[20px]"></i>
                    <h1 class="md:text-[26px]">Telemedicine Services</h1>
                    <p class="md:text-[18px] text-sm">The hospital offers a wide range of medical specialties, ensuring expertise in various fields of medicine.</p>
                </div>
                <div class="why__card p-2 md:p-[20px]">
                    <i class="fa-solid fa-heart md:text-[30px] p-3 md:p-[20px]"></i>
                    <h1 class="md:text-[26px]">Rehabilitation Facilities</h1>
                    <p class="md:text-[18px] text-sm">Utilize rehabilitation services to support recovery and enhance your physical well-being rehabilitation services.</p>
                </div>
                <div class="why__card p-2 md:p-[20px]">
                    <i class="fa-solid fa-paste md:text-[30px] p-3 md:p-[20px]"></i>
                    <h1 class="md:text-[26px]">Comprehensive Specialties</h1>
                    <p class="md:text-[18px] text-sm">The hospital offers a wide range of medical specialties, ensuring expertise in various fields of medicine.</p>
                </div>
                <div class="why__card p-2 md:p-[20px]">
                    <i class="fa-solid fa-building md:text-[30px] p-3 md:p-[20px]"></i>
                    <h1 class="md:text-[26px]">Luxurious Patient Rooms</h1>
                    <p class="md:text-[18px] text-sm">Patients experience comfort in well-appointed private rooms with modern amenities.</p>
                </div>
            </div>
        </div>

        <!-- Quality -->
        <div class="quality md:flex justify-between pt-15 md:pt-[140px] pb-15 md:pb-[140px] relative text-center md:text-justify relative" id="quality">
            <div class="flex flex-col justify-between absolute md:static backdrop-blur-xl p-5 md:p-0 rounded-2xl">
                <div>
                    <span class="hidden md:inline">Quality</span>
                    <h1 class="mt-6 md:mt-8 text-3xl md:text-5xl text-white md:text-black">Our Performance Quality<br> Care, Made For You</h1>
                    <p class="text-lg md:text-2xl mt-3 text-white md:text-gray-500">We understand that each individual has distinct requirements when<br class="hidden md:block"> it comes to their health and well-being.</p>
                    <div class="md:text-xl mt-4 text-gray-500 hidden md:block">
                        <p><i class="fa-solid fa-circle-check text-[#96ae97]"></i> &nbsp;Expert Healthcare Professionals</p>
                        <p><i class="fa-solid fa-circle-check text-[#96ae97]"></i> &nbsp;Cutting-Edge Technology</p>
                        <p><i class="fa-solid fa-circle-check text-[#96ae97]"></i> &nbsp;Timely and Efficient Services</p>
                    </div>
                </div>
                <div>
                    <button class="hidden md:block" style="font-size: 22px;">Learn More</button>
                </div>
            </div>
            <div class="mt-5 md:mt-0">
                <img src="./assets/images/quality.png" alt="" class="rounded-2xl w-140">
                <div class="absolute top-45 right-100 bg-white p-3 rounded-2xl w-70 border border-[#96ae97] hidden md:block">
                    <h1 class="text-2xl font-medium"><i class="fa-solid fa-shield-heart text-[#96ae97]"></i> 24/7 Support</h1>
                    <p class="text-lg text-gray-500">We are available when you want</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer p-10 md:p-[70px] bg-[#96ae971f]">
        <div class="footer__s1 flex justify-between pb-5 md:pb-[40px] border-b border-[#96ae97]">
            <div>
                <h2 class="text-2xl font-bold">HealthCare</h2>
                <p class="text-lg mt-3 md:mt-5 mb-3 md:mb-5 text-gray-500">Experience personalized healthcare from the comfort of<br class="hidden md:block"> your home with our advanced telemedicine services.</p>
                <div class="text-2xl flex gap-5 text-gray-500">
                    <span><i class="fa-brands fa-whatsapp"></i></span>
                    <span><i class="fa-brands fa-instagram"></i></span>
                    <span><i class="fa-brands fa-square-youtube"></i></span>
                </div>
            </div>
            <div class="hidden md:flex gap-40">
                <div class="text-xl flex flex-col gap-5">
                    <p>Company</p>
                    <p class="text-gray-500">About</p>
                    <p class="text-gray-500">Why Us</p>
                    <p class="text-gray-500">Quality</p>
                    <p class="text-gray-500">Contact</p>
                </div>
                <div class="text-xl flex flex-col gap-5">
                    <p>Support</p>
                    <p class="text-gray-500">FAQs</p>
                    <p class="text-gray-500">Support Center</p>
                    <p class="text-gray-500">Security</p>
                </div>
                <div class="text-xl flex flex-col gap-5">
                    <p>More</p>
                    <p class="text-gray-500">Become Member</p>
                    <p class="text-gray-500">Events</p>
                    <p class="text-gray-500">Terms & Conditions</p>
                </div>
            </div>
        </div>
        <div class="footer__s2 pt-[30px] text-gray-500 md:text-xl">
            &copy; HealthCare, 2025 Allrights reserved
        </div>
    </div>
</body>

</html>