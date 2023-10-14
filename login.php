<?php
include_once 'header.php';
?>
<section class="signup-form">
    <h2> LOGIN </h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="enter username">
        <input type="password" name="password" placeholder="enter password">
        <button type="submit" name="submit">Login</button>
    </form>
</section>

<?php
include_once 'footer.php';
?>