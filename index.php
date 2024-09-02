<!DOCTYPE html>
<html lang="en">
<?php
include('config.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarox</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <link rel="stylesheet" href="css/styles.css?v=210">
    <link rel="stylesheet" href="css/shared.css?v=210">
</head>

<body class="min-h-screen flex flex-col items-center justify-center p-4">
<div class="stars"></div>

<div class="modal">
<p style="color: cyan;">Tarox</p>
<p>Select cards as they pulsate.</p>
<p>View position info (lower right) and card details (upper left).</p>
<p>At the end, choose 'Combinations' (upper right).</p>
<p>Clicking card info auto-advances.</p>
<p>Select 'Begin' to start.</p>
    <br>
<label for="imgFolderSelect">Choose a Deck:</label>
    <select id="imgFolderSelect" onchange="updateImgFolder()">
        <option value="">Regular</option>
        <?php foreach ($folders as $folder): ?>
            <option value="<?php echo htmlspecialchars($folder); ?>"><?php echo htmlspecialchars($folder); ?></option>
        <?php endforeach; ?>
    </select>

    <button id="start-reading"
        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-1 px-2 text-sm rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105 mt-4">
        Begin
    </button>
    </p>
</div>

<button id="combinations-button"
    class="combinations-button bg-purple-600 hover:bg-purple-700 text-white font-bold py-1 px-2 text-sm rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105" style="display: none;">
    Combinations
</button>

<button id="help-button" title="Help Button" 
    class="help-button bg-purple-600 hover:bg-purple-700 text-white font-bold py-1 px-2 text-sm rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
    ❓
</button>

<button id="refresh-button" title="Refresh Button" 
    class="refresh-button bg-purple-600 hover:bg-purple-700 text-white font-bold py-1 px-2 text-sm rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
    🔄
</button>

<div id="reading-area" class="mt-8"></div>
<div id="selected-card" class="fade-in"></div>
<div id="position-info" class="fade-in"></div>

<script src="js/stars.js"></script>
    <script src="js/cardInfo.js"></script>
    <script src="js/help.js"></script>
    <script src="js/main.js"></script>
    <script src="js/help.js"></script>
   
</body>
</html>
