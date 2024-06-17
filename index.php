<?php
session_start();
include ('connection.php');

$displayModal = isset($_SESSION['msg']);

if(isset($_SESSION['id'])){
    header('location:index.php');
}
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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/annstyle.css" />
</head>
<body>
    <nav class="head navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>ArtLens</b></h1>
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
                                <h3>Now Open</h3>
                            </div>
                            <div class="col-lg-5" style="display: flex;align-items: center;justify-content: start; position: absolut; margin-top: -7px; margin-left: 0;">  
                                <p>Open Tuesday - Sunday<br> 9:00 AM to 4:00 PM</p>
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
                                        <div class="overlay">
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
                            <a type="button" class="btn-toggle status" 
                            onclick="showStatus()">Status</a>
                        </div>

                        <!-- Booking Form -->
                        <div id="formContent">
                            <div id="alertMessage" class="alert alert-primary d-none" role="alert">
                                Form submitted successfully!
                                <button type="button" class="btn-close float-end" aria-label="Close" onclick="dismissAlert()"></button>
                            </div>
                            <form id="bookingForm" name="bookingForm" action="booking.php" method="POST" onsubmit="handleSubmit(event)">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="onam" type="text" placeholder="Organization Name" required maxlength="50">
                                    <label>Organization Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="emal" name="emal" type="email" placeholder="Email" required maxlength="50" oninput="checkEmail()">
                                    <label>Email</label>
                                    <div id="emailStatus"></div> <!-- Display email status here -->
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="monu" type="tel" placeholder="Mobile Number" required pattern="[0-9]{11}" title="Please enter an 11-digit mobile number." maxlength="11">
                                    <label>Mobile Number</label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="numa" type="number" placeholder="Number of Males" required min="0" max="50">
                                            <label>Number of Males</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nufe" type="number" placeholder="Number of Females" required min="0" max="50">
                                            <label>Number of Females</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="dati" type="datetime-local" placeholder="Date and Time" required>
                                    <label>Date and Time</label>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" name="submit" class="btn3 mt-3" style="width: 100%;">
                                        <span id="submitText">Book</span>
                                        <span id="loadingSpinner" class="visually-hidden">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>


                        <!-- Status Content -->
                        <div id="statusContent" class="hidden">
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
                <div id="myModal2" class="modal2">
                    <div class="modal-content2 p-4">
                        <span class="close3 float-end mb-3" onclick="document.getElementById('myModal2').style.display='none'">&times;</span>
                        <h3 class="mt-2">Log Form</h3>
                        <hr>
                        <form id="logForm" action="log.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="modal-status" class="form-label">Type</label>
                                <select id="modal-status" class="form-select" name="status" onchange="toggleFields()" required>
                                    <option value="Individual">Individual</option>
                                    <option value="Organization">Organization</option>
                                </select>
                            </div>

                            <!-- Fields for Organization -->
                            <div id="organizationFields" class="organization">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="busno" name="busno" type="text" placeholder="C.N. Bus No." required>
                                    <label for="busno">C.N. Bus No.</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="names" name="names" type="text" placeholder="Name" required>
                                    <label for="names">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="address" name="address" type="text" placeholder="Address" required>
                                    <label for="address">Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="nationality" name="nationality" type="text" placeholder="Nationality" required>
                                    <label for="nationality">Nationality</label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="numma" type="number" placeholder="Number of Males" required min="0" max="50">
                                            <label>Number of Males</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="numfe" type="number" placeholder="Number of Females" required min="0" max="50">
                                            <label>Number of Females</label>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3">Number of Students</p>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="gs" type="number" placeholder="Grade School" required>
                                    <label for="gs">Grade School</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="hs" type="number" placeholder="High School" required>
                                    <label for="hs">High School</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="cls" type="number" placeholder="College/Grad School" required>
                                    <label for="cls">College/Grad School</label>
                                </div>
                                <p style="margin-top: 35px;">Number of PWD</p>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="pwd" type="number" placeholder="PWD" required>
                                    <label for="pwd">PWD</label>
                                </div>
                                <p style="margin-top: 35px;">Number of Guests Based on Age Bracket</p>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="17below" type="number" placeholder="17 years old below" required>
                                    <label for="17below">17 years old below</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="1930below" type="number" placeholder="19-30 years old" required>
                                    <label for="1930below">19-30 years old</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="3159below" type="number" placeholder="31-59 years old" required>
                                    <label for="3159below">31-59 years old</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="60above" type="number" placeholder="60 years old above" required>
                                    <label for="60above">60 years old above</label>
                                </div>
                            </div>

                            <!-- Fields for Individual -->
                            <div id="individualFields" class="individual hidden">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="fn" name="fn" type="text" placeholder="First Name" required>
                                    <label for="fn">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="ln" name="ln" type="text" placeholder="Last Name" required>
                                    <label for="ln">Last Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="mo" name="mo" type="text" placeholder="MI(Optional)">
                                    <label for="mo">MI(Optional)</label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="male" name="gen" value="Male" required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="female" name="gen" value="Female" required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" name="email1" type="email" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="mobile" name="monu1" type="number" placeholder="Mobile Number" required>
                                    <label for="mobile">Mobile Number</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" name="submit" class="btn btn3 w-100 mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div> <!--End Log Form-->
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="assets/images/rloob.png" class="img-fluid" alt="Placeholder Image" style="width: 600px;">
            </div>
            <div class="col-md-6 order-md-1">
                <h3>Art Discovery with Our Innovative Recognition System</h3>
                <p>Experience art in a whole new way at the Rizal Shrine with our cutting-edge art recognition system. Using advanced technology, our system allows visitors to interact with artworks in a dynamic and engaging manner. Simply point your smartphone or tablet at a piece of art, and watch as detailed information, artist biographies, and historical context come to life before your eyes. Dive deeper into the stories behind each masterpiece and gain a deeper appreciation for the artistic contributions that honor Dr. Jose Rizal's legacy. Explore our galleries with a fresh perspective and uncover hidden treasures waiting to be discovered through our innovative art recognition system.</p>
                <button class="btn kulay">Try our Image Recognition</button>
            </div>
        </div>
    </div>
    
    <br><br><br><br><br>
    <footer class="footer" style="background-color: #F8F9FA;">
    <div class="container mb-3"  style="color: var(--bs-secondary-color);">
        <div class="row">
            <div class="col-md mt-3">
                <p><b>Museo ni Jose Rizal, Calamba, Laguna</b></p>
                <center><hr style="width: 300px; border:1px solid #4169E1; color: #4169E1;"></center>
                <p class="tetleft"><a href="https://www.google.com/maps/search/?api=1&query=J.+P.+Rizal+St.,+Cor.+F.+Mercado+St.,+Brgy.+6+Poblacion,+Calamba,+Philippines" class="clickft"><i class="bi bi-geo-alt-fill"></i>&emsp;J. P. Rizal St., Cor. F. Mercado St., Brgy. 6 <span style="margin-left: 30px;">Poblacion, Calamba, Philippines</span></a></p>
            </div>
            <div class="col-md mt-3">
                <p><b>Quick Links</b></p>
                <center><hr style="width: 300px; border:1px solid #4169E1; color: #4169E1;"></center>
                <a type="button" href="aboutus.php" class="tetleft clickft">About us</a>
                <br>
                <a type="button" href="faqs.php" class="tetleft clickft">Frequently asked Questions</a>
            </div>
            <div class="col-md mt-3">
                <p><b>Contact Us:</b></p>
                <center><hr style="width: 300px; border:1px solid #4169E1; color: #4169E1;"></center>
                <p class="tetleft"><a href="https://www.facebook.com/museonijoserizalcalamba" class="clickft"><i class="bi bi-facebook"></i>&emsp;NHCP - Museo ni Jose Rizal, Calamba</a></p>
                <p class="tetleft"><a href="mailto:mjrc@nhcp.gov.ph" class="clickft"><i class="bi bi-envelope-at-fill"></i>&emsp;mjrc@nhcp.gov.ph</a></p>
                <p class="tetleft"><a href="tel:+63498341599" class="clickft"><i class="bi bi-telephone-fill"></i>&emsp;(049) 834 1599</a></p>
            </div>
        </div>
    </div>
</footer>

    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/input-validator.js"></script>
    <script src="assets/js/carscript.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
// Get all cards
const cards = document.querySelectorAll('.card');

// Function to toggle overlay
function toggleOverlay(card) {
    const overlay = card.querySelector('.overlay');
    if (overlay.classList.contains('active')) {
        overlay.classList.remove('active');
    } else {
        // Close any other open overlay
        cards.forEach(card => {
            card.querySelector('.overlay').classList.remove('active');
        });
        // Open the clicked overlay
        overlay.classList.add('active');
    }
}

// Add click event listener to each card
cards.forEach(card => {
    card.addEventListener('click', function() {
        toggleOverlay(this);
    });

    // Add touchstart event listener for mobile devices
    card.addEventListener('touchstart', function(e) {
        e.preventDefault(); // Prevent default touch behavior
        toggleOverlay(this);
    });
});
});
</script>

    <script>
        var modal = document.getElementById("myModal1");
        var span = document.getElementsByClassName("close2")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function showForm() {
            document.getElementById("formContent").classList.remove("hidden");
            document.getElementById("statusContent").classList.add("hidden");
            document.getElementById("modalTitle").textContent = "Booking Form";
            document.querySelector(".btn-toggle.form").style.backgroundColor = "#4169E1";
            document.querySelector(".btn-toggle.form").style.color = "white"; // Set text color to white
            document.querySelector(".btn-toggle.status").style.backgroundColor = "white";
            document.querySelector(".btn-toggle.status").style.color = "black"; // Set text color to black
        }

        function showStatus() {
            document.getElementById("formContent").classList.add("hidden");
            document.getElementById("statusContent").classList.remove("hidden");
            document.getElementById("modalTitle").textContent = "Booking Status";
            document.querySelector(".btn-toggle.form").style.backgroundColor = "white";
            document.querySelector(".btn-toggle.form").style.color = "black"; // Set text color to black
            document.querySelector(".btn-toggle.status").style.backgroundColor = "#4169E1";
            document.querySelector(".btn-toggle.status").style.color = "white"; // Set text color to white
        }

        // Set default text color
        document.querySelector(".btn-toggle.form").style.color = "white"; // Default text color for form button
        document.querySelector(".btn-toggle.status").style.color = "black"; // Default text color for status button


            </script>


            <script>
            function checkStatus() {
            // Retrieve the reference number
            var referenceNumber = document.querySelector('#statusContent input[name="contact_email"]').value;

            // AJAX request to send the reference number to check_status.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "check_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from check_status.php
                    document.getElementById('statusMessage').innerHTML = xhr.responseText;
                    // Hide the image when search is made
                    document.getElementById('noInfoImage').style.display = 'none';
                    // Change the background color to blue
                    document.getElementById('imageContainer').style.backgroundColor = '#4169E1';
                }
            };
            xhr.send("contact_email=" + referenceNumber); // Send the reference number as POST data
        }
</script>


<!--Form Individual or Organization-->
<script>
    function toggleFields() {
        var status = document.getElementById('modal-status').value;
        var organizationFields = document.querySelectorAll('.organization');
        var individualFields = document.querySelectorAll('.individual');

        if (status === 'Organization') {
            individualFields.forEach(function (field) {
                field.classList.add('hidden');
                field.removeAttribute('required');
            });
            organizationFields.forEach(function (field) {
                field.classList.remove('hidden');
                field.required = true;
            });
        } else {
            organizationFields.forEach(function (field) {
                field.classList.add('hidden');
                field.removeAttribute('required');
            });
            individualFields.forEach(function (field) {
                field.classList.remove('hidden');
                field.required = true;
            });
        }
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        toggleFields(); // Ensure the fields are toggled correctly on page load
    });
</script>


<!--Booking Validation-->
<script>
        function setMinDateTime() {
            let now = new Date();
            now.setDate(now.getDate() + 1);  // Set date to tomorrow
            let minDateTime = now.toISOString().slice(0, 16);  // Format date as YYYY-MM-DDTHH:MM
            document.getElementsByName("dati")[0].setAttribute("min", minDateTime);
        }

        function validateForm() {
            let form = document.forms["bookingForm"];
            let mobile = form["monu"].value;
            let numMale = parseInt(form["numa"].value, 10);
            let numFemale = parseInt(form["nufe"].value, 10);

            let mobilePattern = /^\d{11}$/;

            if (!mobilePattern.test(mobile)) {
                alert("Please enter a valid 11-digit mobile number.");
                return false;
            }

            if (!Number.isInteger(numMale) || numMale < 0 || numMale > 50) {
                alert("Number of males must be a non-negative integer and not more than 50.");
                return false;
            }

            if (!Number.isInteger(numFemale) || numFemale < 0 || numFemale > 50) {
                alert("Number of females must be a non-negative integer and not more than 50.");
                return false;
            }

            return true;
        }

        function preventInvalidInput(e) {
            const invalidChars = ['-', 'e', '+', '.'];
            if (invalidChars.includes(e.key)) {
                e.preventDefault();
            }
        }

        function restrictMobileInput(e) {
            const allowedKeys = [
                'Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab'
            ];
            if (allowedKeys.includes(e.key)) {
                return;
            }
            if (e.key < '0' || e.key > '9' || e.target.value.length >= 11) {
                e.preventDefault();
            }
        }

        window.onload = function() {
            setMinDateTime();
            document.getElementsByName("numa")[0].addEventListener("keydown", preventInvalidInput);
            document.getElementsByName("nufe")[0].addEventListener("keydown", preventInvalidInput);
            document.getElementsByName("monu")[0].addEventListener("keydown", restrictMobileInput);
        };

        function handleSubmit(event) {
        event.preventDefault(); // Prevent default form submission

        // Show loading spinner and hide button text
        document.getElementById('submitText').style.display = 'none';
        document.getElementById('loadingSpinner').classList.remove('visually-hidden');

        // Collect form data
        var formData = new FormData(document.getElementById('bookingForm'));

        // Send form data via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'booking.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // AJAX request successful, handle response
                    var response = xhr.responseText.trim();
                    if (response === 'success') {
                        // Show success alert after a short delay (e.g., 2 seconds)
                        setTimeout(function() {
                            document.getElementById('alertMessage').classList.remove('d-none');
                            // Reset form fields
                            document.getElementById('bookingForm').reset();
                        }, 2000); // Adjust delay as needed
                    } else {
                        // Show error message (optional)
                        console.error('Error: ' + response);
                        // Handle error scenario as needed
                    }
                } else {
                    // AJAX request failed
                    console.error('Error: ' + xhr.status);
                    // Handle error scenario as needed
                }

                // Reset button text and hide loading spinner
                setTimeout(function() {
                    document.getElementById('submitText').style.display = 'inline';
                    document.getElementById('loadingSpinner').classList.add('visually-hidden');
                }, 2000); // Adjust delay as needed
            }
        };
        xhr.onerror = function() {
            // Handle AJAX errors
            console.error('Error: AJAX request failed');
            // Reset button text and hide loading spinner on error
            document.getElementById('submitText').style.display = 'inline';
            document.getElementById('loadingSpinner').classList.add('visually-hidden');
        };
        xhr.send(formData);
    }

    function dismissAlert() {
        document.getElementById('alertMessage').classList.add('d-none');
    }

    function checkEmail() {
        var email = document.getElementById('emal').value.trim();
        if (email === '') {
            document.getElementById('emailStatus').innerHTML = '';
            return; // If email field is empty, do nothing
        }

        // Send AJAX request to check if email exists
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_email.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // AJAX request successful, handle response
                    var response = xhr.responseText.trim();
                    var emailStatusDiv = document.getElementById('emailStatus');
                    if (response === 'exists_future') {
                        // Email exists and has future bookings
                        emailStatusDiv.innerHTML = '<span style="color: red;">This email already has a future booking.</span>';
                        document.getElementById('bookingForm').querySelector('button[type="submit"]').disabled = true; // Disable submit button
                    } else if (response === 'exists_past') {
                        // Email exists but past bookings are allowed
                    } else if (response === 'not_exists') {
                        // Email does not exist
                    } else {
                        console.error('Error: Unexpected response');
                        emailStatusDiv.innerHTML = ''; // Clear email status
                        document.getElementById('bookingForm').querySelector('button[type="submit"]').disabled = false; // Enable submit button
                    }
                } else {
                    // AJAX request failed
                    console.error('Error: ' + xhr.status);
                }
            }
        };
        xhr.onerror = function() {
            // Handle AJAX errors
            console.error('Error: AJAX request failed');
        };
        xhr.send('email=' + encodeURIComponent(email));
    }

</script>


</body>
</html>
