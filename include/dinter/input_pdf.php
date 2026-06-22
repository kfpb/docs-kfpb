<!DOCTYPE html>
<html>
<head>
    <title>Form Input untuk PDF</title>
</head>
<body>
    <?php
    $fileId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$fileId) {
        die("ID file tidak valid.");
    }
var_dump($fileId);
    ?>

    <h2>Tambahkan Input ke PDF</h2>
    <form method="post" action="/dok/web/index-ebr.php?id=<?php echo $fileId; ?>">
        <label for="userInput">Input Anda:</label><br>
        <textarea id="userInput" name="userInput" rows="4" cols="50"></textarea><br><br>
        <button type="submit">Generate PDF</button>
    </form>
</body>
</html>
