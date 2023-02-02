<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";
?>

<!-- MAIN SECTION -->
<main>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="firstName" placeholder="First name..." value="<?php if (isset($_GET["firstName"])) { echo $_GET["firstName"];} ?>">
        <input type="text" name="secondName" placeholder="Second name..." value="<?php if (isset($_GET["secondName"])) { echo $_GET["secondName"];} ?>">
        <input type="email" name="email" placeholder="email...">
        <input type="date" name="dateOfBirth" placeholder="Date of birth..." value="<?php if (isset($_GET["DOB"])) { echo $_GET["DOB"];} ?>">
        <input type="password" name="pwd" placeholder="Password...">
        <input type="password" name="pwdRepeat" placeholder="Password repeat...">
        <input type="submit" value="Sign up" name="submitSignUp">
    </form>
</main>

<!-- INCLUDING HEADER -->
<?php
include "skeleton/footer.php";
?>