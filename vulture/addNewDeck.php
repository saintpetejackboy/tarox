<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['folder'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$folder = $_POST['folder'];

include('../config.php');

if (!is_dir($sourceDir)) {
    echo json_encode(['success' => false, 'message' => 'Source folder not found']);
    exit;
}

if (is_dir($destDir)) {
    echo json_encode(['success' => false, 'message' => 'Destination folder already exists']);
    exit;
}

// Move and convert images
if (!rename_and_convert($sourceDir, $destDir)) {
    echo json_encode(['success' => false, 'message' => 'Failed to move and convert the folder']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Folder moved and images converted successfully']);

function rename_and_convert($sourceDir, $destDir) {
    // Create the destination directory
    if (!mkdir($destDir, 0755, true)) {
        return false;
    }

    // Scan the source directory for images
    $files = array_diff(scandir($sourceDir), array('..', '.'));
    
    foreach ($files as $file) {
        $sourceFile = $sourceDir . '/' . $file;
        $fileInfo = pathinfo($sourceFile);
        $extension = strtolower($fileInfo['extension']);
        
        // Only handle files, not directories
        if (is_file($sourceFile)) {
            $image = false;

            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($sourceFile);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($sourceFile);
                    break;
                case 'png':
                    $image = imagecreatefrompng($sourceFile);
                    break;
                default:
                    continue 2; // Skip files with unsupported extensions
            }

            if ($image) {
                // Convert to WebP and save in destination
                $newFileName = $fileInfo['filename'] . '.webp';
                $destinationFile = $destDir . '/' . $newFileName;

                if (!imagewebp($image, $destinationFile, 80)) {
                    imagedestroy($image);
                    return false;
                }
                
                imagedestroy($image);
            } else {
                // Handle other file types if necessary
                return false;
            }
        }
    }

    // Remove the source directory if everything is successful
    array_map('unlink', glob("$sourceDir/*.*"));
    rmdir($sourceDir);

    return true;
}

?>
