<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f648aa3f20.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./assets/css/home.css">
    <title>Hospital</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <h2 class="text-2xl font-bold">HealthCare</h2>
        <div class="navbar__s2">
            <a href="" class="font-medium">Home</a>
            <a href="#about">About Us</a>
            <a href="#why">Choose Us</a>
            <a href="#quality">Quality</a>
        </div>
        <a class="login" href="./receptionist/login.php">Login</a>
    </nav>
    <!-- Banner -->
    <div class="banner">
        <div class="banner__s1">
            <div>
                <span>Health Harmony</span>
            </div>
            <div>
                <h1>Your Gateway to <i>Optimal</i><br>Health Solution</h1>
            </div>
            <div>
                <p>Our platform serves as your gateway to a healthier life, offering personalized <br> guidance, valuable insights, and support for your well-being.</p>
            </div>
        </div>
        <div class="banner__s2">
            <div>
                <img src="./assets/images/banner/b1.png" alt="" width="330">
            </div>
            <div>
                <img src="./assets/images/banner/b2.png" alt="" width="560">
            </div>
            <div class="banner__s2s3">
                <div>
                    <img src="./assets/images/banner/b3.png" alt="" width="465" height="">
                </div>
                <div class="banner__card">
                    <h2>Find more Services</h2>
                    <p>One Stop Shop for All Medical<br> Needs for Complete Recovery</p>
                    <button>Book Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="body">

        <!-- brands -->
        <div class="brands">
            <img src="./assets/images/brands/b1.png" alt="">
            <img src="./assets/images/brands/b2.png" alt="">
            <img src="./assets/images/brands/b3.png" alt="">
            <img src="./assets/images/brands/b4.png" alt="">
        </div>

        <!-- About Us -->
        <div class="about flex justify-between gap-30" id="about">
            <div class="relative">
                <img src="./assets/images/about.png" alt="" class="rounded-2xl w-450">
                <div class="absolute bottom-5 left-10 bg-white p-3 rounded-2xl w-100">
                    <h1 class="text-2xl font-medium"><i class="fa-solid fa-circle-check text-[#96ae97]"></i> 25 Years of Experience</h1>
                    <p class="text-lg text-gray-500">We have been serving the community eith excellence and compassion for liver 25 years</p>
                </div>
            </div>
            <div class="flex flex-col justify-between">
                <div class="">
                    <span>About Us</span>
                    <h1 class="text-5xl mt-8">We Provide Quality Care<br>for Your Health</h1>
                    <p class="text-2xl mt-8 text-gray-500">We are committed to delivering exceptional healthcare services to prioritize your well-being with our experienced professionals strive to create an environment that fosters healing and promotes a healthy lifestyle.</p>
                </div>
                <div class="flex justify-between">
                    <div class="about__sCard">
                        <h1>350+</h1>
                        <p>Companies Affliated</p>
                    </div>
                    <div class="about__sCard">
                        <h1>567+</h1>
                        <p>Expert doctors</p>
                    </div>
                    <div class="about__sCard">
                        <h1>780+</h1>
                        <p>Happy patient</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="why" id="why">
            <div class="mb-8">
                <span>Why Choose Us</span>
            </div>
            <div class="flex justify-between mb-8">
                <h1 class="text-[50px]">Treatment available for you</h1>
                <p class="text-xl text-gray-500">Our dedicated team of professionals is committed <br> to providing personalized care medical solutions.</p>
            </div>
            <div class="grid grid-cols-3 gap-5">
                <div class="why__card">
                    <i class="fa-solid fa-flask-vial"></i>
                    <h1>24/7 Pharmacy Services</h1>
                    <p>Access to a fully stocked pharmacy round the clock for medications and healthcare essentials.</p>
                </div>
                <div class="why__card">
                    <i class="fa-solid fa-bell"></i>
                    <h1>Emergency Care</h1>
                    <p>A fully-equipped emergency department ensures swift and effective response to critical situations.</p>
                </div>
                <div class="why__card">
                    <i class="fa-solid fa-comments"></i>
                    <h1>Telemedicine Services</h1>
                    <p>The hospital offers a wide range of medical specialties, ensuring expertise in various fields of medicine.</p>
                </div>
                <div class="why__card">
                    <i class="fa-solid fa-heart"></i>
                    <h1>Rehabilitation Facilities</h1>
                    <p>Utilize rehabilitation services to support recovery and enhance your physical well-being rehabilitation services.</p>
                </div>
                <div class="why__card">
                    <i class="fa-solid fa-paste"></i>
                    <h1>Comprehensive Specialties</h1>
                    <p>The hospital offers a wide range of medical specialties, ensuring expertise in various fields of medicine.</p>
                </div>
                <div class="why__card">
                    <i class="fa-solid fa-building"></i>
                    <h1>Luxurious Patient Rooms</h1>
                    <p>Patients experience comfort in well-appointed private rooms with modern amenities.</p>
                </div>
            </div>
        </div>

        <!-- Quality -->
        <div class="quality flex justify-between pt-[140px] pb-[140px] relative" id="quality">
            <div class="flex flex-col justify-between">
                <div>
                    <span>Quality</span>
                    <h1 class="mt-8 text-5xl">Our Performance Quality<br> Care, Made For You</h1>
                    <p class="text-2xl mt-3 text-gray-500">We understand that each individual has distinct requirements when<br> it comes to their health and well-being.</p>
                    <div class="text-2xl mt-4 text-gray-500">
                        <p><i class="fa-solid fa-circle-check text-[#96ae97]"></i> &nbsp;Expert Healthcare Professionals</p>
                        <p><i class="fa-solid fa-circle-check text-[#96ae97]"></i> &nbsp;Cutting-Edge Technology</p>
                        <p><i class="fa-solid fa-circle-check text-[#96ae97]"></i> &nbsp;Timely and Efficient Services</p>
                    </div>
                </div>
                <div>
                    <button style="font-size: 22px;">Learn More</button>
                </div>
            </div>
            <div class="">
                <img src="./assets/images/quality.png" alt="" class="rounded-2xl w-140">
                <div class="absolute top-45 right-100 bg-white p-3 rounded-2xl w-70 border border-[#96ae97]">
                    <h1 class="text-2xl font-medium"><i class="fa-solid fa-shield-heart text-[#96ae97]"></i> 24/7 Support</h1>
                    <p class="text-lg text-gray-500">We are available when you want</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer__">

        </div>
        <div></div>
    </div>
</body>

</html>