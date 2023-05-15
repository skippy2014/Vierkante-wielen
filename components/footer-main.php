<!-- Gebruik "include 'footer-main.php';" -->

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/footer-main.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
