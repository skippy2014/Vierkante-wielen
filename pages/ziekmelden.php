 <?php require_once "../include/db_conn.php"; ?>
 
  
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Vierkanten Wielen</title>
    </head>
    <body>


    <h2>Afmelden</h2>
<form method="POST" action="">
    <label for="reden_afmelding">Reden voor afmelding *:</label>
    <select name="reden_afmelding" id="reden_afmelding" onchange="toggleReasonField()">
        <option value="ziek">Ziek</option>
        <option value="anders">Anders</option>
    </select><br>

    <div id="anders_reason" style="display: none;">
        <label for="anders_reden">Specificeer de reden:</label>
        <input type="text" id="anders_reden" name="anders_reden"><br><br>
    </div>

    <label for="welke_dag">Welke dag? *:</label>
    <input type="date" id="welke_dag" name="welke_dag" required><br><br>

    <button type="submit" name="submit">Verstuur</button>
</form>

<script>
    function toggleReasonField() {
        var selectElement = document.getElementById("reden_afmelding");
        var reasonField = document.getElementById("anders_reason");
        if (selectElement.value === "anders") {
            reasonField.style.display = "block";
        } else {
            reasonField.style.display = "none";
        }
    }
</script>




    </body>
    <style>

 







    </style>
    </html>