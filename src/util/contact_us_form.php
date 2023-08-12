<div class="add-product">
    <h2 class="form-title">Contact us</h2>
    <form class="add-product-form" action="../util/contact_us.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required placeholder="Your Name (Required)">
        <label for="email">Email:</label>
        <input type="email" name="email" required placeholder="Your Email (Required)">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" required placeholder="Subject (Required)">
        <label for="message">Message:</label>
        <textarea name="message" required placeholder="Message (Required)"></textarea>
        <div class="center-container">
            <input type="submit" value="Send">
        </div>
    </form>
</div>
