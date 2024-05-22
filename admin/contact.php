<?php
include "functions.php";
include "head.php";
?>

<main>
    <section>
        <div class="text">
            <h1>Kontakt</h1>
            <div class="contact right">
                <form action="" method="post">
                    <div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            
                            value="<?php 
                            if (!empty($_POST["name"])) {
                                echo htmlspecialchars($_POST["name"]);
                            }
                            ?>"
                            placeholder="Name"
                        />
                        <!-- Above PHP keeps the value what u entered for when it fails -->
                    </div>

                    <div>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            value="<?php 
                            if (!empty($_POST["email"])) {
                                echo htmlspecialchars($_POST["email"]);
                            }
                            ?>"
                            placeholder="E-Mail"
                        />
                    </div>
                    <div>
                        <input
                            type="text"
                            id="empty"
                            name="empty"
                            value=""
                            placeholder="Empty FIELD"
                        />
                    </div>

                    <div>
                        <textarea
                            id="message"
                            name="message"
                            placeholder="Ihre Nachricht Here"
                            
                        ><?php 
                            if (!empty($_POST["message"])) {
                                echo htmlspecialchars($_POST["message"]);
                            }
                            ?></textarea>
                    </div>
                    <div style="text-align: right">
                        <button type="submit" id="submit" name="submit">
                            Absenden
                        </button>
                    </div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </section>
</main>

<?php
include "footer.php"
?>