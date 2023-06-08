<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <style>
      * {
        box-sizing: border-box
      }

      body {
        font-family: "Lato", sans-serif;
      }

      .layout {
        display: flex;
      }

      /* Style the tab */
      .tab {
        float: left;
        background-color: #f1f1f1;
        width: 30%;
        height: 70vh;
        border-radius: var(--border-rad);
      }

      /* Style the buttons inside the tab */
      .tab button {
        margin: unset;
        display: block;
        background-color: inherit;
        color: black;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ddd;
      }

      /* Create an active/current "tab button" class */
      .tab button.active {
        background-color: #ccc;
      }

      /* Style the tab content */
      .tabcontent {
        float: left;
        padding: 0px 12px;
        height: 300px;
      }
    </style>
  </head>

  <?php
  include_once("../components/header-admin.php");
  include_once("../include/db_conn.php");

  if (isset($_SESSION['gebruiker'])) {
    // User is logged in
  } else {
    header('location: loginpage.php');
  }
  ?>

  <body>




    <br><br><br><br>





    <div class="layout">
      <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Overzicht')" id="defaultOpen">Overzichtspagina</button>
        <button class="tablinks" onclick="openTab(event, 'Accountsettings')">Account Instellingen</button>
        <button class="tablinks" onclick="openTab(event, 'Meldingen')">Meldingen</button>
        <button class="tablinks" onclick="openTab(event, 'Upgrade')">Upgrade</button>
        <button class="tablinks" onclick="window.location='loginpage.php?loguit'">Log Uit</button>
      </div>

      <?php include_once("../components/sidebar_links.php") ?>
    </div>

    <script>
      function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
    </script>

  </body>

</html>