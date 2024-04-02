<?php
include "functions.php";
include "head.php";
if ($_GET["page"] = "login") {
?>


<main>
    <form class="login" action="post">
        <h1>
            Login
        </h1>
        <div class="login_row">
            <label class="login_label" for="">E-Mail</label>
            <input type="text" class="username" id="username" />
            <label class="login_label" for="">Password</label>
            <input type="password" class="password" id="password" />
        </div>

        <div class="login_row">
            <button class="btn btn-secondary" type="submit">Login</button>
            <button class="btn" type="submit">Sing up now!</button>
        </div>
    </form>
</main>

<?php
}
include "footer.php"
?>