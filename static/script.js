document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL path (file name)
    var currentUrl = window.location.pathname.split('/').pop(); 
    
    // Select all navigation links
    var navLinks = document.querySelectorAll('.nav-link');
    
    // Loop through links and add 'active' class to the current page
    navLinks.forEach(function(link) {
        var linkPath = link.getAttribute('href').split('/').pop();
        if (linkPath === currentUrl) {
            link.classList.add('active');
        }
    });

    // Populate city dropdown
    const cityDropdown = document.getElementById('city');
    if (cityDropdown) {
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            cityDropdown.appendChild(option);
        });
    }

    // Initialize date picker using Flatpickr
    flatpickr('#date', {
        dateFormat: 'Y-m-d',
        minDate: 'today',
        altInput: true,
        altFormat: 'F j, Y'
    });

    // Handle form submission
    document.getElementById('booking-form').addEventListener('submit', function(event) {
        event.preventDefault();
        alert("Booking submitted successfully for ${selectedPackageInput.value} in ${cityDropdown.value} on ${document.getElementById('date').value}");
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');
    const loginBox = document.querySelector('.login-box');
    const registerBox = document.querySelector('.register-box');

    showRegister.addEventListener('click', function(e) {
        e.preventDefault();
        loginBox.classList.add('hidden');
        registerBox.classList.remove('hidden');
    });

    showLogin.addEventListener('click', function(e) {
        e.preventDefault();
        registerBox.classList.add('hidden');
        loginBox.classList.remove('hidden');
    });
});

// scripts.js

document.addEventListener("DOMContentLoaded", function() {
    const userRole = document.getElementById('user-role').textContent;
    const adminControls = document.getElementById('admin-controls');
    const profilePicUpload = document.getElementById('profile-pic-upload');
    const avatar = document.getElementById('avatar');

    // Show admin controls if user is an Admin
    if (userRole === "Admin") {
        adminControls.classList.remove('hidden');
    }

    // Handle profile picture upload preview
    profilePicUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                avatar.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle user settings form submission
    const settingsForm = document.getElementById('settings-form');
    settingsForm.addEventListener('submit', function(event) {event.preventDefault();

        // Retrieve selected settings values
        const notifications = document.getElementById('notifications').value;
        const theme = document.getElementById('theme').value;

        // Mock saving settings (you'd normally send this data to the server)
        console.log("Settings saved:");
        console.log("Email Notifications:", notifications);
        console.log("Theme:", theme);

        alert("Settings have been saved successfully.");
    });
});

// Toggle search input visibility
document.getElementById('search-toggle').addEventListener('click', function (e) {
    e.preventDefault();
    const searchInput = document.getElementById('search-input');
    
    // Toggle hidden class
    searchInput.classList.toggle('hidden');
    
    // Focus or blur depending on visibility
    if (!searchInput.classList.contains('hidden')) {
        searchInput.focus();
    } else {
        searchInput.blur();
    }
});

// Handle search input changes
document.getElementById('search-input').addEventListener('keyup', function () {
    const query = this.value;
    const searchResults = document.getElementById('search-results');

    if (query.length > 0) {
        // Perform AJAX request to search.php
        fetch('search.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `query=${encodeURIComponent(query)}` // Ensure the query is safely encoded
        })
        .then(response => response.text())
        .then(data => {
            // Display search results
            searchResults.innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    } else {
        // Clear results if the search query is empty
        searchResults.innerHTML = '';
    }
});


document.addEventListener('DOMContentLoaded', () => {
    // Form validation before submission
    const bookingForm = document.querySelector('.booking-form');
    bookingForm.addEventListener('submit', (e) => {
        const passengers = document.getElementById('passengers').value;
        if (passengers < 1 || passengers > 10) {
            e.preventDefault();
            alert('Number of passengers must be between 1 and 10.');
        }
    });
});

// List of video URLs
const videos = [
    'video1.mp4',
    'video2.mp4',
    'video3.mp4',
    'video4.mp4',
];

// Get the video element from the DOM
const heroVideo = document.getElementById('hero-video');

// Current index for the videos array
let currentVideoIndex = 0;

// Function to change the video source
function changeVideo() {
    // Update the video source
    heroVideo.src = videos[currentVideoIndex];
    heroVideo.load();
    heroVideo.play();

    // Move to the next video index
    currentVideoIndex = (currentVideoIndex + 1) % videos.length;
}

// Initial call to play the first video
changeVideo();

// Set an interval to change the video every 10 seconds
setInterval(changeVideo, 5000); // Change every 10 seconds

// Event listener to change the video when the current one ends
heroVideo.addEventListener('ended', changeVideo);

// JavaScript to update price and calculate total cost
document.getElementById('guide_name').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const pricePerDay = selectedOption.getAttribute('data-price');
    document.getElementById('price').value = pricePerDay ? pricePerDay : '';
    calculateTotalPrice();
});

document.getElementById('duration').addEventListener('input', calculateTotalPrice);

function calculateTotalPrice() {
    const pricePerDay = document.getElementById('price').value;
    const duration = document.getElementById('duration').value;
    const totalPrice = pricePerDay && duration ? pricePerDay * duration : 0;
    document.getElementById('total_price').value = totalPrice;
}

document.addEventListener('DOMContentLoaded', () => {
    // Select both forms
    const loginForm = document.querySelector('.login-box');
    const registerForm = document.querySelector('.register-box');

    // Function to validate email
    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail|yahoo|outlook|hotmail)\.com$/;
        return emailPattern.test(email);
    }

    // Add event listener for login form
    loginForm.addEventListener('submit', function (e) {
        const emailInput = this.querySelector('input[name="email"]');
        if (!validateEmail(emailInput.value)) {
            alert('Please enter a valid email address (e.g., example@gmail.com).');
            e.preventDefault();
        }
    });

    // Add event listener for register form
    registerForm.addEventListener('submit', function (e) {
        const emailInput = this.querySelector('input[name="email"]');
        if (!validateEmail(emailInput.value)) {
            alert('Please enter a valid email address (e.g., example@gmail.com).');
            e.preventDefault();
        }
    });
});

// Function to extract URL parameters
function getUrlParams() {
    const params = new URLSearchParams(window.location.search);
    return {
        name: params.get("name") || "",
        price: params.get("price") || "",
    };
}

// Function to populate the form fields
function populateBookingForm() {
    const { name, price } = getUrlParams();
    
    // Find the input fields
    const tripNameInput = document.getElementById("trip-name");
    const tripPriceInput = document.getElementById("trip-price");

    // Check if elements exist and populate them
    if (tripNameInput && tripPriceInput) {
        tripNameInput.value = decodeURIComponent(name);
        tripPriceInput.value = decodeURIComponent(price);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    // Check the stored dark mode preference in localStorage
    const savedDarkMode = localStorage.getItem("dark_mode");

    // If dark mode is enabled, apply the dark theme
    if (savedDarkMode === "true") {
        document.body.classList.add("dark-mode");
        document.body.classList.remove("light-mode");
    } else {
        // Otherwise, apply the light theme
        document.body.classList.add("light-mode");
        document.body.classList.remove("dark-mode");
    }
});