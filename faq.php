<?php
$page_title = "Frequently Asked Questions"; // Set the page title
ob_start(); // Start output buffering
?>

<h2>Frequently Asked Questions</h2>

<h3>What is a favicon?</h3>
<p>A favicon is a small icon displayed in the browser tab of your website.</p>

<h3>How do I create a favicon?</h3>
<p>Simply upload an image and click "Convert to ICO" to generate a favicon file.</p>

<h3>What sizes should I choose?</h3>
<p>We recommend selecting multiple sizes (16x16, 32x32, 64x64) for better browser support.</p>

<h3>What image formats are supported?</h3>
<p>You can upload PNG, JPEG, and GIF files to create favicons.</p>

<h3>Where should I place my favicon on my website?</h3>
<p>Upload the favicon.ico file to your website’s root directory and add this line to your HTML:
<div>
    <code class="code">&lt;link rel="icon" type="image/x-icon" href="favicon.ico"&gt;</code>
</div>
</p>

<?php
$page_content = ob_get_clean(); // Store the buffered content
include "layout.php"; // Include the layout
?>