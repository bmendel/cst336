
<?php
    session_start();
    include '../inc/dbConnection.php';
    $dbConn = startConnection('c9');
    include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Dungeon Keeper </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC" rel="stylesheet">
    </head>
    
    <body>
        <?php include 'inc/header.php'; ?>
        
        <form method='post'>
            <div class='container'>    
                <legend>Search</legend>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='name' class='col-form-label col-2'>Name</label>        
                    <div class='col-3'><input class="form-control" name='name' id='name' type='text'></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='category' class='col-form-label col-2'>Category</label>         
                    <div class='col-3'><select class="form-control" name='category' id='category'>
                        <option value=''>Any Category</option>
                        <?php getCategories(); ?>
                    </select></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='lo' class='col-form-label col-2'>Low Value</label>         
                    <div class='col-3'><input class="form-control" name='lo' id='lo' type='text'></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='hi' class='col-form-label col-2'>High Value</label>         
                    <div class='col-3'><input class="form-control" name='hi' id='hi' type='text'></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='sort' class='col-form-label col-2'>Sort By</label>         
                    <div class='col-3'><select  class="form-control" name='sort' id='sort'>
                        <option value='name'>Name</option>
                        <option value='category'>Category</option>
                        <option value='value'>Value</option>
                        <option value='quantity'>Quantity</option>
                    </select></div>
                </div>
            </div><br>
            
            <button type='submit' class='btn btn-outline-dark' name='search' value='Search'>Search</button>
            <a class='btn btn-outline-dark' href='index.php' role='button'>Home</a>
        </form>
        
        <br><hr><br>
        
        <?php displayResults(); ?>
        
        <script>
            $('document').ready(function() {
                $('.info').click(function() {
                    
                    //console.Log("clicked");
                    //$('#container').html("<img src='img/loading.gif' >");
                    $('#monsterModal').modal("show");
                    // click on result info
                    $.ajax({
                        type: "GET",
                        url: "inc/getMonsterInfo.php",
                        dataType: "json",
                        data: { 'productId': $(this).attr('id') },
                        success: function(data, status) {
                            $('#monsterName').html(data.productName);
                            $('#monsterImage').attr('src', data.productImage);
                            $('#monsterImage').attr('alt', data.productImage);
                            $('#monsterDescription').html(data.productDescription);
                            $('#monsterValue').html('Value: ' + data.productValue + " gold");
                            $('#monsterStock').html(data.productStock + ' in stock');
                            $('#container').html("");
                        },
                    }); // ajax
                    
                }) // info click
            }); // document ready
        </script>
        
        <!-- Modal -->
        <div class='modal fade' id='monsterModal' tabindex='-1' role='dialog' aria-balelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    
                    <div class='modal-header'>
                        <h5 class='modal-title' id='monsterName'>Modal Title</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    
                    <div class='modal-body'>
                        <div id='container'></div>
                        <div>
                            <img id='monsterImage' src=''>
                            <div id='monsterDescription'></div>
                            <div id='monsterValue'></div>
                            <div id='monsterStock'></div>
                        </div>
                    </div>
                    
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-dark' data-dismiss='modal'>Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php include 'inc/footer.php'; ?>
    </body>
</html>