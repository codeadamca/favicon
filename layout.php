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
    <title><?php echo $page_title; ?> | CodeAdam</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Favicon Generator</h1>
    </header>

    <main>
        <?php echo $page_content; ?>
    </main>

    <footer>
        <p></p>
    </footer>

</body>
</html>
