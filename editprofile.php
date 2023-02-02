<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";

if(!isset($_SESSION['userId'])){
    header("location: index.php");
}
?>

<!-- MAIN SECTION -->
<main>
    <form action="includes/editprofile.inc.php" method="post" enctype='multipart/form-data'>
        <input type="text" name="firstName" placeholder="First name..." value="<?php echo $_SESSION["userFirstName"]; ?>"><br>
        <input type="text" name="secondName" placeholder="Second name..." value="<?php echo $_SESSION["userSecondName"]; ?>"><br>
        <input type="email" name="email" placeholder="email..." value="<?php echo $_SESSION["userEmail"]; ?>"><br>
        <input type="date" name="dateOfBirth" placeholder="Date of birth..." value="<?php echo $_SESSION["userDOB"]; ?>"><br>
        <input type="file" name="profileImg"><br>
        <input type="submit" value="Save Changes" name="submit">
    </form>

    <form action="includes/deleteprofilepic.inc.php" method="post">
        <input type="submit" value="Delete profile picture" name="submit">
    </form>

    <form action="includes/deleteprofile.inc.php" method="post">
        <input type="submit" value="Delete profile permanently" name="submit">
    </form>
</main>

<!-- INCLUDING HEADER -->
<?php
include "skeleton/footer.php"
?>