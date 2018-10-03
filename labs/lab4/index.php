<?php
    $backgroundImage = "img/sea.jpg";
    // API call goes here
    if (isset($_GET['keyword'])) {
        include "api/pixabayAPI.php";
        $keyword = $_GET['keyword'];
        $imageURLs = getImageURLs($keyword, $_GET['orientation']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    
    function formIsValid() {
        if (empty($_GET['keyword']) && empty($_GET['category'])) {
            echo "<h2> Please enter a keyword and/or a category!</h2>";
            return false;
        }
        return true;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <style> 
            body {
                background-image: url('<?=$backgroundImage?>');
                background-size: cover;
            }
        </style>
    </head>
    
    <body>
        <br /> <br />
        <form method="GET">
            <input type="text" name="keyword" placeholder="Keyword">
            <input type="radio" name="orientation" value="horizontal">Horizontal
            <input type="radio" name="orientation" value="vertical">Vertical
            <select name="category">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option value="forest">Forest</option>
                <option value="mountain">Mountain</option>
                <option value="snow">Snow</option>
            </select>
            <input type="submit" value="Submit" />
        </form>
        
        <br />  <br />
        <?php
            if(isset($imageURLs) && formIsValid()) {
        ?>
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <?php
                    for ($i = 1; $i < 7; ++$i) {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'></li>";
                    }
                ?>
            </ol>
            
            <div class="carousel-inner">
                <?php
                    for ($i = 0; $i < 7; ++$i) {
                        do {
                            $randomIndex = array_rand($imageURLs);
                        }
                        while (!isset($imageURLs[$randomIndex]));
                        
                        echo "<div class=\"carousel-item ";
                        echo ($i==0) ? "active" : "";
                        echo "\">";
                        echo "<img class=\"d=block w-100\" src=\"" . $imageURLs[$randomIndex] . "\" alt=\"Second slide\">";
                        echo "</div>";
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
            </div>
        
            <!-- Controls here -->
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            
        </div>
        
        <?php
            }
            else {
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
        ?>
        <br />  <br />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>