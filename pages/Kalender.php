<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalender</title>
  <link rel="stylesheet" href="kalender.css">
</head>
<body>
  <div class="KalenderHeel">
    <div class="kalenderBox">  
      <header>
        <div class="pijltjes">
          <div class="vandaagButton">
            <button onclick="location.reload()">Vandaag</button>
          </div>
          <span id="linksL" class="pijltje"><</span> 
          <p class="Huidige-Datum"></p>
          <span id="rechts" class="pijltje">></span>
          <div class="lesButton">
            <button><a href="/pages/nieuwe_les_inplannen.php">Les aanmaken</a></button>
          </div>
        </div>
      </header>
      <div class="kalender">
        <ul class="weeks">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>
        <ul class="dagen"></ul>
      </div>
    </div>
  </div>

  <script>
    const Dag1 = document.querySelector(".dagen");
    const huidigeDag1 = document.querySelector(".Huidige-Datum");
    const pijltjeLR = document.querySelectorAll(".pijltjes span");
    let datum = new Date();
    let HuidigeJaar = datum.getFullYear();
    let HuidigeMaand = datum.getMonth();
    const maanden = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ];

    const reloadKalender = () => {
      let EersteDagMaand = new Date(HuidigeJaar, HuidigeMaand, 1).getDay();
      let LaatsteDataMaand = new Date(HuidigeJaar, HuidigeMaand + 1, 0).getDate();
      let LaatstedagMaand = new Date(HuidigeJaar, HuidigeMaand, LaatsteDataMaand).getDay();
      let LdatumVMaand = new Date(HuidigeJaar, HuidigeMaand, 0).getDate();
      let li1 = "";

      for (let i = EersteDagMaand; i > 0; i--) {
        li1 += `<li class="inactief">${LdatumVMaand - i + 1}</li>`;
      }

      for (let i = 1; i <= LaatsteDataMaand; i++) {
        let vandaag = i === datum.getDate() && HuidigeMaand === new Date().getMonth() && HuidigeJaar === new Date().getFullYear() ? "actief" : "";
        li1 += `<li class="${vandaag}"><div class="day-wrapper" onclick="showPopup('Les', '${maanden[HuidigeMaand]} ${i}')">${i}</div></li>`;
      }

      for (let i = LaatstedagMaand; i < 6; i++) {
        li1 += `<li class="inactief">${i - LaatstedagMaand + 1}</li>`;
      }

      huidigeDag1.innerText = `${maanden[HuidigeMaand]} ${HuidigeJaar}`; 
      Dag1.innerHTML = li1;
    };

    reloadKalender();

    pijltjeLR.forEach(icon => {
      icon.addEventListener("click", () => {
        HuidigeMaand = icon.id === "linksL" ? HuidigeMaand - 1 : HuidigeMaand + 1;

        if (HuidigeMaand < 0 || HuidigeMaand > 11) {
          datum = new Date(HuidigeJaar, HuidigeMaand, new Date().getDate());
          HuidigeJaar = datum.getFullYear();
          HuidigeMaand = datum.getMonth();
        } else {
          datum = new Date();
        }

        reloadKalender();
      });
    });

    function showPopup(les, datum) {
      var popup = document.createElement('div');
      popup.className = 'popup';
      popup.innerHTML = '<div class="popup-content">' +
        '<h3>Melding</h3>' +
        '<p><strong>Bericht:</strong> ' + les + '</p>' +
        '<p><strong>Datum:</strong> ' + datum + '</p>' +
        '<button class="popup-close" onclick="closePopup()">Sluiten</button>' +
        '</div>';
      document.body.appendChild(popup);
    }

    function closePopup() {
      var popup = document.querySelector('.popup');
      if (popup) {
        popup.remove();
      }
    }
  </script>

  <?php
  // Maak de databaseverbinding
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "vierkantewielendemo";

  $conn = new mysqli($servername, $username, $password, $database);

  // Controleer de verbinding
  if ($conn->connect_error) {
      die("Database connection failed: " . $conn->connect_error);
  }

  // Haal de lessen op voor de huidige gebruiker
  session_start(); // Start de sessie
  $ingelogdeGebruikerId = $_SESSION['gebruiker']['id_gebruiker']; // Haal het ingelogde gebruiker ID op
  $sql = "SELECT * FROM les WHERE id_gebruiker = $ingelogdeGebruikerId";
  $result = $conn->query($sql);

  // Verwerk de resultaten en voeg de lesinformatie toe aan de kalender
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $lesDatum = strtotime($row['datum_tijd']);
          $lesDag = date('j', $lesDatum);
          $lesMaand = date('n', $lesDatum) - 1; // Verlaag de maand met 1 om te compenseren voor nulindexering in JavaScript
          $lesJaar = date('Y', $lesDatum);

          // Voeg een extra class toe aan de agenda-items voor de lesdagen
          echo "<script>document.querySelector(`.dagen li:nth-child($lesDag)`).classList.add('les-dag');</script>";
      }
  }

  // Sluit de databaseverbinding
  $conn->close();
  ?>

</body>
</html>
