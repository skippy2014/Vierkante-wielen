<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Vierkanten Wielen</title>
</head>
 <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ccc;
            margin-right: 20px;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            font-size: 24px;
            margin: 0;
        }

        .profile-info p {
            margin: 0;
            color: #888;
        }

        .profile-info a {
            color: #333;
            text-decoration: none;
        }

        .profile-about {
            margin-bottom: 20px;
        }

        .profile-about h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-about p {
            margin: 0;
            color: #555;
        }
    </style>
<body>

<h2>Welkom Instructeurs</h2>

<?php 
setlocale(LC_TIME, "nl_NL");
echo strftime(" Vandaag is het %A");
?>
<br>
    <div class="container">
        <div class="profile-header">
            <div class="profile-picture"></div>
            <div class="profile-info">
                <h1>Naam</h1>
                <p>Email: </p>
                <p>Leeftijd: 30</p>
            </div>
        </div>

        <div class="profile-about">
            <h2>Over</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere bibendum elit, et sempeir elit aliquam eu. Fusce tincidunt fermentum velit, a consequat lacus bibendum in. Donec eleifend, velit id efficitur commodo, enim ligula egestas sem, at iaculis nisi nunc et ex.</p>
        </div>


    </div>

<a href="ziekmelden.php"><button>Afmelden</button></a><br>
<a href="nieuwe_les_inplannen.php"><button>Nieuwe les inplannen</button></a>

</body>
</html>