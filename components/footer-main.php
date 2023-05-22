<!-- Gebruik "include 'footer-main.php';" -->

<!DOCTYPE html>
<html>
<head>
    <title>Footer</title>
</head>
<body>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="logo.png" alt="Bedrijfslogo">
                <p>Korte tekst over het bedrijf</p>
            </div>
            <ul class="footer-links">
                <li><a href="privacybeleid.html">Privacybeleid</a></li>
                <li>|</li>
                <li><a href="algemene-voorwaarden.html">Algemene voorwaarden</a></li>
                <li>|</li>
                <li><a href="contact.html">Contact</a></li>
                <li>|</li>
                <li><a href="faq.html">Veelgestelde vragen</a></li>
            </ul>
        </div>
        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> Bedrijfsnaam. Alle rechten voorbehouden.
        </div>
    </footer>
</body>
</html>
<style>
footer {
    background-color: #f0f0f0;
    padding: 20px;
    text-align: center;
}

.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer-logo img {
    width: 100px;
    height: 100px;
}

.footer-links {
    list-style-type: none;
    display: flex;
    justify-content: center;
    align-items: center;
}

.footer-links li {
    margin-left: 10px;
}

.footer-links a {
    text-decoration: none;
    color: #333;
}

.footer-copyright {
    margin-top: 10px;
    font-size: 14px;
    color: #777;
}

</style>
