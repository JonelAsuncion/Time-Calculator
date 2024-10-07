<?php

// Function to convert time units
function convertTime($value, $fromUnit, $toUnit) {
    // Conversion factors from the base unit (seconds)
    $conversionRates = array(
        'seconds' => 1,
        'minutes' => 60,
        'hours' => 3600,
        'days' => 86400,
        'weeks' => 604800,
        'months' => 2630016, 
        'years' => 31536000,
    );

    // Check if the units exist in the conversion rates array
    if (!isset($conversionRates[$fromUnit]) || !isset($conversionRates[$toUnit])) {
        return 0; // Invalid unit, return 0 or handle error accordingly
    }

    // Convert the input value to seconds (base unit)
    $valueInSeconds = $value * $conversionRates[$fromUnit];

    // Convert from seconds to the target unit
    $convertedValue = $valueInSeconds / $conversionRates[$toUnit];

    return $convertedValue;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get input values with validation
    $value = isset($_POST['value']) ? floatval($_POST['value']) : 0;
    $fromUnit = isset($_POST['fromUnit']) ? $_POST['fromUnit'] : '';
    $toUnit = isset($_POST['toUnit']) ? $_POST['toUnit'] : '';

    // Validate that units are selected
    if ($fromUnit && $toUnit && $value > 0) {
        // Call the conversion function
        $result = convertTime($value, $fromUnit, $toUnit);

        // Display the result
        echo "<h3>Result: $value $fromUnit is equal to " . number_format($result, 6) . " $toUnit.</h3>";
    } else {
        echo "<h3>Please enter a valid value and select both units.</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Unit Conversion Tool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        h3 {
            text-align: center;
            color: black;
        }
    </style>
</head>
<body>
    <h1>Time Unit Conversion Tool</h1>
    <form method="post">
        <label for="value">Enter Value:</label>
        <input type="number" step="any" name="value" required>
        <br>

        <label for="fromUnit">Convert from:</label>
        <select name="fromUnit" required>
            <option value="seconds">Seconds</option>
            <option value="minutes">Minutes</option>
            <option value="hours">Hours</option>
            <option value="days">Days</option>
            <option value="weeks">Weeks</option>
            <option value="months">Months</option>
            <option value="years">Years</option>
        </select>

        <label for="toUnit">Convert to:</label>
        <select name="toUnit" required>
            <option value="seconds">Seconds</option>
            <option value="minutes">Minutes</option>
            <option value="hours">Hours</option>
            <option value="days">Days</option>
            <option value="weeks">Weeks</option>
            <option value="months">Months</option>
            <option value="years">Years</option>
        </select>

        <button type="submit" name="submit">Convert</button>
    </form>
</body>
</html>
