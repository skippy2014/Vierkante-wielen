<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <?php
  include_once '../components/header.php';

  if (isset($_SESSION['gebruiker'])) {
    // User is logged in
    $rol = $_SESSION['gebruiker']['rol'];
  } else {
    header('location: loginpage.php');
    exit(); // Make sure to exit after redirecting
  }


  // Controleer of de gebruiker de rol "instructeur" heeft
  $toonLesToevoegen = ($rol == "instructeur" || $rol == "eigenaar");
  $alleenLeerling = ($rol === "leerling");
  $alleenEigenaar = ($rol === "eigenaar");
  ?>

  <body>
    <div class="layout">
      <div class="tab">
        <?php
        $tabs = [
          ['Overzicht', 'Overzicht', true],
          ['Account Instellingen', 'Accountsettings', true],
          ['Les Toevoegen', 'LesToevoegen', $toonLesToevoegen],
          ['Meldingen', 'Meldingen', true],
          ['Abonnement', 'Subscription', $alleenLeerling],
          ['Leerlinglijst', 'Leerlinglijst', $alleenEigenaar],
          ['Werknemerslijst', 'Werknemerslijst', $alleenEigenaar],
          ['Ziek Melden', 'ZiekMelden', true],
          ['Register', 'Register', $alleenEigenaar],
        ];

        foreach ($tabs as [$label, $id, $visible]) {
          if (!$visible) {
            continue;
          }
          echo '<button class="tablinks" onclick="openTab(event, \'' . $id . '\')" id="' . $id . '_btn">' . $label . '</button>';
        }
        ?>
        <button class="tablinks" onclick="window.location='loginpage.php?loguit'">Log Uit</button>
      </div>
      <?php include_once '../components/sidebar_links.php'; ?>
    </div>

    <script>
      // Wait until document is fully loaded
      window.addEventListener("DOMContentLoaded", function () {
        const body = document.body;
        const html = document.documentElement;
        // Remove overflow property to restore scrolling
        body.style.overflow = "auto";

        // Scroll to top of page
        window.scrollTo(0, 0);

        // Initialize the page by opening the first tab or the tab specified in the hash
        const hash = window.location.hash.substring(1);
        var elemToClick = document.getElementById("Overzicht_btn");

        if (hash) {
          elemToClick = document.querySelector(".tablinks[id='" + hash + "_btn']");
        }

        elemToClick.click();
      });

      function openTab(evt, tabName) {
        const tabcontent = document.getElementsByClassName("tabcontent");
        for (let i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }

        const tablinks = document.getElementsByClassName("tablinks");
        for (let i = 0; i < tablinks.length; i++) {
          tablinks[i].classList.remove("active");
        }

        const elem = document.getElementById(tabName);
        elem.style.display = "block";
        evt.currentTarget.classList.add("active");
        document.documentElement.scrollTop = 0; // Scroll to the top of the page

        window.location.hash = tabName;
      }

      // Initialize an event listener for each button
      const buttonIds = [
        "LesToevoegen_btn",
        "Overzicht_btn",
        "Accountsettings_btn",
        "Meldingen_btn",
        "Subscription_btn",
        "Leerlinglijst_btn",
        "Werknemerslijst_btn",
        "ZiekMelden_btn",
        "Register_btn",
      ];

      buttonIds.forEach((btnId) => {
        document.getElementById(btnId).addEventListener("click", function () {
          window.location.hash = btnId.substring(0, btnId.lastIndexOf("_"));
        });
      });


      // Update tab content when URL hash changes
      window.addEventListener("hashchange", function () {
        const hash = window.location.hash.substring(1);
        if (hash) {
          document.querySelector(".tablinks[id='" + hash + "_btn']").click();
        }
      });
    </script>
  </body>



</html>