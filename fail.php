<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failed Transaction</title>
</head>
<body>
    <h1>Payment Unsuccessful</h1>
    <p>Redirect to home page in <strong id="count">5</strong> seconds.</p>

    <script>
        var sec = 5;

        setInterval(function() {
            count = sec--;
            document.querySelector("#count").textContent = count;

            if(count < 1) {
                location.href = "student/student-home-page.php";
            }
        }, 1000);
    </script>
</body>
</html>