<?php

session_start();
$page_title = "Upload";
ob_start();

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/chrisjean/php-ico/class-php-ico.php';

use WideImage\WideImage;

// Initialize variables
$message = '';
$uploadDirectory = __DIR__ . '/uploads/';
$faviconsDirectory = __DIR__ . '/favicons/';
$icoFilePath = $faviconsDirectory . 'favicon.ico';
$webFaviconsPath = 'favicons/';
$webUploadsPath = 'uploads/';
$action = $_POST['action'] ?? '';

// Ensure `uploads/` and `favicons/` directories exist
if (!file_exists($uploadDirectory)) {
    // mkdir($uploadDirectory, 0777, true);
    die('111');
}
if (!file_exists($faviconsDirectory)) {
    // mkdir($faviconsDirectory, 0777, true);
    die('222');
}

// Get the last uploaded file from session
$originalFilename = $_SESSION['uploaded_file'] ?? null;

// Handle Image Upload (Upload Button)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'upload' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $originalFilename = $uploadDirectory . basename($image['name']);

    if ($image['error'] === 0) {
        if (move_uploaded_file($image['tmp_name'], $originalFilename)) {
            $_SESSION['success_message'] = "Image uploaded successfully!";
            $_SESSION['uploaded_file'] = $originalFilename; 
            $_SESSION['uploaded_web_path'] = $webUploadsPath . basename($image['name']);// Store file path in session
        } else {
            $_SESSION['error_message'] = "Failed to upload image.";
        }
    } else {
        $_SESSION['error_message'] = "Error uploading file: " . $image['error']; // Added more specific error
    }
    header("Location: index.php"); // Redirect to avoid resubmission
    exit;
}

// Handle Favicon Conversion (Convert Button)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'convert' && isset($_POST['sizes'])) {
    $selectedSizes = array_map('intval', $_POST['sizes']);
    if (!$originalFilename) {
        $originalFilename = $_SESSION['uploaded_file'] ?? null; // Use last uploaded file
    }
    if (!$originalFilename || !file_exists($originalFilename)) {
        $_SESSION['error_message'] = "No uploaded image found! Please upload an image first.";
        header("Location: index.php");
        exit;
    }

    if (empty($selectedSizes)) {
        $_SESSION['error_message'] = "Please select at least one favicon size.";
        header("Location: index.php");
        exit;
    }

    try {
        $maxSize = max($selectedSizes);
        $resizedImagePath = $faviconsDirectory . 'resized.png';

        // Resize & Crop Image
        WideImage::load($originalFilename)
            ->resize($maxSize, $maxSize, 'outside')
            ->crop("center", "middle", $maxSize, $maxSize)
            ->saveToFile($resizedImagePath);

        // Convert to ICO
        $sizeArray = array_map(fn($size) => [$size, $size], $selectedSizes);
        $ico = new PHP_ICO($resizedImagePath, $sizeArray);
        $ico->save_ico($icoFilePath);

        $_SESSION['success_message'] = "Favicon successfully created!";
        header("Location: upload.php?success=true");
        exit;
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error processing image: " . $e->getMessage();
        header("Location: index.php");
        exit;
    }
}
?>

<h2>Favicon Generator Results</h2>

<div class="container">
    <h2><?php echo $message; ?></h2>

    <!-- Display Success Message -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <p style="color: green;"><?= $_SESSION['success_message']; ?></p>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Display Error Message -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color: red;"><?= $_SESSION['error_message']; ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <!-- Download Button -->
    <?php if (file_exists($icoFilePath)): ?>
        <p>Your Favicon is ready!! Click below to download your favicon: </p>
        <div>
        <a href="download.php">
            <button class="download-btn"> Download Favicon </button>
        </a>
        </div>

    <?php else: ?>
        <p>Favicon file not found.</p>
    <?php endif; ?>

    <!-- Preview Original Image -->
    <?php $originalImagePath = !empty($_SESSION['uploaded_file']) ? $webUploadsPath . basename($_SESSION['uploaded_file']) : null;
    ?>
    <?php if ($originalFilename && file_exists($originalFilename)): ?>
        <p><strong> Original Image: </strong></p>
        <div>
        <img src="<?= $originalImagePath ?>?v=<?= time(); ?>" alt="Original Image">
        </div>
    <?php else: ?>
        <p>Original image not found.</p>
    <?php endif; ?>

    <!-- Preview Resized Image -->
    <?php $resizedImagePath = $webFaviconsPath . 'resized.png'; ?>
    <?php if (file_exists($resizedImagePath)): ?>
        <p><strong> Resized Image: </strong></p>
        <div>
        <img src="<?= $resizedImagePath ?>?v=<?= time(); ?>" alt="Resized Image">
        </div>
    <?php else: ?>
        <p>Resized image not found.</p>
    <?php endif; ?>

    <br>
    <a href="index.php">
        <button class="back-btn">Go Back to Upload</button>
    </a>
</div>

<?php
$page_content = ob_get_clean(); // Store the buffered content
include "layout.php"; // Include the layout
?>
