<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $newLoginData = array(
        'username' => $username,
        'password' => $password
    );

    $file = 'login.json';

    if (file_exists($file)) {
        // File exists, so read and update the data
        $existingData = json_decode(file_get_contents($file), true);

        if ($existingData !== null) {
            // Append the new data to the existing data
            $existingData[] = $newLoginData;
        } else {
            // Existing data is invalid JSON, overwrite it with the new data
            $existingData = $newLoginData;
        }
    } else {
        // File doesn't exist, create it with the new data
        $existingData = $newLoginData;
    }

    // Save the merged data as JSON
    if (file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT)) !== false) {
        echo 'Login data updated successfully.';
    } else {
        echo 'Failed to save location data.';
    }
}
?>
