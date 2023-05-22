<form method="post" action="post_lessons.php">
    <label for="firstName">Voornaam:</label>
    <input type="text" name="first_name" id="firstName" required><br><br>


    <label for="lastName">Achternaam:</label>
    <input type="text" name="last_name" id="lastName" required><br><br>

    <label for="lessonDate">Les Datum:</label>
    <input type="date" name="lesson_date" id="lessonDate" required><br><br>
    <label for="lessonTime">tijd:</label>
    <input type="time" name="lesson_time" id="lessonTime" required><br><br>

    <label for="lessonAddress">adress:</label>
    <input type="text" name="street_address" id="lessonAddress" required><br><br>

    <label for="lessonPostcode">postcode</label>
    <input type="text" name="postcode" id="lessonPostcode" required><br><br>

    <label for="lessonGoal">les doel</label>
    <input type="text" name="sesson_goal" id="lessonGoal" required><br><br>

    <input type="submit" value="Submit">
</form>