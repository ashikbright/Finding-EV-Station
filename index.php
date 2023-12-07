<?php

// Include the User and EVChargePoint classes
include 'User.php'; // Include the User class
include 'EVChargePoint.php'; // Include the EVChargePoint class

$chargingPoints = array(
  new EVChargePoint("Bangalore", 12.9716, 77.5946, 10, "Fast"),
  new EVChargePoint("Mysore", 12.2958, 76.6394, 6, "Medium"),
  new EVChargePoint("Hubli", 15.3647, 75.1240, 4, "Medium"),
  new EVChargePoint("Mangalore", 12.9141, 74.8550, 8, "Fast"),
  new EVChargePoint("Belgaum", 15.8497, 74.4977, 3, "Slow"),
  new EVChargePoint("Gulbarga", 17.3291, 76.8343, 5, "Medium"),
  new EVChargePoint("Udupi", 13.3409, 74.7421, 2, "Slow"),
  new EVChargePoint("Shimoga", 13.9299, 75.5681, 3, "Slow"),
  new EVChargePoint("Hassan", 13.0072, 76.0963, 2, "Slow"),
  new EVChargePoint("Davangere", 14.4644, 75.9213, 4, "Medium"),
  new EVChargePoint("Chitradurga", 14.2264, 76.3946, 2, "Slow"),
  new EVChargePoint("Bidar", 17.9224, 77.5173, 3, "Slow"),
  new EVChargePoint("Raichur", 16.2076, 77.3463, 2, "Slow"),
  new EVChargePoint("Hospet", 15.2713, 76.3874, 4, "Medium"),
  new EVChargePoint("Bellary", 15.1394, 76.9214, 3, "Slow"),
  new EVChargePoint("Dharwad", 15.3647, 75.1240, 3, "Slow"),
  new EVChargePoint("Haveri", 14.7937, 75.4013, 2, "Slow"),
  new EVChargePoint("Kolar", 13.1364, 78.1299, 3, "Slow"),
  new EVChargePoint("Chikmagalur", 13.3152, 75.7751, 2, "Slow"),
  new EVChargePoint("Tumkur", 13.3422, 77.1016, 4, "Medium"),
  // Add more charging points with their coordinates
);

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $currentLocation = $_POST['current_location'];

  // In this simplified example, we manually set coordinates for a few sample locations.
  $sampleCoordinates = getSampleCoordinates($currentLocation);

  if ($sampleCoordinates) {
    $user->setCurrentLocation($sampleCoordinates);
    $nearestPoint = $user->findNearestChargePoint($chargingPoints);
  }
}

// Function to get sample coordinates for sample locations
function getSampleCoordinates($location)
{
  $locations = [
    "Bangalore" => ["lat" => 12.9716, "lng" => 77.5946],
    "Mysore" => ["lat" => 12.2958, "lng" => 76.6394],
    "Hubli" => ["lat" => 15.3647, "lng" => 75.1240],
    "Mangalore" => ["lat" => 12.9141, "lng" => 74.8550],
    "Belgaum" => ["lat" => 15.8497, "lng" => 74.4977],
    "Gulbarga" => ["lat" => 17.3291, "lng" => 76.8343],
    "Udupi" => ["lat" => 13.3409, "lng" => 74.7421],
    "Shimoga" => ["lat" => 13.9299, "lng" => 75.5681],
    "Hassan" => ["lat" => 13.0072, "lng" => 76.0963],
    "Davangere" => ["lat" => 14.4644, "lng" => 75.9213],
    "Chitradurga" => ["lat" => 14.2264, "lng" => 76.3946],
    "Bidar" => ["lat" => 17.9224, "lng" => 77.5173],
    "Raichur" => ["lat" => 16.2076, "lng" => 77.3463],
    "Hospet" => ["lat" => 15.2713, "lng" => 76.3874],
    "Bellary" => ["lat" => 15.1394, "lng" => 76.9214],
    "Dharwad" => ["lat" => 15.3647, "lng" => 75.1240],
    "Haveri" => ["lat" => 14.7937, "lng" => 75.4013],
    "Kolar" => ["lat" => 13.1364, "lng" => 78.1299],
    "Chikmagalur" => ["lat" => 13.3152, "lng" => 75.7751],
    "Tumkur" => ["lat" => 13.3422, "lng" => 77.1016],
    // Add more sample locations and their coordinates
  ];

  return $locations[$location] ?? null;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Nearest EV Charging Point</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    .container {
      text-align: center;
      margin-top: 100px;
    }

    .form-container {
      background-color: #ffffff;
      border: 1px solid #d1d1d1;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 0px 10px 0px #aaa;
      display: inline-block;
    }

    .form-container h1 {
      color: #333;
    }

    .form-container form {
      text-align: left;
    }

    .form-container label {
      display: block;
      margin: 10px 0;
      color: #555;
    }

    .form-container input[type="text"] {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-container input[type="submit"] {
      background-color: #337ab7;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
      background-color: #286090;
    }

    .result-container {
      margin-top: 20px;
    }

    .result-container h2 {
      color: #333;
    }

    .result-container p {
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container">
      <h1>Nearest EV Charging Point</h1>
      <form method="POST">
        <label for="current_location">Enter your current location:</label>
        <input type="text" name="current_location" id="current_location" required>

        <!-- Autocomplete suggestions container -->
        <div id="autocomplete-suggestions"></div>
        <br>
        <input type="submit" value="Find Nearest Charging Point">
      </form>
    </div>

    <?php if (isset($nearestPoint)): ?>
      <div class="result-container">
        <h2>Nearest Charging Point:</h2>
        <p>Location: <?php echo $nearestPoint->getLocation(); ?></p>
        <p>Number of Charge Ports: <?php echo $nearestPoint->getNumberOfChargePorts(); ?></p>
        <p>Charging Speed: <?php echo $nearestPoint->getChargingSpeed(); ?></p>
      </div>
    <?php endif; ?>
  </div>

  <script>
    // Sample location suggestions
    const locationSuggestions = [
      "Bangalore", "Mysore", "Hubli", "Mangalore", "Belgaum",
      "Gulbarga", "Udupi", "Shimoga", "Hassan", "Davangere",
      "Chitradurga", "Bidar", "Raichur", "Hospet", "Bellary",
      "Dharwad", "Haveri", "Kolar", "Chikmagalur", "Tumkur",
    ];

    // Input element and suggestions container
    const inputLocation = document.getElementById("current_location");
    const suggestionsContainer = document.getElementById("autocomplete-suggestions");

    // Add event listener for input
    inputLocation.addEventListener("input", function () {
      const inputText = inputLocation.value.toLowerCase();
      const matchingSuggestions = locationSuggestions.filter(suggestion => suggestion.toLowerCase().includes(inputText));

      // Clear existing suggestions
      suggestionsContainer.innerHTML = "";

      // Display matching suggestions
      matchingSuggestions.forEach(suggestion => {
        const suggestionElement = document.createElement("div");
        suggestionElement.textContent = suggestion;
        suggestionElement.addEventListener("click", function () {
          inputLocation.value = suggestion;
          suggestionsContainer.innerHTML = "";
        });
        suggestionsContainer.appendChild(suggestionElement);
      });
    });
  </script>
</body>
</html>
