<!-- VRAGEN: line 24: nieuwe les aanpassen? en inplannen? waarheen linken?
huidige datum liever vierkant of rond?
line 130 stylen weken?? regelen? 
ik heb de knop vandaag gemaakt via het reloaden van de pagina is dit mogelijk ivm andere dingen op de pagina?
waarom button pointer te ver les knop?-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
  </head>
  <body>
    <div class="KalenderHeel">
   <div class="kalenderBox">  
      <header>
   
        <div class="pijltjes">
          <div class="vandaagButton">
      <button onclick="location.reload()">Vandaag</button>
      </div>
      <span id=linksL  class="pijltje "><</span> 
          <p class="Huidige-Datum"></p>
          <span id= rechts class="pijltje">></span>
          <div class="lesButton">
          <a href="pages/nieuwe_les_inplannen.php"> <button>Les inplannen</button><a>
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
  </body>
</html>
<script>
const Dag1 = document.querySelector(".dagen"),
huidigeDag1 = document.querySelector(".Huidige-Datum"),
pijltjeLR = document.querySelectorAll(".pijltjes span");
let datum = new Date(),
HuidigeJaar = datum.getFullYear(),
HuidigeMaand = datum.getMonth();
const maanden = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];
const reloadKalender = () => {
    let EersteDagMaand = new Date(HuidigeJaar, HuidigeMaand, 1).getDay(), 
    LaatsteDataMaand = new Date(HuidigeJaar, HuidigeMaand + 1, 0).getDate(), 
    LaatstedagMaand = new Date(HuidigeJaar, HuidigeMaand, LaatsteDataMaand).getDay(), 
    LdatumVMaand = new Date(HuidigeJaar, HuidigeMaand, 0).getDate(); 
    let li1 = "";
    for (let i = EersteDagMaand; i > 0; i--) {
        li1 += `<li class="inactief">${LdatumVMaand - i + 1}</li>`;}
    for (let i = 1; i <= LaatsteDataMaand; i++) { 
        let vandaag = i === datum.getDate() && HuidigeMaand === new Date().getMonth() 
     && HuidigeJaar === new Date().getFullYear() ? "actief" : "";
        li1 += `<li class="${vandaag}">${i}</li>`; }
    for (let i = LaatstedagMaand; i < 6; i++) {
        li1 += `<li class="inactief">${i - LaatstedagMaand + 1}</li>` }
    huidigeDag1.innerText = `${maanden[HuidigeMaand]} ${HuidigeJaar}`; 
    Dag1.innerHTML = li1;}
reloadKalender();
pijltjeLR.forEach(icon => { 
    icon.addEventListener("click", () => { 
      HuidigeMaand = icon.id === "linksL" ? HuidigeMaand - 1 : HuidigeMaand + 1;    
      // hieronder zit een fout

      if(HuidigeMaand < 0 || HuidigeMaand > 11) {   
   datum = new Date (HuidigeJaar, HuidigeMaand, new Date().getDate());
            HuidigeJaar = datum.getFullYear(); 
            HuidigeMaand = datum.getMonth(); 
        } else {datum = new Date();}
        reloadKalender(); 
    });
});

        </script>


<!--  geheugensteuntje:
  li1 = " " tagjes
LdatumVMaand = laatste datum vorige maand 
actief= vandaag en inactief is elke andere dag.
-->
<style>

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family:sans-serif;
  }

.kalenderBox{
  width: 700px;
  background: #F2F2F2;
}

.KalenderHeel{
  display: flex;
  align-items: center;
justify-content: center;
  min-height: 110vh;
}

.kalenderBox header{
  display: flex;
  align-items: center;
  padding: 15px 20px 10px;
  justify-content: space-between;
  background-color:#E7E7E7;
 }

.Huidige-Datum{
  padding-left:4vw;
  padding-right:3vw;
}


/* .weeks{
  background-color:#EBEBEB;
} */


header .pijltjes{
  display: flex;
  align-items: center;
   font-size: 27px;
    color:#100;
}

.pijltje {
  cursor: pointer;
}

.vandaagButton button{
  background-color: rgb(255,255,255);
   color: black;
   font-size: 20px;
   border: none;
   border-radius: 11px;
   box-shadow: 4px 4px 11px #00000029;
   padding:  0.4vw 1.5vh;
   cursor: pointer;
   margin-right:3.5vw;
}

.lesButton button{
  background-color: rgb(148, 6, 6);
  color: white;
   font-size: 20px;
   border: none;
   border-radius: 11px;
   box-shadow: 4px 4px 11px #00000029;
   padding:  0.4vw 1.5vh;
   cursor: pointer;
   margin-left:3.5vw;
 }






header .Huidige-Datum{
 font-size: 27px;


}
.kalender{
  padding: 20px;
}

.kalender li{
  width: calc(100% / 7);  /* maakt 7 vakjes NIET veranderen */
  font-size: 20px;
}

.kalender ul{
  text-align: center;
  display: flex;
  flex-wrap: wrap;
list-style: none;
}
.kalender .dagen{
  margin-bottom: 17px;
}

.kalender .dagen li{
  z-index: 1;
  cursor: pointer;
  position: relative;
  margin-top: 28px;
}
.dagen li.inactief{
  color:#878787;
}
.dagen li.actief{
 color: #fff;           
}

 .dagen li::before{         /* huidige datum vakje */
  position: absolute;
  content: "";  
  left: 50%;
  top: 50%;
  height: 40px;
  width: 40px;
  z-index: -1;
 border-radius: 15%;               /*  border Rond= 50% */
  transform: translate(-50%, -50%);
}
.dagen li.actief::before{
  background:#878787 ;
}
.dagen li:not(.actief):hover::before{      /* Geheugensteuntje:  gebruik not voor stijlen zonder de klas(..)  */
  background: #f2f2f2;
}                                 
                                
                                        


</style>
        </html>
 
   
    