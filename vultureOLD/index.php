<?php
require_once 'functions.php';
require_once 'image_processor.php';

$message = '';
$images = [];
if(!isset($_GET['secKey'])){ die('Sorry, no access.'); }
// Add this function at the beginning of your PHP file
function sortImages($images) {
    usort($images, function($a, $b) {
        $aName = pathinfo($a['name'], PATHINFO_FILENAME);
        $bName = pathinfo($b['name'], PATHINFO_FILENAME);
        
        $aIsNumeric = is_numeric($aName);
        $bIsNumeric = is_numeric($bName);
        
        if ($aIsNumeric && $bIsNumeric) {
            return $aName - $bName;
        } elseif ($aIsNumeric) {
            return -1;
        } elseif ($bIsNumeric) {
            return 1;
        } else {
            return strcasecmp($aName, $bName);
        }
    });
    
    return $images;
}


function getAllImageNames($baseDir = '/var/www/html/dedc/tarox/img') {
    $allNames = [];
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir));
    foreach ($it as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['webp'])) {
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
    <link rel="stylesheet" href="../css/vulture.css">
    <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
    <h1>Add New Decks</h1>
    <?php
    if (empty($folders)){
        ?>
    <span style="font-size: .7rem; color: #eee;">Browse <a href="https://cardscans.piwigo.com/" style="color: #aaa;" target="_new">https://cardscans.piwigo.com/</a> for decks.</span>
    
    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="url">Enter URL:</label>
        <input type="text" id="url" name="url" required>
        <input type="submit" class="process-button" value="Process Images">
    </form>

<?php } ?>
    <?php if (!empty($folders)): ?>
    <h2>Deck Finalization: 
    <?php foreach ($folders as $folder): ?>
        <b style="color: lightblue; text-shadow: 0px 0px 10px darkblue;"><?php echo $folder; ?></b>
        <button class="add-deck-button" data-folder="<?php echo $folder; ?>">
            Add New Deck! 🃏
        </button>
        </h2>
        <div class="image-grid">
            <?php
            $images = getImagesInFolder($folder);
            $images = sortImages($images); // Sort the images
            $usedNames = array();
            foreach ($images as $image) {
                if (!preg_match('/^\d+$/', pathinfo($image['name'], PATHINFO_FILENAME))) {
                    $usedNames[] = pathinfo($image['name'], PATHINFO_FILENAME);
                }
            }
            foreach ($images as $image):
                $originalName = pathinfo($image['name'], PATHINFO_FILENAME);
                $isGilded = !preg_match('/^\d+$/', $originalName);
            ?>
                <div class="image-card <?php echo $isGilded ? 'gilded' : ''; ?>">
                    <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['name']; ?>">
                    <select name="rename[<?php echo $folder; ?>][<?php echo $image['full_name']; ?>]" 
                            class="image-name <?php echo $isGilded ? 'gilded' : ''; ?>" 
                            data-folder="<?php echo $folder; ?>" 
                            data-original="<?php echo $image['full_name']; ?>">
                        <?php
                        $displayName = ucwords(str_replace('_', ' ', $originalName));
                        ?>
                        <option value="<?php echo $originalName; ?>" selected><?php echo $displayName; ?></option>
                        <?php
                        $availableNames = array_diff($allImageNames, $usedNames);
                        $unnamedOptions = array();
                        $namedOptions = array();
                        foreach ($availableNames as $name) {
                            if ($name !== $originalName) {
                                if (preg_match('/^\d+$/', $name)) {
                                    $unnamedOptions[] = $name;
                                } else {
                                    $namedOptions[] = $name;
                                }
                            }
                        }
                        sort($unnamedOptions, SORT_NUMERIC);
                        sort($namedOptions, SORT_STRING);
                        foreach ($unnamedOptions as $name): 
                            $displayName = ucwords(str_replace('_', ' ', $name));
                            if ($name === $originalName || !preg_match('/^\d+$/', $name)): // Only display if not just integers or is the original name
                        ?>
                            <option value="<?php echo $name; ?>"><?php echo $displayName; ?></option>
                        <?php endif; endforeach;
                        foreach ($namedOptions as $name): 
                            $displayName = ucwords(str_replace('_', ' ', $name));
                        ?>
                            <option value="<?php echo $name; ?>"><?php echo $displayName; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>



    <script src="script.js?v=1"></script>
                            </body>
</html>