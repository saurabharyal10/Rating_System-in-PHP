<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="popup.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>

<body style="background-color: #3e3f3f;">

    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;
            </div>
            <h1>Rate the Site</h1>
            <div class="container">
                <div class="row">

                    <form action="final.php" method="post">
                        <div style="margin-top: 20px; margin-left: -16.8vw;">
                            <label>Name</label>
                            <input type="text" name="name" style="margin-left: 20px;">
                        </div>

                        <div style="margin-top: 10px; margin-left: 40px;">
                            <label style="float: left; margin-left: 24px;">Review</label>
                            <!-- <input type="text" name="review" style="margin-left: 15px;"> -->
                            <textarea name="review" cols="70" rows="5" style="margin-left: 15px;"></textarea>
                        </div>

                        <div style="margin-left: 16vw;" class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
                        </div>

                        <span class='result'>0</span>
                        <input type="hidden" name="rating">

                </div>


                <div style="position: absolute; bottom: 5px; right: 7px;">
                    <input type="submit" name="add" style="background-color: green; color: white; border-radius: 10px; width: 120px; height: 36px;">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <button onclick="togglePopup()" style="position: absolute; top: 50%; left: 48%;">Rate the Package</button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $(function() {
            $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('Rating :' + rating);
                $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            });
        });
    </script>
    <script>
        function togglePopup() {
            document.getElementById("popup-1").classList.toggle("active");
        }
    </script>
</body>

</html>
<?php
require 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];

    $sql = "INSERT INTO tbl_ratings (name,rate,review) VALUES ('$name','$rating','$review')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New Rate added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>