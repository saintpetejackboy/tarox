<?php
require_once 'functions.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Unknown action'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['rename_file'])) {
        $folder = $_POST['folder'];
        $oldName = $_POST['old_name'];
        $newName = $_POST['new_name'];

        $renameResult = renameSingleImage($folder, $oldName, $newName);
        $response = $renameResult;

    } elseif (isset($_POST['rename_folder'])) {
        $oldName = $_POST['old_name'];
        $newName = $_POST['new_name'];

        $renameResult = renameFolders([$oldName => $newName]);
        $response = $renameResult;
    }
}




function renameSingleImage($folder, $oldName, $newName) {
    $basePath = __DIR__ . '/added/';
    $sanitizedFolder = sanitizeFolderName($folder);
    $oldPath = $basePath . $sanitizedFolder . '/' . $oldName;
    $newPath = $basePath . $sanitizedFolder . '/' . $newName . '.' . pathinfo($oldName, PATHINFO_EXTENSION);
    
    // Check if new name already exists
    if (file_exists($newPath)) {
        return ['success' => false, 'message' => "The file name '$newName' already exists."];
    }

    if (file_exists($oldPath) && $oldName !== $newName) {
        if (rename($oldPath, $newPath)) {
            return ['success' => true, 'message' => "Image renamed successfully."];
        } else {
            return ['success' => false, 'message' => "Failed to rename image."];
        }
    }
    return ['success' => false, 'message' => "File does not exist or no change in name."];
}

function renameFolders($renamePairs) {
    $basePath = __DIR__ . '/added/';
    foreach ($renamePairs as $oldName => $newName) {
        $oldPath = $basePath . sanitizeFolderName($oldName);
        $newPath = $basePath . sanitizeFolderName($newName);
        
        // Check if new folder name already exists
        if (file_exists($newPath)) {
            return ['success' => false, 'message' => "The folder name '$newName' already exists."];
        }

        if (file_exists($oldPath)) {
            if (!rename($oldPath, $newPath)) {
                return ['success' => false, 'message' => "Failed to rename folder '$oldName'."];
            }
        } else {
            return ['success' => false, 'message' => "Folder '$oldName' does not exist."];
        }
    }
    return ['success' => true, 'message' => "Folder renamed successfully."];
}


echo json_encode($response);
