<?php
// Crop Image 1 (Booking page)
$src1 = 'C:/Users/divya/.gemini/antigravity/brain/43b898a6-b7d8-494b-aff5-42e877e2579f/.user_uploaded/media_1793444905473_ae0f8af6.png';
$img1 = imagecreatefrompng($src1);
$w1 = imagesx($img1);
$h1 = imagesy($img1);

$c1 = imagecrop($img1, [
    'x' => (int)($w1 * 0.28), 
    'y' => (int)($h1 * 0.20), 
    'width' => (int)($w1 * 0.44), 
    'height' => (int)($h1 * 0.60)
]);
imagepng($c1, __DIR__ . '/booking_crop.png');

// Crop Image 2 (Service detail with red circle)
$src2 = 'C:/Users/divya/.gemini/antigravity/brain/43b898a6-b7d8-494b-aff5-42e877e2579f/.user_uploaded/media_1793445052217_7a2a725d.jpg';
$img2 = imagecreatefromjpeg($src2);
$w2 = imagesx($img2);
$h2 = imagesy($img2);

$c2 = imagecrop($img2, [
    'x' => (int)($w2 * 0.50), 
    'y' => (int)($h2 * 0.40), 
    'width' => (int)($w2 * 0.40), 
    'height' => (int)($h2 * 0.48)
]);
imagepng($c2, __DIR__ . '/service2_crop.png');

echo "Saved booking_crop.png and service2_crop.png\n";
