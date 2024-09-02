<?php
function processImages($html) {
    $basePath = __DIR__ . '/added';
    if (!is_dir($basePath)) {
        mkdir($basePath, 0755, true);
    }

    $pattern = '/<a[^>]+href="([^"]*picture\?[^"]*)".*?<img[^>]+src="([^"]*)"/i';
    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

    $processedImages = [];
    $imageCounter = 1;

    foreach ($matches as $match) {
        $href = $match[1];
        $imgSrc = $match[2];

        $folderName = preg_replace('/.*\/([^\/]+)$/', '$1', $href);
        $folderName = preg_replace('/[0-9]+/', '', $folderName);
        $folderName = preg_replace('/[-_]/', '_', $folderName); // Replace spaces with underscores
        $folderName = trim($folderName);

        $folderPath = $basePath . '/' . $folderName;
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $imageUrl = 'https://cardscans.piwigo.com/' . ltrim($imgSrc, '.');
        $imageExtension = pathinfo($imgSrc, PATHINFO_EXTENSION);
        $imageName = $imageCounter . '.' . $imageExtension;
        $imagePath = $folderPath . '/' . $imageName;

        if (file_put_contents($imagePath, file_get_contents($imageUrl))) {
            $processedImages[] = [
                'folder' => $folderName,
                'name' => pathinfo($imageName, PATHINFO_FILENAME),
                'full_name' => $imageName,
                'path' => 'added/' . $folderName . '/' . $imageName
            ];
            $imageCounter++;
        }
    }

    return $processedImages;
}
