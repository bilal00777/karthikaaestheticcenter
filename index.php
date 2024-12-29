<?php
// Start a session to store success or error messages
session_start();
include 'config/config.php'; // Include your database connection file

// Initialize variables for storing error or success messages
$success_message = "";
$error_message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $first_name = $_POST['first_name'];
    $second_name = $_POST['second_name'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $consent = isset($_POST['consent']) ? 1 : 0; // Checkbox for consent

    // Basic form validation
    if (empty($first_name) || empty($second_name) || empty($telephone) || empty($email)) {
        $error_message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please provide a valid email address.";
    } else {
        // If no validation errors, insert data into the database
        $sql = "INSERT INTO consultations (first_name, second_name, telephone, email, message, consent) VALUES (:first_name, :second_name, :telephone, :email, :message, :consent)";

        // Prepare and bind parameters
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':second_name', $second_name);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':consent', $consent);

        // Try to execute the statement
        if ($stmt->execute()) {
            $success_message = "Thank you! Your consultation request has been submitted.";
        } else {
            $error_message = "Oops! Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Karthika Aesthetic Centre</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Include Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">



    <!-- style -->
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

        body {
            font-family: 'Georgia', serif;
            background-color: #f8f8f8;
        }

        .navbar-brand {
            font-size: 2rem;
            display: flex;
            align-items: center;
        }

        .logo {
    max-height: 50px; /* Adjust height as needed */
    max-width: 100px; /* Adjust width as needed */
    margin-right: 10px; /* Space between logo and text */
    object-fit: contain; /* Ensures the image fits without distortion */
}


        .navbar-brand .karthika {
            font-family: "Lato", sans-serif;
            font-weight: bold;
            color: #8a7a5c;
            padding: 5px 10px;
            border-radius: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand .aesthetic-centre {
            font-family: "Lato", sans-serif;
            font-weight: 300;
            color: black;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .nav-link {
            color: initial;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            color: #8a7a5c !important;
            border-bottom: 2px solid #8a7a5c;
        }

        .timing-info {
            background-color: #8a7a5c;
            color: #fff;
            padding: 5px 0;
            text-align: center;
            font-size: 0.95rem;
        }


        @media (max-width:786px) {
            .timing-info {

                padding: 6px 0;

                font-size: 0.65rem;
            }

        }

        .hero-section {
    /* Remove or comment out the background image property */
    /* background: url('images/hero_section.jpg') no-repeat center center; */
    background-size: cover;
    padding: 250px 0;
    color: #fff;
    position: relative; /* Ensure the section positions its children properly */
}


        .hero-section .container {
            max-width: 800px;
            margin: 0 auto;
        }



        .btn-cta {
            border: 2px solid #8a7a5c;
            color: #8a7a5c;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-cta:hover {
            background-color: #8a7a5c;
            color: white;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-align: right;
            color: #000000;
            text-shadow: -1px -1px 0 #ffffff, 1px -1px 0 #ffffff, -1px 1px 0 #000, 1px 1px 0 #000;
            opacity: 0;
        }

        .hero-section p {
            font-size: 1.25rem;
            display: none;
        }

        .services-section {
            padding: 80px 0;
        }

        .service-box {
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .service-box:hover {
            transform: translateY(-10px);
        }

        .service-box img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 20px;
            border-radius: 10px;
            transition: all .3s ease-in;
        }

        .service-box:hover img {
            transform: scale(1.07);
        }

        .service-box h5 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .service-box p {
            color: #555;
        }

        .footer-logo h1 {
            font-size: 2.25rem;
            color: #8a7a5c;
        }

        .footer-social img {
            width: 30px;
            height: 30px;
            filter: grayscale(100%);
        }


        @media (max-width:786px) {
            .aesthetic-centre {
                display: none;
            }

            .hero-section {
            

                background-size: 400px 400px;
                padding: 70px 0;
                color: #fff;
                text-align: center;
            }


            .btn-outline-light {
                color: #333;
                position: relative;
                top: 140px;
                border: #333 2px solid;
            }
        }

        .icon_tel {
            animation: shake 1.82s cubic-bezier(.36, .07, .19, .97) infinite;

            transform: translate3d(0, 0, 0);
            transform: scale(1);
            backface-visibility: hidden;
            perspective: 1000px;
            color: #8a7a5c;
        }

        @keyframes shake {

            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%,
            80% {
                transform: translate3d(2px, 0, 0);
                transform: scale(1.2);
            }

            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }

            90%,
            100% {
                transform: translate3d(0, 0, 0);
            }
        }
    </style>
</head>

<body>

    <!-- Timing Information -->
    <div class="timing-info">
        <span class="timing-item">Monday to Saturday 10:00 AM - 7:00 PM</span>
        <span class="timing-separator mx-3">|</span>
        <span class="timing-item">Sunday 10:00 AM - 1:30 PM</span>
    </div>

    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
    <img src="logo/kathikaastheticcenter.png" alt="Karthika's Aesthetic Centre" class="logo">
    <span class="karthika">Karthika's</span> <span class="aesthetic-centre">Aesthetic Centre</span>
</a>

            <a class="btn btn-call-icon d-lg-none d-block  icon_tel" href="tel:+1234567890">
                <i class="bi bi-telephone-fill"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item">
                        <a class="nav-link px-3" href="About Us.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="Treatments.html">Treatments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="Career.html">Career</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="Contact Us.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 " href="Appointment.php">Appointment</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

 <!-- Hero Section -->
<section class="hero-section position-relative">
    <iframe 
        src="https://www.youtube.com/embed/your-video-id?autoplay=1&mute=1&loop=1&playlist=your-video-id" 
        frameborder="0" 
        allow="autoplay; encrypted-media" 
        allowfullscreen
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;">
    </iframe>
    <div class="container text-center position-relative" style="z-index: 1;">
        <h1>Welcome to <br> Karthika's Aesthetic Centre</h1>
        <p>Your destination for healthy skin and hair treatments.</p>
        <a href="Treatments.html" class="btn btn-outline-light btn-lg mt-3">Explore Our Treatments</a>
    </div>
</section>

    


    <section class="services-section">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #8a7a5c;">Our Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Medi Facials.jpeg" alt="Medi Facials" class="mb-3" style="width: 200px;">
                        <h5>Medi Facials</h5>
                        <p>A medi-facial combines traditional facial techniques with medical-grade products to address
                            specific skin concerns, performed by licensed professionals.</p>
                        <a href="Medi-Facials.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/GFC/PRP Treatment.jpeg" alt="GFC/PRP Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>GFC/PRP Treatment</h5>
                        <p>Targeted anti-hairfall treatments to promote hair regrowth, strengthen follicles, and enhance
                            overall hair health using advanced therapies.</p>
                        <a href="gfc-prp-treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/LHR.jpeg.webp" alt="Laser Hair Reduction" class="mb-3"
                            style="width: 200px;">
                        <h5>Laser Hair Reduction</h5>
                        <p>A cosmetic procedure using laser technology for the permanent reduction of unwanted body
                            hair, offering a long-term solution.</p>
                        <a href="Laser Hair Reduction.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/RF Treatment.jpg" alt="RF Treatment" class="mb-3" style="width: 200px;">
                        <h5>RF Treatment</h5>
                        <p>A non-invasive procedure using radiofrequency to heat deeper skin layers, stimulating
                            collagen production for improved skin texture and tone.</p>
                        <a href="rf-treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/HIFU Treatment.jpg" alt="HIFU Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>HIFU Treatment</h5>
                        <p>A non-invasive treatment using focused ultrasound to lift and tighten skin, commonly applied
                            in facial rejuvenation and body contouring.</p>
                        <a href="hifutreatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Anti-Aging Treatments.png" alt="Anti-Aging Treatments" class="mb-3"
                            style="width: 200px;">
                        <h5>Anti-Aging Treatments</h5>
                        <p>Advanced treatments to minimize aging effects, such as wrinkles and fine lines, promoting a
                            youthful appearance by restoring skin elasticity.</p>
                        <a href="Anti-Aging Treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Photofacial Treatment.jpg" alt="Photofacial Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>Photofacial Treatment</h5>
                        <p>Non-invasive IPL therapy to improve skin appearance by treating sun damage, age spots, and
                            other skin concerns.</p>
                        <a href="Photo Facial.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Mesotherapy.webp" alt="Mesotherapy" class="mb-3" style="width: 200px;">
                        <h5>Mesotherapy</h5>
                        <p>A non-surgical procedure involving the injection of vitamins and enzymes into the skin, aimed
                            at rejuvenating and improving its overall appearance.</p>
                        <a href="Mesotherapy.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Acne and Scar Treatment.png" alt="Acne and Scar Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>Acne and Scar Treatment</h5>
                        <p>Treatments to reduce breakouts, prevent future acne, and minimize scarring for smoother,
                            clearer skin.</p>
                        <a href="acnetreatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/IV Treatment.jpg" alt="Photofacial Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>IV Treatment</h5>
                        <p>IV glutathione is administered directly to promote skin brightening, detoxification, and
                            wellness.</p>
                        <a href="IV Treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Chemical Peel Treatment.jpeg" alt="Mesotherapy" class="mb-3"
                            style="width: 200px;">
                        <h5>Chemical Peel Treatment</h5>
                        <p>A chemical peel exfoliates the skin to improve texture and appearance.</p>
                        <a href="Chemical Peel treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/HandLeg Treatment.jpeg" alt="Acne and Scar Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>Hand/Leg Treatment</h5>
                        <p>Hand and leg treatments improve skin health, hydration, and texture.</p>
                        <a href="HandLeg Treatmen.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/Body Treatment.jpeg" alt="Mesotherapy" class="mb-3" style="width: 200px;">
                        <h5>Body Treatment</h5>
                        <p>Body polishing exfoliates and rejuvenates skin for a healthier glow.</p>
                        <a href="Body Treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/BrideGroom Treatment.jpg" alt="Acne and Scar Treatment" class="mb-3"
                            style="width: 200px;">
                        <h5>Bride/Groom Treatment</h5>
                        <p>Pre-wedding skincare for radiant, healthy skin leading up to the big day.</p>
                        <a href="Bride Groom Treatment.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <img src="serviceimg/lip micropigmentation.jpeg" alt="Lip Micropigmentation" class="mb-3"
                            style="width: 200px;">
                        <h5>Lip Micropigmentation</h5>
                        <p>Enhance lip color, shape, and appearance with lip micropigmentation.</p>
                        <a href="lip micropigmentation.html" class="btn btn-cta mt-3">Read More</a>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us py-5 bg-light">
        <div class="container">
            <div class="main-content text-center mb-5">
                <h1 class="text-uppercase" style="color: #8a7a5c;">Experience the Best in Aesthetic Care</h1>
                <p style="font-size: 1.25rem;">Karthika's Aesthetic Centre provides expert care, cutting-edge
                    facilities, and personalized treatment for your skin and hair needs.</p>
            </div>

            <div class="row">
                <div class="col-md-3 mb-4 ">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/diamond.png" alt="Expert Team Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Expert Team</h3>
                        <p>Our skilled professionals are committed to delivering the highest standard of care and
                            expertise.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/stopwatch.png"
                                alt="Comprehensive Services Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Comprehensive Services</h3>
                        <p>A wide range of treatments, addressing all your aesthetic concerns in one place.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/gear.png"
                                alt="State of the Art Facilities Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">State-of-the-Art Facilities</h3>
                        <p>Our modern facilities use the latest technology for a safe and comfortable experience.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/like.png" alt="Personalized Approach Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Personalized Approach</h3>
                        <p>Each treatment is tailored to meet your unique aesthetic goals and needs.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/star.png" alt="Quality Products Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Quality Products</h3>
                        <p>We use only the best products to ensure safety and satisfaction at every step.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/checked.png" alt="Positive Results Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Positive Results</h3>
                        <p>Our treatments deliver noticeable, positive results that enhance your natural beauty.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/medal.png" alt="Diverse Treatments Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Diverse Treatments</h3>
                        <p>We offer a variety of treatments, from facials to body contouring, to suit your needs.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="feature-item text-center">
                        <div class="icon mb-3">
                            <img src="https://img.icons8.com/ios-filled/50/lifebuoy.png" alt="Ongoing Support Icon">
                        </div>
                        <h3 style="color: #8a7a5c;">Ongoing Support</h3>
                        <p>We offer continuous support to help you maintain your results and achieve lasting
                            satisfaction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Our Expert Doctors Section -->
    <!-- <section class="our-doctors-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #8a7a5c;">Schedule Your Online Consultion</h2>
            <div class="row justify-content-center">

                <!-- Doctor 1 -->
                <!-- <div class="col-md-4">
                    <div class="doctor-card text-center p-4 shadow-sm rounded" style="background-color: #fff;">
                        <img src="images/doctor1.jpg" alt="Dr. Sally Ramos" class="rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h3 class="doctor-name" style="color: #000000;">Dr. Sally Ramos</h3>
                        <p class="doctor-title" style="color: #555;">Dermatologist</p>
                        <p class="doctor-bio">Dr. Sally Ramos is a board-certified dermatologist with over 10 years of
                            experience in treating skin conditions and cosmetic dermatology.</p>
                        <div class="social-icons d-flex justify-content-center">
                            <a href="#" class="mx-2"><i class="fab fa-facebook-f" style="color: #8a7a5c;"></i></a>
                            <a href="#" class="mx-2"><i class="fab fa-twitter" style="color: #8a7a5c;"></i></a>
                            <a href="#" class="mx-2"><i class="fab fa-instagram" style="color: #8a7a5c;"></i></a>
                        </div>
                    </div>
                </div> -->

                <!-- Doctor 2 -->
                <!-- <div class="col-md-4">
                    <div class="doctor-card text-center p-4 shadow-sm rounded" style="background-color: #fff;">
                        <img src="images/doctor2.jpg" alt="Dr. John Doe" class="rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h3 class="doctor-name" style="color: #000000;">Dr. John Doe</h3>
                        <p class="doctor-title" style="color: #555;">Cosmetic Surgeon</p>
                        <p class="doctor-bio">Dr. John Doe is a leading cosmetic surgeon, specializing in facial and
                            body rejuvenation with over 15 years of experience.</p>
                        <div class="social-icons d-flex justify-content-center">
                            <a href="#" class="mx-2"><i class="fab fa-facebook-f" style="color: #8a7a5c;"></i></a>
                            <a href="#" class="mx-2"><i class="fab fa-twitter" style="color: #8a7a5c;"></i></a>
                            <a href="#" class="mx-2"><i class="fab fa-instagram" style="color: #8a7a5c;"></i></a>
                        </div>
                    </div>
                </div> -->

                <!-- Doctor 3 -->
                <!-- <div class="col-md-4">
                    <div class="doctor-card text-center p-4 shadow-sm rounded" style="background-color: #fff;">
                        <img src="images/doctor3.jpg" alt="Dr. Emma Watson" class="rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h3 class="doctor-name" style="color: #000000;">Dr. Emma Watson</h3>
                        <p class="doctor-title" style="color: #555;">Aesthetic Specialist</p>
                        <p class="doctor-bio">Dr. Emma Watson is a specialist in non-invasive aesthetic treatments,
                            known for delivering natural and glowing results.</p>
                        <div class="social-icons d-flex justify-content-center">
                            <a href="#" class="mx-2"><i class="fab fa-facebook-f" style="color: #8a7a5c;"></i></a>
                            <a href="#" class="mx-2"><i class="fab fa-linkedin-in" style="color: #8a7a5c;"></i></a>
                            <a href="#" class="mx-2"><i class="fab fa-instagram" style="color: #8a7a5c;"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> -->


    <br><br>

    <section class="contact-section">
        <div class="container">
            <h2 class="section-title" style="color: #8a7a5c;">Get in Touch</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <h5>Contact Information</h5>
                        <p><strong>Address:</strong><br>
                            Kaloor - Kathrikadavu Road,<br>
                            Near Arabian Nights,<br>
                            Kaloor, Cochin, Kerala 682017</p>
                        <p><strong>Phone:</strong> +91 9876543210</p>
                        <p><strong>Email:</strong> info@karthikaaesthetic.com</p>
                        <p><strong>Business Hours:</strong><br>
                            Mon - Sat: 10 AM - 7:30 PM<br>
                            Sun: 10 AM - 2:00 PM</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <iframe class="map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3932.592629866607!2d76.28748751516877!3d9.9828252928666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d3b3d1c1b9b%3A0x23e4c4e498c3b51!2sKaloor%20-%20Kathrikadavu%20Rd%2C%20Ernakulam%2C%20Kerala%20682017!5e0!3m2!1sen!2sin!4v1605459259821!5m2!1sen!2sin"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        </div>
    </section>
    <br><br>

    <div class="container text-center">
        <h1 style="color: #8a7a5c;">Customer Reviews</h1>
    </div>
    <br><br>
    <section class="reviews-section">
        <div class="container reviews-container">
            <div class="row justify-content-center">
                <!-- Review 1 -->
                <div class="col-md-4">
                    <div class="review-card">
                        <h3 class="reviewer-name">LÂVÃNÝÄ RÖŠÉ</h3>
                        <p class="review-date">26 weeks ago</p>
                        <div class="review-stars">
                            🌟🌟🌟🌟🌟
                        </div>
                        <p class="review-text">Thanks karthika's overall good service! I had an acne problem since 4
                            years. Now I can see so much changes on my face! Got confidence... And special thanks to
                            staff who are very friendly and caring. Must visit this clinic.</p>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="col-md-4">
                    <div class="review-card">
                        <h3 class="reviewer-name">Salaam Ebrahim</h3>
                        <p class="review-date">14 weeks ago</p>
                        <div class="review-stars">
                            🌟🌟🌟🌟🌟
                        </div>
                        <p class="review-text">I've had an amazing experience at Karthika's Aesthetic Center. The staff
                            treats you like family, making every visit comfortable and enjoyable. Their services are
                            top-notch, and the results speak for themselves. Highly recommend!</p>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="col-md-4">
                    <div class="review-card">
                        <h3 class="reviewer-name">aswathi padmakumar</h3>
                        <p class="review-date">2 months ago</p>
                        <div class="review-stars">
                            🌟🌟🌟🌟🌟
                        </div>
                        <p class="review-text">It was my first experience to visit in Karthika's center. I felt very
                            happy and satisfied. The staffs are very supporting and caring. Moreover, the consultant was
                            very supportive to describe all about my concerns without any hesitation. Thank you
                            Karthika's team for the service because I can increase my confidence. Once again thank you!
                            😊😊😊</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- profile container -->

    <div class="container-fluid py-5">
        <!-- Our Leadership Section -->
        <section class="our-leadership py-0 bg-light">
            <div class="container">
                <h2 class="text-center mb-5" style="color: #8a7a5c;">Our Leadership</h2>
                <div class="row profile-card-karthika align-items-center justify-content-center">
                    <div class="col-md-4 d-flex justify-content-end align-items-center">
                        <img src="images/karthikadummmy.png" alt="Karthika Nair" class="profile-image">
                    </div>
                    <div class="col-md-8 profile-text">
                        <h1>Karthika Nair</h1>
                        <p style="color: rgb(112, 104, 82);">MBBS, MRCP(UK), CCST(DERM)</p>
                        <p>
                            Karthika Nair, Director of Karthika's Aesthetic Center and a Cosmetic Laser Technician, is
                            an
                            industry veteran with over 17 years of experience in beauty and skincare. Combining her
                            medical
                            knowledge with beauty expertise, she delivers remarkable results in facial and body
                            rejuvenation
                            procedures.
                        </p> <button class="btn-learn-more" style="width: 130px; color: black;"
                            onclick="location.href='karthika-details.html'">
                            <div class="text">
                                <span>Read</span>
                                <span>More</span>
                            </div>
                            <div class="clone">
                                <span>Read</span>
                                <span>More</span>
                            </div>
                        </button>

                    </div>
                </div>
            </div>
        </section>



        <section class="consultation-section">
    <div class="consultation-container">
        <div class="consultation-text">
            <h2>Book a Consultation</h2>
            <p>Discuss your individual concerns, get advice about different treatment options and have a bespoke
                <span class="highlight">treatment programme</span> designed for you.
            </p>
        </div>
        <div class="consultation-form">
            <h3 style="color: #b6a380;">Request a booking</h3>

            <!-- Form Starts -->
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="first_name" placeholder="First Name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>">
                    <input type="text" name="second_name" placeholder="Second Name" value="<?php echo isset($_POST['second_name']) ? $_POST['second_name'] : ''; ?>">
                </div>
                <div class="form-group">
                    <input type="tel" name="telephone" placeholder="Telephone" value="<?php echo isset($_POST['telephone']) ? $_POST['telephone'] : ''; ?>">
                    <input type="email" name="email" placeholder="Email Address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                </div>
                <div class="form-group_text">
                    <textarea name="message" placeholder="Message"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="consent" name="consent" <?php if (isset($_POST['consent'])) echo 'checked'; ?>>
                    <label for="consent" style="color: #b6a380;">By checking this box, you agree to be contacted
                        via phone and email regarding your interest in our products and services.</label>
                </div>

                <!-- Display Error or Success Messages -->
                <?php if (!empty($success_message)): ?>
                    <p style="color: green;"><?php echo $success_message; ?></p>
                <?php elseif (!empty($error_message)): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <button class="btn-learn-more" type="submit" style="width: 110px; color: #8a7a5c;">
                    <div class="text">
                        <span>SUBMIT</span>
                    </div>
                    <div class="clone">
                        <span>SUBMIT</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</section>



        <!-- Google Reviews Section -->
        <!-- <section class="reviews-section bg-light py-5">
            <div class="container"> -->

        <!-- Google Reviews Widget -->
        <!-- <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="elfsight-app-40c1b5b0-31f4-4bd5-9679-742cda6f9a2d" data-elfsight-app-lazy></div>
                    </div>
                </div>
            </div>
        </section> -->




        <!-- Footer Section -->
        <!-- Footer Section -->
<footer class="bg-white">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-4 mb-3 mb-lg-0 text-center text-lg-start">
                <!-- Adding the logo here -->
                <img src="logo/kathikaastheticcenter.png" alt="Karthika Aesthetic Centre Logo" class=" mb-2" style="max-width: 200px;">
                
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-flex justify-content-center">
                    <a href="https://www.facebook.com/beautyparlourcochin/" class="mx-2">
                        <i class="fab fa-facebook-f fa-2x" style="color: #8a7a5c;"></i> 
                    </a>
                    <a href="https://www.instagram.com/karthikasaestheticcentre/?hl=en" class="mx-2">
                        <i class="fab fa-instagram fa-2x" style="color: #8a7a5c;"></i>
                    </a>
                    <a href="https://www.youtube.com/@karthikasprofessionalbeaut4228" class="mx-2">
                        <i class="fab fa-youtube fa-2x" style="color: #8a7a5c;"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0">
                <nav class="nav justify-content-around">
                    <a class="nav-link px-2" href="About Us.html">About</a>
                    <a class="nav-link px-2" href="Treatments.html">Treatments</a>
                    <a class="nav-link px-2" href="Career.html">Careers</a>
                    <a class="nav-link px-2" href="Contact Us.html">Contact us</a>
                    <a class="nav-link px-2" href="Appointment.php">Appointment</a>
                </nav>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 text-center add_div_footer">
                <h4 class="text-muted">Karthika Aesthetic Centre</h4>
                <p class="mb-0">
                    Kaloor - Kathrikadavu Road<br>
                    Near Arabian Nights<br>
                    Kaloor, Cochin, Kerala<br>
                    682017
                </p>
            </div>
        </div>
        <div class="row border-top pt-3">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0">&copy; 2024 Karthika Aesthetic. All rights reserved. All trademarks acknowledged.</p>
            </div>
            <div class="col-md-6 text-center text-md-end  cond_div_footer">
                <a href="#" class="me-3  text-muted">Privacy Policy</a>
                <a href="#" class=" text-muted">Terms and Conditions</a>
            </div>  
        </div>
    </div>
</footer>
<!-- Footer Section -->


        <!-- Footer Section -->


        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Font Awesome for social icons -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

        <script src="https://static.elfsight.com/platform/platform.js" async></script>


        <!-- navbar scroll animation -->
        <script>
            let lastScrollTop = 0;
            const navbar = document.querySelector('.navbar');

            // Listen for scroll events
            window.addEventListener('scroll', function () {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > lastScrollTop) {
                    // User is scrolling down, collapse the navbar
                    if (!navbar.classList.contains('navbar-collapse-hide')) {
                        navbar.classList.add('navbar-collapse-hide');
                        navbar.classList.remove('show');
                    }
                } else {
                    // User is scrolling up, expand the navbar
                    if (navbar.classList.contains('navbar-collapse-hide')) {
                        navbar.classList.remove('navbar-collapse-hide');
                        navbar.classList.add('show');
                    }
                }

                // Update the last scroll position
                lastScrollTop = scrollTop;
            });

        </script>

        

</body>

</html>