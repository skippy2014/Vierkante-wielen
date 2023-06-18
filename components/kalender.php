<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vierkantewielendemo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Verbinding met de database mislukt: " . $conn->connect_error);
}

$lessen = [];

if (isset($_SESSION["gebruiker"]["id_gebruiker"])) {
  $id_gebruiker = $_SESSION["gebruiker"]["id_gebruiker"];

  $sql = "SELECT datum_tijd, lesdoel, adres FROM les WHERE id_gebruiker = ? OR id_instructeur = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id_gebruiker, $id_gebruiker);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $lessen[] = $row;
    }
  }
}

$conn->close();

$lessenJSON = json_encode($lessen);
?>

<div class="KalenderHeel">
  <div class="kalenderBox">
    <header>
      <div class="pijltjes">
        <span id="linksL" class="pijltje">&lt;</span>
        <p class="Huidige-Datum" onclick="location.reload()"></p>
        <span id="rechts" class="pijltje">&gt;</span>
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

<div id="popupBackground" class="popup-background"></div>
<div id="popup" class="les-popup">
  <div>
    <p id="lesdag"></p>
    <p id="lestijd"></p>
    <p id="adres"></p>
    <p id="lesdoel"></p>
  </div>
  <div><button id="closeButton"></button></div>
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

  const lessen = <?php echo $lessenJSON; ?>;

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
      let lesInformatie = "";

      lessen.forEach(les => {
        let lesDatum = new Date(les.datum_tijd);
        let lesDag = lesDatum.getDate();
        let lesMaand = lesDatum.getMonth();
        let lesJaar = lesDatum.getFullYear();

        if (lesDag === i && lesMaand === HuidigeMaand && lesJaar === HuidigeJaar) {
          let lesDoel = les.lesdoel;
          let lesAdres = les.adres;
          lesInformatie = `<div class="les-popup">
                              <p>Lesdoel: ${lesDoel}</p>
                              <p>Adres: ${lesAdres}</p>
                              <p>Lesdag: ${lesDag}/${lesMaand}/${lesJaar}</p>
                            </div>`;
        }
      });

      let lesDagHTML = `<li class="${vandaag}${lesInformatie !== '' ? ' rode-dag' : ''}">
                    <div class="day-wrapper">${i}</div>
                  </li>`;

      li1 += lesDagHTML;
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

  function toonLesPopup(dag) {
    const popup = document.getElementById("popup");
    const popupBackground = document.getElementById("popupBackground");
    const closeButton = document.getElementById("closeButton");
    const lesdoel = document.getElementById("lesdoel");
    const adres = document.getElementById("adres");
    const lesdag = document.getElementById("lesdag");
    const lestijd = document.getElementById("lestijd");

    const geselecteerdeLes = lessen.find(les => {
      const lesDatum = new Date(les.datum_tijd);
      const lesDag = lesDatum.getDate();
      const lesMaand = lesDatum.getMonth();
      const lesJaar = lesDatum.getFullYear();
      return lesDag === dag && lesMaand === HuidigeMaand && lesJaar === HuidigeJaar;
    });

    if (geselecteerdeLes) {
      lesdoel.textContent = `Les doel: ${geselecteerdeLes.lesdoel}`;
      adres.textContent = `Adres: ${geselecteerdeLes.adres}`;
      lesdag.textContent = `Les dag: ${dag}/${HuidigeMaand}/${HuidigeJaar}`;

      const lesDatum = new Date(geselecteerdeLes.datum_tijd);
      const uren = lesDatum.getHours().toString().padStart(2, "0");
      const minuten = lesDatum.getMinutes().toString().padStart(2, "0");
      const lestijdTekst = `${uren}:${minuten}`;
      lestijd.textContent = `Les tijd: ${lestijdTekst}`;

      popup.style.display = "flex";
      popupBackground.style.display = "block";
    }
  }

  document.addEventListener("click", function (event) {
    const dagWrapper = event.target.closest(".day-wrapper");
    if (dagWrapper) {
      const dag = parseInt(dagWrapper.textContent);
      toonLesPopup(dag);
    }

    const popupBackground = document.getElementById("popupBackground");
    if (event.target === popupBackground) {
      const popup = document.getElementById("popup");
      popup.style.display = "none";
      popupBackground.style.display = "none";
    }
  });

  const closeButton = document.getElementById("closeButton");
  closeButton.addEventListener("click", function () {
    const popup = document.getElementById("popup");
    const popupBackground = document.getElementById("popupBackground");
    popup.style.display = "none";
    popupBackground.style.display = "none";
  });
</script>