
<?php
    include "../../../inc/dbConnection.php";
    $dbConn = startConnection('c9');
    
    function getAllPets() {
        global $dbConn;
        
        $sql = "SELECT id, name, type FROM pets
                    ORDER BY name ASC";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        
        <style>
            body {
                text-align: center;
            }
        </style>
    </head>
    
    <body>
	    <?php
	        include 'inc/header.php'
	    ?>
        
        <script>
            $('document').ready(function() {
                $('.petLink').click(function() {
                    
                    $('#container').html("<img src='img/loading.gif' >");
                    $('#petModal').modal("show");
                    
                    $.ajax({
                        
                        type: "GET",
                        url: "api/getPetInfo.php",
                        dataType: "json",
                        data: { 'petId': $(this).attr('id') },
                        success: function(data, status) {
                            $('#petName').html(data.name);
                            $('#petImage').attr('src', 'img/'+data.pictureURL);
                            $('#petDescription').html(data.description);
                            $('#container').html("");
                            //alert(data);
                        },
                    }); // ajax
                    
                }); // petLink.click
            }); // document.ready
        </script>
        
        <?php
            $pets = getAllPets();
            if (is_array($pets)) {
                foreach($pets as $p) {
                    echo "<ul><li>Name: <a href='#' class='petLink' id='" . $p['id'] . "'>" . $p['name'] . "</a></li>";
                    echo "<li>Type: " . $p['type'] . "</li></ul>";
                }
            }
        ?>
        
        <!-- Modal -->
        <div class='modal fade' id='petModal' tabindex='-1' role='dialog' aria-balelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    
                    <div class='modal-header'>
                        <h5 class='modal-title' id='petName'>Modal Title</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    
                    <div class='modal-body'>
                        <div id='container'></div>
                        <div>
                            <img id='petImage' src=''>
                            <div id='petDescription'>Description: </div>
                        </div>
                    </div>
                    
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <div>
            <h1 id='petName'></h1>
            <img id='petImage' src=''>
            <div id='petDescription'></div>
        </div>
        <?php
	        include 'inc/footer.php'
	    ?>
    </body>
</html>