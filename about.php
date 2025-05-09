<?php
$page_title = "About the author"; // Set the page title
ob_start(); // Start output buffering
?>
<section class="about">
<img id="authimg" src="./Adil.jpg" alt="picture of author" >
<p3 class="p3">
    Adil Surve is an avid gamer and has been playing video games since the original Atari 2600. He loves most genres of
    games, except maybe sports games, RPGs, FMV games, Visual novels, Strategy games, action games, shooters etc. His
    primary gaming platform of choice is PC. When he is not busy playing video games, you can find him playing board
    games or reading.He also enjoys watching movies and TV shows. He builds his own PCs and fixes PCs for friends and
    family. He is also a web developer and is interested in all things related to technology.
</p3>
</section>
<?php
$page_content = ob_get_clean(); // Store the buffered content
include "layout.php"; // Include the layout
?>
