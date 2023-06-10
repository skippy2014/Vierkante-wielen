<?php

echo "Welkom" . " " . $_SESSION["gebruiker"]["rol"];


$date = date('l'); // get the day of the week in English
$days = array(
    'Monday' => 'Maandag',
    'Tuesday' => 'Dinsdag',
    'Wednesday' => 'Woensdag',
    'Thursday' => 'Donderdag',
    'Friday' => 'Vrijdag',
    'Saturday' => 'Zaterdag',
    'Sunday' => 'Zondag'
); // create an array to translate the day of the week
$translated_day = $days[$date]; // lookup the translated day in the array
echo "<br>
Vandaag is het " . $translated_day; // display the translated day
