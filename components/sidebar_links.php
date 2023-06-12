<div id="Overzicht" class="tabcontent">
    <h2>Overzicht</h2>
    <!-- HIER KOMEN ALLE COMPONENTS VOOR DE OVERZICHTSPAGINA'S -->
    <?php
    include_once "../include/overzicht-informatie.php";
    ?>
</div>

<div id="Accountsettings" class="tabcontent">
    <h2>Accountinstellingen</h2>
    <!-- HIER KOMEN ALLE COMPONENTS VOOR DE ACCOUNTSINSTELLINGEN -->
    <?php
    include_once "../include/accountinstellingen-informatie.php";
    ?>
</div>

<div id="Meldingen" class="tabcontent">
    <h2>Meldingen</h2>
    <!-- HIER KOMEN ALLE COMPONENTS OM JE MELDINGEN TE ZIEN -->
    <?php
    include_once "../include/meldingen-informatie.php";
    ?>
</div>

<div id="LesToevoegen" class="tabcontent">
    <h2>Les Toevoegen</h2>
    <?php
    include_once "../pages/les_toevoegen.php";
    ?>
</div>

<div id="Upgrade" class="tabcontent">
    <h2>Upgrade</h2>
    <!-- HIER KOMEN ALLE COMPONENTS OM JE ACCOUNT TE UPGRADEN -->
</div>

<div id="LeerlingLijst" class="tabcontent">
    <h2>Leerlingen Lijst</h2>
    <?php
    include_once "../components/leerlingen-list.php";
    ?>
    <!-- HIER KOMEN ALLE COMPONENTS OM account aantemaken -->
</div>

<div id="WerknemersLijst" class="tabcontent">
    <h2>WerknemersLijst Lijst</h2>
    <?php
    include_once "../components/werknemers_list.php";
    ?>
    <!-- HIER KOMEN ALLE COMPONENTS OM account aantemaken -->
</div>



<div id="Register" class="tabcontent">
    <h2>Register werknemer</h2>
    <?php
    include_once "../components/register-instructeur.php";
    ?>
    <!-- HIER KOMEN ALLE COMPONENTS OM account aantemaken -->
</div>