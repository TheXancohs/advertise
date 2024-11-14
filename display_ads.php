<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ads</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 40px;
        }
        .ad {
            display: flex;
            background-color: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        .ad:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .ad img {
            width: 300px;
            height: auto;
            object-fit: cover;
        }
        .ad-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .ad-content h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .ad-content p {
            color: #555;
            margin-bottom: 10px;
            line-height: 1.6;
        }
        .ad-category {
            font-style: italic;
            color: #888;
        }
        .contact-info {
            font-weight: bold;
            color: #555;
        }
        .no-image {
            font-style: italic;
            color: #999;
            width: 300px;
            text-align: center;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ad-footer {
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Business Ads</h1>

    <?php
    $ads_file = 'ads.txt';

    // Check if file exists and read ads data
    if (file_exists($ads_file)) {
        $ads_data = file($ads_file);

        foreach ($ads_data as $ad) {
            // Split the ad data by the delimiter (|)
            list($business_name, $description, $contact_info, $category, $image_path) = explode('|', $ad);
            $image_path = trim($image_path); // Trim to remove any extra spaces

            echo "<div class='ad'>";
            
            // Display image if available, otherwise display placeholder text
            if ($image_path !== "no_image" && file_exists($image_path)) {
                echo "<img src='" . htmlspecialchars($image_path) . "' alt='Business Image'>";
            } else {
                echo "<div class='no-image'>No image available</div>";
            }

            // Display the ad content
            echo "<div class='ad-content'>";
            echo "<h2>" . htmlspecialchars($business_name) . "</h2>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($description) . "</p>";
            echo "<p class='contact-info'><strong>Contact Info:</strong> " . htmlspecialchars($contact_info) . "</p>";
            echo "<p class='ad-category'><strong>Category:</strong> " . htmlspecialchars($category) . "</p>";
            echo "</div>"; // End of ad-content

            echo "</div>"; // End of ad
        }
    } else {
        echo "<p>No ads available.</p>";
    }
    ?>

</div>

</body>
</html>
