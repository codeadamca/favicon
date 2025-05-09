<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set page title and content if not already set
$page_title = $page_title ?? "Favicon Generator"; // Default title
$page_content = $page_content ?? "<p>Page not found.</p>"; // Default content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Favicon Generator</h1>
        <h2>Convert your pictures to ICO online & for free!</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="faq.php">FAQ</a>
        </nav>
    </header>

    <main>
        <?php echo $page_content; ?>
    </main>

    <footer>
        <p>&copy; 2025 Favicon Generator. All rights reserved.</p>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="faq.php">FAQ</a>
        </nav>
    </footer>

</body>
</html>
