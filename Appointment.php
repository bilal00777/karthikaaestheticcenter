<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment - Karthika's Aesthetic Centre</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <!-- style csss-->
    <link rel="stylesheet" href="appoinment.css">

    <!-- common css -->
     <link rel="stylesheet" href="commonstyle.css">
   <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f8f8f8;
        }

        .navbar-brand {
            font-size: 2rem;
            /* Adjust size as needed */
        }

        .navbar-brand .karthika {
            font-family: 'Georgia', serif;
            font-weight: bold;
            color: #8a7a5c;
            /* Gold color */
            /* Light background highlight */
            padding: 5px 10px;
            border-radius: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
        }

        .navbar-brand .aesthetic-centre {
            font-weight: 300;
            /* Slim font weight */
            color: black;
            font-weight: 1px;
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


        .section-title {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #333;
            text-align: center;
        }

        .appointment-section {
            padding: 80px 0;
            background-color: #fff;
        }

        .form-control {
            background-color: #f1f1f1;
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
                        <a class="nav-link px-3 active" href="Appointment.php">Appointment</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Appointment Section -->
    <section class="appointment-section">
    <div class="container">
        <h2 class="section-title">Book an Appointment</h2>
        <p class="text-center mb-5">Please fill out the form below to book an appointment with us. Select the
            treatment you are interested in, and we will get back to you to confirm your appointment.</p>

        <!-- Display success or error messages -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <p style="color: green;"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
        <?php endif; ?>

        <form action="process_appointment.php" method="post" class="mt-5">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Full Name" name="full_name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required>
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="appointment_date" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="treatment" class="form-label">Select Treatment</label>
                <select class="form-select" id="treatment" name="treatment" required>
                    <option selected disabled>Choose a Treatment</option>
                    <option value="hydrafacial">HydraFacial</option>
                    <option value="microneedling">Microneedling</option>
                    <option value="chemical_peeling">Chemical Peeling</option>
                    <option value="dermabrasion_facial">Dermabrasion Facial</option>
                    <option value="hair_treatments">Hair Treatments (PRP, GFC, Meso Therapy)</option>
                    <option value="laser_hair_reduction">Laser Hair Reduction</option>
                    <option value="medi_facial">Medi-Facial</option>
                    <option value="carbon_laser_facial">Carbon Laser Facial</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea name="message" rows="4" class="form-control"
                    placeholder="Additional Notes (Optional)"></textarea>
            </div>

            <button class="btn-learn-more" type="submit" style="color: #8a7a5c;width:300px;">
                <div class="text">
                    <span>Submit</span>
                    <span>Appointment</span>
                    <span>Request</span>
                </div>
                <div class="clone">
                    <span>Submit</span>
                    <span>Appointment</span>
                    <span>Request</span>
                </div>
            </button>
        </form>
    </div>
</section>

    <section class="contact-section">
        <h2>Get In Touch</h2>
        <p>For any queries and information, feel free to contact us</p>

        <div class="contact-cards">
            <div class="card">
                <img src="https://img.icons8.com/material-rounded/50/8A7A5C/phone.png" alt="Call Us">
                <p>Call Us</p>
            </div>

            <div class="card">
                <img src="https://img.icons8.com/material-rounded/50/8A7A5C/whatsapp.png" alt="WhatsApp">
                <p>WhatsApp</p>
            </div>

            <div class="card">
                <img src="https://img.icons8.com/material-rounded/50/8A7A5C/online-support.png" alt="Chat With Us">
                <p>Chat With Us</p>
            </div>

            <div class="card">
                <img src="https://img.icons8.com/material-rounded/50/8A7A5C/marker.png" alt="Get Directions">
                <p>Get Directions</p>
            </div>
        </div>

        <div class="timing">
            <p>Timing: Monday to Saturday: 10:00 AM - 7:00 PM | Sunday: 10 AM - 1.30 PM</p>
        </div>
    </section>

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
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- external script -->

    <script src="script.js"></script>


</body>

</html>