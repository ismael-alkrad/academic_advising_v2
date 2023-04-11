<?php
include_once '../connect.php';
include_once '../functions.php';

// Check if a photo was uploaded
if (isset($_FILES['photo'])) {
    // Get the file data
    $file_data = $_FILES['photo'];
    $name = $file_data['name'];
    $type = $file_data['type'];
    $size = $file_data['size'];
    $tmp_name = $file_data['tmp_name'];

    // Generate a unique filename for the uploaded photo
    $filename = uniqid() . '_' . $name;

    // Set the file path where the photo will be stored
    $filepath = '../../assets/images/personal-photo/' . $filename;

    // Get the filepath of the old photo, if it exists
    $old_filepath = getPhotoPathByUser($conn);

    // If the old photo exists, delete it from the directory
    if ($old_filepath && file_exists($old_filepath)) {
        unlink($old_filepath);
    }

    // Move the uploaded photo to the directory
    if (move_uploaded_file($tmp_name, $filepath)) {
        // Prepare and execute the SQL query to insert/update the photo record
        $stmt = $conn->prepare("INSERT INTO photos (u_id, name, type, size, filepath) VALUES (?, ?, ?, ?, ?) 
                                ON DUPLICATE KEY UPDATE name = VALUES(name), type = VALUES(type), size = VALUES(size), filepath = VALUES(filepath)");
        $stmt->bindParam(1, $_SESSION['username']);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $type);
        $stmt->bindParam(4, $size);
        $stmt->bindParam(5, $filepath);
        $stmt->execute();

        // Return a success message
        echo "Photo uploaded successfully!";
    } else {
        // Return an error message
        echo "Error uploading photo. Please try again.";
    }
}
