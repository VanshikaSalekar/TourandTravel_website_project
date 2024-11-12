<?php
// Include database configuration
include('config.php');

// Display any errors (for development only)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if query is set
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $searchTerm = '%' . $query . '%';

    // Initialize results array
    $results = [];

    // Search Flight Bookings
    $stmt = $conn->prepare("SELECT 'Flight Booking' AS type, name, email, flight AS description, travel_date AS date, passengers FROM bookings WHERE name LIKE ? OR flight LIKE ?");
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    $stmt->close();

    // Search Tour Guides
    $stmt = $conn->prepare("SELECT 'Tour Guide' AS type, guide_name AS name, destination AS description, hire_date AS date, total_price AS price FROM hired_guides WHERE guide_name LIKE ? OR destination LIKE ?");
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    $stmt->close();

    // Search Hotel Reservations
    $stmt = $conn->prepare("SELECT 'Hotel Reservation' AS type, hotel_name AS name, special_requests AS description, checkin_date AS date, guests FROM hotel_reservations WHERE hotel_name LIKE ? OR special_requests LIKE ?");
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    $stmt->close();

    // Search Trips
    $stmt = $conn->prepare("SELECT 'Trip' AS type, trip_name AS name, trip_price AS price, number_of_travelers AS description, booking_date AS date FROM package_bookings WHERE trip_name LIKE ?");
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Display Results
    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['type']) . ": " . htmlspecialchars($row['name']) . "</h3>";
            echo "<p>Description: " . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Date: " . htmlspecialchars($row['date']) . "</p>";
            echo isset($row['price']) ? "<p>Price: " . htmlspecialchars($row['price']) . "</p>" : "";
            echo "</div><hr>";
        }
    } else {
        echo "No results found.";
    }
} else {
    echo "No query provided.";
}
?>
