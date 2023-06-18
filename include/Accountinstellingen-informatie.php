<?php

if (isset($_SESSION["gebruiker"])) {
    echo '<ul style="list-style-type: none; font-size: 24px; font-family: Arial; color: #333;" class="informatie"><li><h3>Persoonlijke informatie</h3></li>';

    foreach ($_SESSION["gebruiker"] as $gebruiker => $rol) {
        echo "<li style='color: #777; display: flex; justify-content: space-between;'><span><strong>{$gebruiker}:</strong></span><span><p>{$rol}</p></span></li>";
    }

    echo "</ul>";
}
?>
<label>
    <input type="checkbox" name="passwordOptions">
    Show password
</label>

<script>
    const checkbox = document.querySelector('input[name="passwordOptions"]');
    const input = document.querySelector('.informatie li:nth-child(6) *:not(span, span strong)');

    checkbox.addEventListener('change', function () {
        input.style.webkitTextSecurity = checkbox.checked ? 'none' : 'disc';
        if (checkbox.checked) {
            input.style.maxWidth = 'unset';
            input.style.overflowWrap = 'anywhere';
            input.style.textWrap = 'wrap';
        } else {
            input.style.maxWidth = '10vw';
            input.style.overflowWrap = 'unset';
            input.style.textWrap = 'unset';
        }
    });

</script>