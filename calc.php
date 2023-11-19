<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محاسبه زمان کار</title>
    <link rel="stylesheet" href="https://www.japoo.ir/filez/fonts/iran-sans.css">
    <style>
        body {
            font-family: 'IRANSans';
            background-image: url("https://my.bmi.ir/portalserver/static/ibank/widgets/bmi-change-background-random/data/images/7.jpg");
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input, select {
            padding: 10px;
            font-size: 16px;
        }

        p {
            margin: 20px 0 0;
            font-size: 18px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>محاسبه زمان کار</h2>
        
        <form method="post" action="">
            <label for="entryTime">زمان ورود خود را وارد کنید:</label>
            <input type="time" id="entryTime" name="entryTime" required>
            <br>
            <label style="padding-top:20px" for="workHours">ساعات کاری:</label>
            <select id="workHours" name="workHours">
                <option style="font-family: IRANSans" value="7.5">7:30 ساعت</option>
                <option style="font-family: IRANSans" value="8.5">8:30 ساعت</option>
                <option style="font-family: IRANSans" value="9.5">9:30 ساعت</option>
            </select>
            <br>
            <input style="font-family: IRANSans;margin-top:20px" type="submit" value="محاسبه">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $entryTime = $_POST["entryTime"];
            $workHours = $_POST["workHours"];
            $leaveTime = calculateLeavingTime($entryTime, $workHours);
            echo "<p>زمان خروج: $leaveTime</p>";
        }
        
        function calculateLeavingTime($entryTime, $workHours) {
            // Convert entry time to DateTime object
            $entryDateTime = new DateTime($entryTime);

            // Extract integer part for hours and decimal part for minutes
            $hours = floor($workHours);
            $minutes = ($workHours - $hours) * 60;

            // Add specified work hours and minutes to entry time
            $leaveDateTime = $entryDateTime->add(new DateInterval("PT{$hours}H{$minutes}M"));

            // Format the result to Persian time
            $persianLeaveTime = $leaveDateTime->format('H:i');

            return $persianLeaveTime;
        }
        ?>
    </div>
</body>
</html>
