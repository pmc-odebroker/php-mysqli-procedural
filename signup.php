<?php
include_once 'header.php';
?>
<section class="signup-form">
    <h2> Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="first_name" placeholder="first name">
        <input type="text" name="middle_name" placeholder="middle name">
        <input type="text" name="last_name" placeholder="last name">
        <input type="email" name="email" placeholder="your email">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="pswd" placeholder="suggest password">
        <input type="password" name="repeat_password" placeholder="repeat password">
        <button type="submit" name="submit">Sign Up</button>
    </form>
</section>

<?php
include_once 'footer.php';
?>