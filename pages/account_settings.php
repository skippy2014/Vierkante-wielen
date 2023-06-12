<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>



  <?php
  include_once '../components/header.php';


  if (isset($_SESSION['gebruiker']) && ($_SESSION['gebruiker']['rol'] === 'instructeur' || $_SESSION['gebruiker']['rol'] === 'eigenaar')) {

    echo '<div> div </div>';

  }

  if (isset($_SESSION['gebruiker'])) {
    // User is logged in
    $rol = $_SESSION['gebruiker']['rol'];
  } else {
    header('location: loginpage.php');
  }

  // Controleer of de gebruiker de rol "instructeur" heeft
  $toonLesToevoegen = ($rol == "instructeur");
  ?>

  <body>
    <br><br><br><br>
    <div class="layout">
      <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Overzicht')" id="Overzicht_btn">Overzichtspagina</button>
        <button class="tablinks" onclick="openTab(event, 'Accountsettings')" id="Accountsettings_btn">Account
          Instellingen</button>
        <button class="tablinks" onclick="openTab(event, 'LesToevoegen')" <?php if (!$toonLesToevoegen)
          echo 'style="display:none"'; ?> id="LesToevoegen_btn">Les toevoegen</button>
        <button class="tablinks" onclick="openTab(event, 'Meldingen')" id="Meldingen_btn">Meldingen</button>
        <button class="tablinks" onclick="openTab(event, 'Upgrade')" id="Upgrade_btn">Upgrade</button>
        <button class="tablinks" onclick="window.location='loginpage.php?loguit'">Log Uit</button>
      </div>

      <?php include_once("../components/sidebar_links.php") ?>
    </div>

    <script>
      // Wait until document is fully loaded
      document.addEventListener("DOMContentLoaded", function () {
        // Remove overflow property to restore scrolling
        document.body.style.overflow = "auto";

        // Scroll to top of page
        window.scrollTo(0, 0);
      });
      function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
        document.documentElement.scrollTop = 0; // Scroll to the top of the page
      }

      // Initialize the page by opening the first tab or the tab specified in the hash
      var hash = window.location.hash.substring(1);
      if (hash) {
        document.querySelector(".tablinks[id='" + hash + "_btn']").click();
      } else {
        document.getElementById("Overzicht_btn").click();
      }

      // Initialize an event listener for each button
      document.getElementById("LesToevoegen_btn").addEventListener("click", function () {
        window.location.hash = "LesToevoegen";
      });
      document.getElementById("Overzicht_btn").addEventListener("click", function () {
        window.location.hash = "Overzicht";
      });
      document.getElementById("Accountsettings_btn").addEventListener("click", function () {
        window.location.hash = "Accountsettings";
      });
      document.getElementById("Meldingen_btn").addEventListener("click", function () {
        window.location.hash = "Meldingen";
      });
      document.getElementById("Upgrade_btn").addEventListener("click", function () {
        window.location.hash = "Upgrade";
      });

      // Update tab content when URL hash changes
      window.addEventListener("hashchange", function () {
        var hash = window.location.hash.substring(1);
        if (hash) {
          document.querySelector(".tablinks[id='" + hash + "_btn']").click();
        }
      });
    </script>

  </body>

</html>