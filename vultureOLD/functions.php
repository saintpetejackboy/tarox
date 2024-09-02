<?php
function fetchUrl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $response;
}


function getImagesInFolder($folder) {
    $basePath = __DIR__ . '/added/' . $folder;
    $images = [];
    foreach (glob($basePath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image) {
        $name = pathinfo($image, PATHINFO_FILENAME);
        $fullName = basename($image);
        $relativePath = 'added/' . $folder . '/' . $fullName;
        $images[] = [
            'name' => $name,
            'full_name' => $fullName,
            'path' => $relativePath
        ];
    }
    return $images;
}

function sanitizeFolderName($name) {
    // Remove any characters that are not alphanumeric, dashes, or underscores
    $sanitized = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
    // Replace spaces with underscores
    $sanitized = str_replace(' ', '_', $sanitized);
    return $sanitized;
}

function getFolders() {
    $basePath = __DIR__ . '/added';
    return array_map('basename', glob($basePath . '/*', GLOB_ONLYDIR));
}


function renameImages($renames) {
    $basePath = __DIR__ . '/added/';
    foreach ($renames as $folder => $images) {
        $sanitizedFolder = sanitizeFolderName($folder);
        foreach ($images as $oldName => $newName) {
            $sanitizedNewName = sanitizeFolderName($newName);
            $oldPath = $basePath . $sanitizedFolder . '/' . $oldName;
            $newPath = $basePath . $sanitizedFolder . '/' . $sanitizedNewName . '.' . pathinfo($oldName, PATHINFO_EXTENSION);
            if (file_exists($oldPath) && $oldName !== $sanitizedNewName) {
                rename($oldPath, $newPath);
            }
        }
    }
}
