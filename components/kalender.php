<?php
// Query om lessen op te halen
$sql = "SELECT datum_tijd, lesdoel, adres FROM les";
$result = $connection->query($sql);

// Array maken om de lessen op te slaan
$lessen = array();

if ($result->num_rows > 0) {
  // Gegevens van elke les in de array opslaan
  while ($row = $result->fetch_assoc()) {
    $lessen[] = $row;
  }
}

// Lessenarray omzetten naar JSON-string
$lessenJSON = json_encode($lessen);
?>


<div class="KalenderHeel">
  <div class="kalenderBox">
    <header>
      <div class="pijltjes">
        <span id="linksL" class="pijltje">
          < </span>
            <p class="Huidige-Datum" onclick="location.reload()"></p>
            <span id="rechts" class="pijltje">></span>
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

  // Lessenarray ophalen uit PHP
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

      // Loop door de lessenarray en controleer op overeenkomende datums
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
                            ${lesInformatie}
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
</script>