<?php
include "skeleton/header.php";
?>

<!-- MAIN SECTION -->
<main>
    <form action='test.php' method='post' enctype='multipart/form-data'>
        <input type='file' name='file' id=''>
        <input type='submit' name='submit' value='Kokot'>
    </form>
</main>

<!-- INCLUDING HEADER -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["file"];

    print_r($file);
    print($file['name']);
} else {
    echo "error";
}
    include "skeleton/footer.php";
?>