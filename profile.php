<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";

if(!isset($_SESSION['userId'])){
    header("location: index.php");
}
?>

<!-- MAIN SECTION -->
<main>
    <?php echo $_SESSION['userFirstName']?> </br>
    <?php echo $_SESSION['userSecondName']?> </br>
    <?php echo $_SESSION['userEmail']?> </br>
    <?php echo $_SESSION['userDOB']?> </br>
    <img src="<?php echo $_SESSION['profileImg']?>" alt=""> </br>
    <a href="editprofile.php">Edit profile</a>
    </form>
</main>

<!-- INCLUDING HEADER -->
<?php
include "skeleton/footer.php"
?>