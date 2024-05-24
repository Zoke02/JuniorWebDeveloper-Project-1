<?php
include "functions.php";
include "head.php";
?>

<main>
    <div class="job-card contact-box">
        <h2 class="job-card__h2">Contact</h2>
        <h3 class="job-card__h2 text-center">For any complains contact us.<br>We would also love to hear your opinion on our WebSite and what can we improve on it <span class="heart">&#10084;</span></h3>
        
            <form id="contact"name="contact" action="contact.php" class="job-card__form" method="post">
                <div class="contact__paragraphs">
                    <p>Our Information</p>
                    <p>Adress: Irlachstraße 76 / 2</p>
                    <p>Phone: +43 033 2342 234</p>
                </div>

                <label class="job-card__label" for="email">Your E-Mail:</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    class="job-card__input"
                    value="<?php
                    if (!empty($_POST["email"])) {
                        echo htmlspecialchars($_POST["email"]);
                    }
                    ?>"
                    placeholder="E-Mail"
                />

                <label class="job-card__label" for="message">Your message:</label>
                <textarea
                    class="job-card__textarea"
                    id="message"
                    name="message"
                    rows="25"
                    cols="50"
                    placeholder="Your message here..."

                ><?php
                    if (!empty($_POST["message"])) {
                        echo htmlspecialchars($_POST["message"]);
                    }
                ?></textarea>

                <div class="job_card__btn">
                    <button class="btn" id="submit-contact" name="submit-contact" onclick="return validateContactForm() ">Send Message</button>
                </div>
            </form>


    </div>
</main>
<?php
include "footer.php"
?>
