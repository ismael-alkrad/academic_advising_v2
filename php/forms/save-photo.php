<?php
include_once '../connect.php';
include_once '../functions.php';

// Check if a photo was uploaded
if (isset($_POST['photo'])) {
    // Get the file data
    $file_data = $_POST['photo'];

    // Get the filepath of the old photo, if it exists
    $old_filepath = getPhotoPathByUser($conn);

    // If the old photo exists, delete it from the directory
    if ($old_filepath && file_exists($old_filepath)) {
        unlink($old_filepath);
    }

    // Decode the base64-encoded data URI
    $img_data = str_replace('data:image/png;base64,', '', $file_data);
    $img_data = str_replace(' ', '+', $img_data);
    $img_data = base64_decode($img_data);

    // Generate a unique filename for the uploaded photo
    $filename = uniqid() . '.png';

    // Set the file path where the photo will be stored
    $filepath = '../../assets/images/personal-photo/' . $filename;

    // Save the cropped image to the directory
    if (file_put_contents($filepath, $img_data)) {
        // Prepare and execute the SQL query to insert/update the photo record
        $stmt = $conn->prepare("INSERT INTO photos (u_id, name, type, size, filepath) VALUES (?, ?, ?, ?, ?) 
                                ON DUPLICATE KEY UPDATE name = VALUES(name), type = VALUES(type), size = VALUES(size), filepath = VALUES(filepath)");
        $stmt->bindParam(1, $_SESSION['username']);
        $stmt->bindParam(2, $filename);
        $stmt->bindValue(3, 'image/png');
        $stmt->bindValue(4, filesize($filepath));
        $stmt->bindParam(5, $filepath);
        $stmt->execute();

        // Return a success message
        echo "Photo uploaded successfully!";
    } else {
        // Return an error message
        echo "Error uploading photo. Please try again.";
    }
}
