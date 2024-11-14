<?php
// Directory to store uploaded images
$target_dir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $business_name = htmlspecialchars($_POST['business_name']);
    $description = htmlspecialchars($_POST['description']);
    $contact_info = htmlspecialchars($_POST['contact_info']);
    $category = htmlspecialchars($_POST['category']);
    $image = $_FILES['image'];

    // Handle image upload if an image was provided
    $target_file = "";
    if ($image && $image['error'] == 0) {
        $target_file = $target_dir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type (allow only jpg, png, jpeg, gif)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            move_uploaded_file($image["tmp_name"], $target_file);
        } else {
            echo "Invalid file type.";
            exit();
        }
    }

    // Save ad data
    $ads_file = 'ads.txt'; 
    $ad_data = "$business_name|$description|$contact_info|$category|$target_file\n";
    file_put_contents($ads_file, $ad_data, FILE_APPEND);

    // Redirect to display page with success message
    header("Location: display_ads.php?success=1");
    exit();
}
?>
