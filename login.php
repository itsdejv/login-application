<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";
?>

<!-- MAIN SECTION -->
<main>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="email" placeholder="Email..">
        <input type="password" name="pwd" placeholder="Password..">
        <input type="submit" name="submitLogIn" value="Log in">
    </form>
</main>

<!-- INCLUDING HEADER -->
<?php
include "skeleton/footer.php";
?>