<?php
session_start();
include('connection.php');

$displayModal = isset($_SESSION['msg']);

if (isset($_SESSION['id'])) {
    header('location:index.php');
}

$schedule = mysqli_query($conn, "SELECT * FROM schedule");
$row = mysqli_fetch_assoc($schedule);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/indexstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Josefin+Sans" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/annstyle.css" />
    <style>
        /* CSS for the loading spinner */
        .loading-spinner1 {
            display: none;
            /* Initially hidden */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F8F9FA;
            /* Semi-transparent white background */
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner1 .spinner1 {
            width: 100px;
            height: 100px;
            border: 10px solid #4169E1;
            /* Blue color */
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        .btn3:disabled {
        background-color: #d3d3d3; /* Light gray background */
        color: #808080; /* Gray text */
        cursor: not-allowed; /* Change cursor to indicate the button is disabled */
    }
    </style>

</head>

<body>
    <div class="loading-spinner1" id="loadingSpinner1">
        <div class="spinner1"></div>
    </div>
    <nav class="head navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: Josefin Sans; margin-top: 15px; font-size: 25px;"><b>ARTLENS</b></h1>
            <div id="logoutButtonContainer" style="display: none;"></div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="first-page d-flex justify-content-center align-items-center">
        <div class="container con1">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center imgrizaldiv">
                    <img src="assets/images/lgs.png" class="img-fluid imgrizal" alt="Rizal Image" style="position: relative; z-index: 1;">
                </div>
                <div class="col-md-6 order-md-1" style="position: relative; z-index: 2;">
                    <h1 style="color: #4169E1;"><b>Rizal Shrine</b></h1>
                    <p style="color: grey;">The Rizal Shrine in Calamba (Filipino: Museo ni José Rizal Calamba) is a reproduction of the original two-story, Spanish-colonial style house in Calamba, Laguna where José Rizal was born on June 19, 1861. The house is designated as a National Shrine (Level 1) by the National Historical Commission of the Philippines.</p>
                    <div class="container mb-4 mt-5">
                        <div class="vertical-line"></div>
                        <div class="row">
                            <div class="col-lg-4" style="display: flex; align-items: start ;justify-content: start; margin-left: 0;">
                                <h3><?php echo $row['museum_status'] ?></h3>
                            </div>
                            <div class="col-lg-5" style="display: flex;align-items: center;justify-content: start; position: absolut; margin-top: -7px; margin-left: 0;">
                                <p><?php echo $row['description'] ?><br><?php echo date("h:i A", strtotime($row['start_time'])) ?> to <?php echo date("h:i A", strtotime($row['end_time'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <a href="visitorindex.php" class="cssbuttons-io-button" style="position: relative; z-index: 3; text-decoration: none; width: 45%; min-width: 260px; max-width: 260px;">
                        Explore the Museum
                        <div class="icon">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalconfirm" tabindex="-1" aria-labelledby="modalconfirmLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalconfirmLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-continue">Continue</button>
            </div>
        </div>
    </div>
</div>

<!-- Log out button container -->
<div id="logoutButtonContainer" style="display: none;"></div>

    <br><br><br><br><br>

    <div class="container text-center">
        <div class="title">
            <h1>Announcements</h1>
        </div>
        <div class="description">
            <p>Stay tuned for updates, behind-the-scenes peeks, and exclusive events surrounding this exciting announcement. We can't wait to share this journey with you!</p>
        </div>
        <?php
        // Display submissions
        $sql = "SELECT image_path, title, description FROM submissions ORDER BY id DESC";
        $result = $conn->query($sql);

        $cards = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cards .= '<div class="card swiper-slide">
                                    <div class="img-box" style="height: 350px;">
                                        <img src="' . $row["image_path"] . '" alt="" class="image" />
                                        <div class="overlay" style="margin-bottom: -10px;">
                                            <div class="text"><h2>' . $row["title"] . '</h2>
                                                <p>' . $row["description"] . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
        } else {
            // Display "No updates today" if there are no submissions
            $cards = '<div class="card swiper-slide">
                                <div class="img-box" style="height: 350px; border: 1px solid #4169E1;">
                                    <div class="text-center" style="margin:10px;">
                                        <h2 style="margin-top: 20px;">No updates today</h2>
                                        <p>There are no announcements at this time. Please check back later for updates.</p>
                                        <center>
                                            <img src="assets/images/void.png" style="max-width: 60%; max-height: 60%; height: auto; width: auto;">
                                        </center>
                                    </div>
                                </div>
                            </div>';
        }
        ?>
        <div class="container1 swiper">
            <div class="slide-container">
                <div class="card-wrapper swiper-wrapper">
                    <?php echo $cards; ?>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <br><br><br><br><br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="assets/images/lp.png" class="img-fluid" alt="Your Image">
            </div>
            <div class="col-md-6 order-md-1">
                <h2>🎟️ Plan Your Visit to the Rizal Shrine</h2>
                <p>Excited to explore the life and legacy of Dr. Jose Rizal? Plan your visit to the Rizal Shrine today! Whether you're a solo traveler, a family seeking cultural enrichment, or a group interested in our guided tours, booking your visit is a breeze. Simply fill up the booking form to secure your preferred date and time slot. With our seamless booking process, you can look forward to an immersive experience delving into the life and ideals of our national hero. Join us at the Rizal Shrine and embark on a journey through history, enlightenment, and inspiration.</p>
                <button class="btn kulay mt-1" onclick="document.getElementById('myModal1').style.display='flex'">Book Visitation</button>&emsp;
                <div id="myModal1" class="modal1">
                    <div class="modal-content1">
                        <span class="close2 float-end mb-3" onclick="document.getElementById('myModal1').style.display='none'">&times;</span>
                        <h3 id="modalTitle" class="mt-2">Booking Form</h3>
                        <hr>

                        <div id="toggleButtons" class="d-flex justify-content-center mb-3">
                            <a type="button" class="btn-toggle form" onclick="showForm()">Form</a>
                            <a type="button" class="btn-toggle status" onclick="showStatus()">Status</a>
                        </div>

                        <!-- Booking Form -->
                        <div id="formContent">
                            <div id="alertMessage" class="alert alert-primary d-none" role="alert">
                                Form submitted successfully!
                                <button type="button" class="btn-close float-end" aria-label="Close" onclick="dismissAlert()"></button>
                            </div>
                            <form id="bookingForm" name="bookingForm" action="booking.php" method="POST" onsubmit="handleSubmit(event)">
    <div class="form-floating mb-3">
        <input class="form-control" id="onam" name="onam" type="text" placeholder="Organization Name" required maxlength="50">
        <label>Organization Name</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" id="emal" name="emal" type="email" placeholder="Email" required maxlength="50" oninput="checkEmail()">
        <label>Email</label>
        <div id="emailStatus" class="invalid-feedback"></div> <!-- Error message container -->
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" id="monu" name="monu" type="tel" placeholder="Mobile Number" required title="Please enter an 11-digit mobile number." maxlength="13">
        <label>Mobile Number</label>
        <div id="mobileStatus" class="invalid-feedback"></div> <!-- Error message container -->
    </div>
    <div class="row">
        <label class="form-label d-block">Number by Sex</label>
        <div class="col">
            <div class="form-floating mb-3">
                <input class="form-control" id="numa" name="numa" type="number" placeholder="Number of Males" required min="0" max="50" oninput="this.value = this.value.slice(0, 2)">
                <label>Male</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input class="form-control" id="nufe" name="nufe" type="number" placeholder="Number of Females" required min="0" max="50" oninput="this.value = this.value.slice(0, 2)">
                <label>Female</label>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" id="dati" name="dati" type="datetime-local" placeholder="Date and Time" required>
        <label>Date and Time</label>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <button type="submit" name="submit" class="btn3 mt-3" id="bookButton" style="width: 100%;" disabled>
            <span id="submitText">Book</span>
            <span id="loadingSpinner" class="visually-hidden">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </span>
        </button>
    </div>
</form>
                    </div>
                    <script>
   document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('bookingForm');
    const submitButton = document.getElementById('bookButton');
    const emailInput = document.getElementById('emal');
    const mobileInput = document.getElementById('monu');
    const emailStatus = document.getElementById('emailStatus');
    const mobileStatus = document.getElementById('mobileStatus');
    const inputs = form.querySelectorAll('input[required]');

    function checkFormValidity() {
        let allFilled = true;
        inputs.forEach(input => {
            if (!input.value) {
                allFilled = false;
            }
        });

        // Validate email
        const emailValue = emailInput.value.trim().toLowerCase();
        if (emailInput.classList.contains('touched') && !isValidEmail(emailValue)) {
            allFilled = false;
            emailInput.classList.add('is-invalid'); // Add red border for invalid input
            emailStatus.textContent = "Please enter a valid email."; // Error message
        } else {
            emailInput.classList.remove('is-invalid');
            emailStatus.textContent = ""; // Clear error message if valid
        }

        // Validate mobile number
        const mobileValue = mobileInput.value.trim();
        if (mobileInput.classList.contains('touched') && !isValidMobile(mobileValue)) {
            allFilled = false;
            mobileInput.classList.add('is-invalid'); // Add red border for invalid input
            mobileStatus.textContent = "Please enter a valid mobile number."; // Error message
        } else {
            mobileInput.classList.remove('is-invalid');
            mobileStatus.textContent = ""; // Clear error message if valid
        }

        submitButton.disabled = !allFilled;
    }

    function isValidEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const invalidSuffix = /\.c0m$/i; // Invalid suffix check
        return pattern.test(email) && !invalidSuffix.test(email);
    }

    function isValidMobile(mobile) {
        const pattern1 = /^(09|\+639)\d{9}$/; // 09XXXXXXXXX or +639XXXXXXXXX
        const pattern2 = /^(09|\+639)\d{11}$/; // +639XXXXXXXXXX
        return pattern1.test(mobile) || pattern2.test(mobile);
    }

    emailInput.addEventListener('input', function() {
        emailInput.classList.add('touched'); // Mark as touched on input
        checkFormValidity();
    });

    mobileInput.addEventListener('input', function() {
        mobileInput.classList.add('touched'); // Mark as touched on input
        checkFormValidity();
    });

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            checkFormValidity();
        });
    });

    form.addEventListener('submit', function() {
        emailInput.classList.add('touched');
        mobileInput.classList.add('touched');
        checkFormValidity();
    });

    checkFormValidity(); // Initial check
});
</script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const input = document.getElementById('dati');
                            const now = new Date().toISOString().slice(0, 16); // Get current date and time in the format YYYY-MM-DDTHH:mm
                            input.setAttribute('min', now);
                        });
                    </script>
                        <!-- Status Content -->
                        <div id="statusContent" class="hidden" style="max-height: 400px; overflow-y: auto;">
                            <form id="statusForm" action="#" method="POST">
                                <input class="form-control" name="contact_email" type="text" placeholder="Search by Email" required>
                                <div id="imageContainer" style="margin-top: 10px; background-color: #FFFFFF; border-radius: 10px;">
                                    <!-- Add image with default message -->
                                    <center><img src="assets/images/status.png" alt="No information" id="noInfoImage"></center>
                                    <!-- Container for displaying message -->
                                    <div id="statusMessage" class="mt-3" style="margin: 10px; color: white;"></div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="button" onclick="checkStatus()" class="btn3" style="width: 100%;">Search Status</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button class="btn kulay mt-1" onclick="document.getElementById('myModal2').style.display='flex'">Visit the Museum</button>
                <!--Log Form-->
                <div id="myModal2" class="modal2" tabindex="-1">
                    <div class="modal-content2 p-4">
                        <span class="close3 float-end mb-3" onclick="document.getElementById('myModal2').style.display='none'">&times;</span>
                        <h3 class="mt-2">Log Form</h3>
                        <hr>
                        <form id="logForm" action="log.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="mb-4">
                            <label for="modal-status" class="form-label">Type</label>
                            <select id="modal-status" class="form-select" name="status" onchange="toggleFields()">
                                <option value="Individual">Individual</option>
                                <option value="Organization">Organization</option>
                            </select>
                        </div>

                        <!-- Organization Fields -->
                        <div class="organization">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="busno" name="busno" type="text" placeholder="C.N. Bus No." maxlength="50" required onblur="validateField(this)">
                                <label for="busno">C.N. Bus No.</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="names" name="names" type="text" placeholder="Name" maxlength="50" required onblur="validateField(this)">
                                <label for="names">Name</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="address" name="address" type="text" placeholder="Address" maxlength="50" required onblur="validateField(this)">
                                <label for="address">Address</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nationality" name="nationality" type="text" placeholder="Nationality" maxlength="50" required onblur="validateField(this)">
                                <label for="nationality">Nationality</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="row mb-3">
                            <label class="form-label d-block mt-2">Number by Sex</label>
                                <div class="col">
                                    <div class="form-floating">
                                        <input class="form-control" id="numma" name="numma" type="number" placeholder="Number of Male" min="0" max="50" required onblur="validateField(this)">
                                        <label for="numma">Male</label>
                                        <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input class="form-control" id="numfe" name="numfe" type="number" placeholder="Number of Female" min="0" max="50" required onblur="validateField(this)">
                                        <label for="numfe">Female</label>
                                        <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">Number of Students</p>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="gs" name="gs" type="number" placeholder="Grade School" min="0" max="50" required onblur="validateField(this)">
                                <label for="gs">Grade School</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="hs" name="hs" type="number" placeholder="High School" min="0" max="50" required onblur="validateField(this)">
                                <label for="hs">High School</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="cls" name="cls" type="number" placeholder="College/Grad School" min="0" max="50" required onblur="validateField(this)">
                                <label for="cls">College/Grad School</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <p class="mt-3">PWD</p>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="pwd" name="pwd" type="number" placeholder="PWD" min="0" max="50" required onblur="validateField(this)">
                                <label for="pwd">PWD</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <p class="mt-3">Number of Guests Based on Age Bracket</p>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="17below" name="17below" type="number" placeholder="17 years old below" min="0" max="50" required onblur="validateField(this)">
                                <label for="17below">17 years old below</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="1930below" name="1930below" type="number" placeholder="19-30 years old" min="0" max="50" required onblur="validateField(this)">
                                <label for="1930below">19-30 years old</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="3159below" name="3159below" type="number" placeholder="31-59 years old" min="0" max="50" required onblur="validateField(this)">
                                <label for="3159below">31-59 years old</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="60above" name="60above" type="number" placeholder="60 years old above" min="0" max="50" required onblur="validateField(this)">
                                <label for="60above">60 years old above</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                        </div>

                        <!-- Individual Fields -->
                        <div class="individual" style="display: none;">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="fn" name="fn" type="text" placeholder="First Name" maxlength="50" onblur="validateField(this)">
                                <label for="fn">First Name</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ln" name="ln" type="text" placeholder="Last Name" maxlength="50" onblur="validateField(this)">
                                <label for="ln">Last Name</label>
                                <small class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="mo" name="mo" type="text" placeholder="MI(Optional)" maxlength="1">
                                <label for="mo">MI(Optional)</label>
                        
                            </div>
                            <script>
                                // Function to validate that only letters are entered
                                function validateAlphabet(input) {
                                    var field = input.value.trim();

                                    // Regular expression to match only letters
                                    var alphabetPattern = /^[a-zA-Z]$/;

                                    // Check if the input is empty or doesn't match the letter pattern
                                    if (field !== '' && !alphabetPattern.test(field)) {
                                        input.value = '';
                                    }
                                }

                                // Attach event listener to validateAlphabet function on input event
                                document.getElementById('mo').addEventListener('input', function() {
                                    validateAlphabet(this);
                                });
                            </script>
                            <div class="mb-3">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="male" name="gen" value="Male" onblur="validateField(this)">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gen" value="Female" onblur="validateField(this)">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email1" type="email" placeholder="Email" maxlength="50" onblur="validateEmail('email')" oninput="clearError('email')">
                                <label for="email">Email</label>
                                <small id="emailError" class="text-danger" style="display: none;">This field cannot be blank.</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="mobile1" name="monu1" type="text" placeholder="Mobile Number" maxlength="13" onblur="validateFieldNum(this)">
                                <label for="mobile">Mobile Number</label>
                                <small id="mobile-error" class="text-danger" style="display: none;">Please enter a valid ph mobile number starting with +63 or 09.</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" name="submit" class="btn btn3 w-100 mt-3">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="assets/images/artmu.png" class="img-fluid" alt="Placeholder Image" style="width: 600px;">
            </div>
            <div class="col-md-6 order-md-1">
                <h3>Art Discovery with Our Innovative Recognition System</h3>
                <p>Experience art in a whole new way at the Rizal Shrine with our cutting-edge art recognition system. Using advanced technology, our system allows visitors to interact with artworks in a dynamic and engaging manner. Simply point your smartphone or tablet at a piece of art, and watch as detailed information, artist biographies, and historical context come to life before your eyes. Dive deeper into the stories behind each masterpiece and gain a deeper appreciation for the artistic contributions that honor Dr. Jose Rizal's legacy. Explore our galleries with a fresh perspective and uncover hidden treasures waiting to be discovered through our innovative art recognition system.</p>
                <a type="button" href="visitorartrecog.php" class="btn kulay">Try our Image Recognition</a>
            </div>
        </div>
    </div>

    <br><br><br><br><br>
    <footer class="footer" style="background-color: #F8F9FA;">
        <div class="container mb-3" style="color: var(--bs-secondary-color);">
            <div class="row">
                <div class="col-md mt-3">
                    <p><b>Museo ni Jose Rizal, Calamba, Laguna</b></p>
                    <center>
                        <hr style="width: 300px; border:1px solid #4169E1; color: #4169E1;">
                    </center>
                    <p class="tetleft"><a href="https://www.google.com/maps/search/?api=1&query=J.+P.+Rizal+St.,+Cor.+F.+Mercado+St.,+Brgy.+6+Poblacion,+Calamba,+Philippines" class="clickft"><i class="bi bi-geo-alt-fill"></i>&emsp;J. P. Rizal St., Cor. F. Mercado St., Brgy. 6 <span style="margin-left: 30px;">Poblacion, Calamba, Philippines</span></a></p>
                </div>
                <div class="col-md mt-3">
                    <p><b>Quick Links</b></p>
                    <center>
                        <hr style="width: 300px; border:1px solid #4169E1; color: #4169E1;">
                    </center>
                    <a type="button" href="aboutus.php" class="tetleft clickft">About us</a>
                    <br>
                    <a type="button" href="faqs.php" class="tetleft clickft">Frequently asked Questions</a>
                </div>
                <div class="col-md mt-3">
                    <p><b>Contact Us:</b></p>
                    <center>
                        <hr style="width: 300px; border:1px solid #4169E1; color: #4169E1;">
                    </center>
                    <p class="tetleft"><a href="https://www.facebook.com/museonijoserizalcalamba" class="clickft"><i class="bi bi-facebook"></i>&emsp;NHCP - Museo ni Jose Rizal, Calamba</a></p>
                    <p class="tetleft"><a href="mailto:mjrc@nhcp.gov.ph" class="clickft"><i class="bi bi-envelope-at-fill"></i>&emsp;mjrc@nhcp.gov.ph</a></p>
                    <p class="tetleft"><a href="tel:+63498341599" class="clickft"><i class="bi bi-telephone-fill"></i>&emsp;(049) 834 1599</a></p>
                </div>
            </div>
        </div>
    </footer>


    <!-- JavaScript Libraries -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your Custom Scripts -->
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/input-validator.js"></script>
<script src="assets/js/carscript.js"></script>
<script src="assets/js/bookvalidation.js"></script>
<script src="assets/js/logformvalidation.js"></script>


    <script>
    function showConfirmationModal() {
        var modal = new bootstrap.Modal(document.getElementById('modalconfirm'));
        modal.show();

   
        document.querySelector('.btn-continue').addEventListener('click', function() {
      
            localStorage.removeItem('loggedInDevice');
       
            document.getElementById('logoutButtonContainer').style.display = 'none';
    
            modal.hide();
        });

  
        document.querySelector('.btn-cancel').addEventListener('click', function() {
            modal.hide();
        });
    }

 
    function checkLoggedIn() {

        var isLoggedIn = localStorage.getItem('loggedInDevice');

        if (isLoggedIn) {
    
            var logoutButton = '<a class="float-end btn1 adminlogbtn" style="text-decoration: none;" onclick="showConfirmationModal()">Log out</a>';
            document.getElementById('logoutButtonContainer').innerHTML = logoutButton;
            document.getElementById('logoutButtonContainer').style.display = 'block';
        } else {
       
            document.getElementById('logoutButtonContainer').style.display = 'none';
        }
    }


    window.onload = function() {
        checkLoggedIn();
    };

  
    function validateForm() {

        var isValid = true;

        if (isValid) {

            localStorage.setItem('loggedInDevice', true);

            checkLoggedIn();
        }

        return isValid; 
    }
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('loadingSpinner1').style.display = 'flex';

            setTimeout(function() {
                document.getElementById('loadingSpinner1').style.display = 'none';
            }, 1500); // 3000 milliseconds = 3 seconds
        });
    </script>
<script>
$(document).ready(function() {
    $('.img-box').click(function() {
        var overlay = $(this).find('.overlay');
   
        if (overlay.hasClass('active')) {
            overlay.removeClass('active');
        } else {
   
            overlay.addClass('active');
            $('.overlay').not(overlay).removeClass('active');
        }
    });

    $('.overlay').click(function(event) {
        event.stopPropagation(); 
        $(this).removeClass('active'); 
    });

    $(document).click(function(event) {
        if (!$(event.target).closest('.img-box').length && !$(event.target).hasClass('overlay')) {
            $('.overlay').removeClass('active');
        }
    });
});
</script>

</body>

</html>