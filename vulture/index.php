<?php
require_once 'functions.php';
require_once 'image_processor.php';

$message = '';
$images = [];

function getAllImageNames($baseDir = '/var/www/html/dedc/tarox/img') {
    $allNames = [];
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir));
    foreach ($it as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            $allNames[] = $file->getBasename('.' . $file->getExtension());
        }
    }
    $uniqueNames = array_unique($allNames);
    sort($uniqueNames); // Sort the array alphabetically
    return $uniqueNames;
}


$allImageNames = getAllImageNames();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['url'])) {
      $url = filter_var($_POST["url"], FILTER_SANITIZE_URL);
  
      // Check if the URL contains the desired string
      if (strpos($url, "https://cardscans.piwigo.com/") !== false) {
        $response = fetchUrl($url);
        if ($response !== false) {
          $images = processImages($response);
          $message = "Images processed successfully.";
        } else {
          $message = "Failed to fetch URL.";
        }
      } else {
        // Throw an error if the URL doesn't contain the string
        throw new Exception("Invalid URL. Please provide a URL containing https://cardscans.piwigo.com/");
      }
    }
  }


$folders = getFolders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Decks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add New Decks</h1>
    
    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="url">Enter URL:</label>
        <input type="text" id="url" name="url" required>
        <input type="submit" value="Process Images">
    </form>

    <?php if (!empty($folders)): ?>
    <h2>Deck Finalization</h2>
    <?php foreach ($folders as $folder): ?>
        <h3><?php echo $folder; ?></h3>
        <button class="add-deck-button" data-folder="<?php echo $folder; ?>">
            Add New Deck! 🃏
        </button>
        <div class="image-grid">
            <?php
            $images = getImagesInFolder($folder);
            foreach ($images as $image):
            ?>
                <div class="image-card">
                    <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['name']; ?>">
                    <select name="rename[<?php echo $folder; ?>][<?php echo $image['full_name']; ?>]" 
                            class="image-name" 
                            data-folder="<?php echo $folder; ?>" 
                            data-original="<?php echo $image['full_name']; ?>">
                        <option value="<?php echo $image['name']; ?>" selected><?php echo $image['name']; ?></option>
                        <?php foreach ($allImageNames as $name): ?>
                            <?php if ($name !== $image['name']): ?>
                                <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <script src="script.js"></script>
                            </body>
</html>