<div id="Overzicht" class="tabcontent">
    <h2>Overzicht</h2>
    <!-- HIER KOMEN ALLE COMPONENTS VOOR DE OVERZICHTSPAGINA'S -->
</div>

<div id="Accountsettings" class="tabcontent">
    <h2>Accountinstellingen</h2>
    <!-- HIER KOMEN ALLE COMPONENTS VOOR DE ACCOUNTSINSTELLINGEN -->
    <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/Vierkante-wielen/" . "include/Accountinstellingen-informatie.php");
    ?>
</div>

<div id="Meldingen" class="tabcontent">
    <h2>Meldingen</h2>
    <!-- HIER KOMEN ALLE COMPONENTS OM JE MELDINGEN TE ZIEN -->
    <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/Vierkante-wielen/" . "include/meldingen.php");
    ?>
</div>

<div id="LesToevoegen" class="tabcontent">
    <h2>Les Toevoegen</h2>
    <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/Vierkante-wielen/" . "pages/les_toevoegen.php");
    ?>
</div>

<div id="Upgrade" class="tabcontent">
    <h2>Upgrade</h2>
    <!-- HIER KOMEN ALLE COMPONENTS OM JE ACCOUNT TE UPGRADEN -->
</div>