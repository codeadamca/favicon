<?php
session_start(); // Ensure session is started at the beginning of the page
$page_title = "Home"; 
ob_start();
?>
    <section class="order">
        <div class="left">
            <h3>FROM</h3>
            <img src="./photoicon.png" alt="image of picture frame" style="width:100%;">
            <h3>TO</h3>
            <img src="./editfav.png" alt="images of favicons" style="width:100%;">
        </div>

        <div class="container">
            <p class="p">Ready to make your website stand out? Let's create a custom favicon for your site!</p>

            <p class="p"><strong>How?</strong> Just upload an image or drag and drop it onto the page, then convert it into a favicon with one click!</p>

            <div class="instructions">
                <p><strong>Instructions:</strong></p>
                <ul class="onetwo">
                    <li>Select an image file (GIF, JPEG, JPG, PNG).</li>
                    <li>Max file size: 50MB.</li>
                    <li>Click **Upload** to save the image.</li>
                    <li>Choose an image size, or choose multiple sizes for more compatibility.</li>
                    <li>Click **Convert to ICO** to generate your favicon.</li>
                    <li>Check out the preview.</li>
                    <li>Like what you see? Click Download!</li>
                </ul>
            </div>

            <!-- Show Notifications -->
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div class="notification success">
                    <?= $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error_message'])): ?>
                <div class="notification error">
                    <?= $_SESSION['error_message']; ?>
                    <?php unset($_SESSION['error_message']); ?>
                </div>
            <?php endif; ?>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="image">Choose an image:</label>
                <input type="file" name="image" id="image" <?= isset($_SESSION['uploaded_file']) ? '' : 'required'; ?>><br><br>

                <input type="hidden" name="last_uploaded" value="<?= $_SESSION['uploaded_file'] ?? ''; ?>">

                <button type="submit" class="upload-btn" name="action" value="upload">Upload</button>
            </form>

            <br>

            <?php if (!empty($_SESSION['uploaded_file'])): ?>
                <form action="upload.php" method="post">
                    <h3>Select Favicon sizes:</h3>
                    <div class="options">
                        <p>16x16<input type="checkbox" name="sizes[]" value="16"></p>
                        <p>32x32<input type="checkbox" name="sizes[]" value="32" checked></p>
                        <p>48x48<input type="checkbox" name="sizes[]" value="48"></p>
                        <p>64x64<input type="checkbox" name="sizes[]" value="64"></p>
                        <p>128x128<input type="checkbox" name="sizes[]" value="128"></p>
                        <p>256x256<input type="checkbox" name="sizes[]" value="256"></p>
                    </div>

                    <input type="hidden" name="last_uploaded" value="<?= $_SESSION['uploaded_file']; ?>">
                    
                    <br>
                    <button type="submit" class="convert-btn" name="action" value="convert">Convert to ICO</button>
                </form>
            <?php endif; ?>
        </div>
        <div class="right">
            <p>
            <h3>Icon</h3><br>
            ICO is a file format that contains small image icons of different resolutions (16x16, 32x32, 64x64 pixels) 
            and various color depths (16 colors, 32, 64, 128, 256, 16-bit, etc.). It is used to display files and folders 
            in graphical user interfaces (GUI) of operating systems.
            </p>
            
            <p>
            <h3>.PNG</h3><br>
            A .PNG file is a Portable Network Graphic file, a raster image format that supports lossless data compression.
            PNGs are commonly used for web graphics, logos, and illustrations.
            </p>
            
            <p>
            <h3>.JPEG</h3><br>
            A .JPEG is a file extension for a Joint Photographic Experts Group (JPEG) file, a common format for storing 
            and sharing digital images. JPEG files are compressed to reduce their file size, making them easier to store 
            and load on the web.
            </p>
            
            <p>
            <h3>.GIF</h3><br>
            A .GIF (Graphics Interchange Format) is a widely used image format that supports both static images and animations.
            GIFs are commonly used on the web to display graphics and logos. They also support basic animation, making them 
            popular for memes on social media.
            </p>
        </div>

    </section>

<?php
$page_content = ob_get_clean();
include "layout.php";
?>
