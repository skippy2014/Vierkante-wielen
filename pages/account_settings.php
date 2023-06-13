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
    exit;
  }

  // Boolean variables for showing/hiding tabs based on user role
  $toonLesToevoegen = ($rol == "instructeur" || $rol == "eigenaar");
  $alleenLeerling = ($rol === "leerling");
  $alleenEigenaar = ($rol === "eigenaar");
  ?>

  <body>
    <br><br><br><br>
    <div class="layout">
      <div class="tab">
        <!-- Use a loop to generate tab buttons instead of repeating the code -->
        <?php foreach ([['name' => 'Overzichtspagina', 'id' => 'Overzicht', 'hidden' => false], ['name' => 'Account Instellingen', 'id' => 'Accountsettings', 'hidden' => false], ['name' => 'Les toevoegen', 'id' => 'LesToevoegen', 'hidden' => !$toonLesToevoegen], ['name' => 'Meldingen', 'id' => 'Meldingen', 'hidden' => false], ['name' => 'Update', 'id' => 'Update', 'hidden' => !$alleenLeerling], ['name' => 'LeerlingLijst', 'id' => 'LeerlingLijst', 'hidden' => !$alleenEigenaar], ['name' => 'WerknemersLijst', 'id' => 'WerknemersLijst', 'hidden' => !$alleenEigenaar], ['name' => 'Register', 'id' => 'Register', 'hidden' => !$alleenEigenaar],] as $tab): ?>
          <button class="tablinks" onclick="openTab(event, '<?= $tab['id'] ?>')" <?= $tab['hidden'] ? 'style="display:none" ' : '' ?> id="<?= $tab['id'] ?>_btn"><?= $tab['name'] ?></button>
        <?php endforeach; ?>

        <button class="tablinks" onclick="window.location='loginpage.php?loguit'">Log Uit</button>
      </div>

      <?php include_once("../components/sidebar_links.php") ?>
    </div>
  </body>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.body.style.overflow = "auto";
      window.scrollTo(0, 0);
    });


    function openTab(evt, tabName) {
      const hideTabs = (query) => document.querySelectorAll(query).forEach(el => el.style.display = "none");
      hideTabs('.tabcontent');
      document.getElementById(tabName).style.display = "block";

      const tablinks = document.getElementsByClassName("tablinks");
      for (let link of tablinks) link.classList.remove('active');
      evt.currentTarget.classList.add("active");

      document.documentElement.scrollTop = 0;
    }


    window.addEventListener("load", function () {
      document.getElementById("Overzicht_btn").click();
    });

    const buttons = ['LesToevoegen', 'Overzicht', 'Accountsettings', 'Meldingen', 'Upgrade', 'LeerlingLijst', 'WerknemersLijst', 'Register'];
    for (let btn of buttons) {
      document.getElementById(`${btn}_btn`).addEventListener('click', function () {
        window.location.hash = btn;
      });
    }

    window.addEventListener("hashchange", function () {
      var hash = window.location.hash.substring(1);
      if (hash) {
        document.querySelector(`.tablinks[id='${hash}_btn']`).click();
      }
    });

  </script>


</html>