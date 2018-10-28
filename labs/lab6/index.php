<?php
    include 'dbConnection.php';
    $conn = getDatabaseConnection('ottermart');
    
    function displayCategories() {
        
        global $conn;
        
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($records as $r) {
            echo "<option value='" . $r['catId'] . "' >" . $r['catName'] . "</option>";
        }
    }
    
    function displaySearchResults() {
        
        global $conn;
        
        if (isset($_GET['searchForm'])) {
            echo "<h3>Products Found:</h3>";
            $namedParameters = array();
            
            $sql = "SELECT * FROM om_product WHERE 1";
            if (!empty($_GET['product'])) {
                $sql .= " AND (productName LIKE :productName 
                          OR productDescription LIKE :productName)";
                $namedParameters[':productName'] = "%" . $_GET['product'] . "%";
            }
            
            if (!empty($_GET['category'])) {
                $sql .= " AND catId LIKE :categoryId";
                $namedParameters[':categoryId'] = $_GET['category'];
            }
            
            if (!empty($_GET['lowPrice'])) {
                $sql .= " AND price >= :lowPrice";
                $namedParameters[':lowPrice'] = $_GET['lowPrice'];
            }
            
            if (!empty($_GET['highPrice'])) {
                $sql .= " AND price <= :highPrice";
                $namedParameters[':highPrice'] = $_GET['highPrice'];
            }
            
            if (!empty($_GET['orderBy'])) {
                switch ($_GET['orderBy']) {
                    case 'price':
                        $sql .= " ORDER BY price";
                        break;
                    case 'name':
                        $sql .= " ORDER BY productName";
                        break;
                }
            }

            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($records as $r) {
                echo "<a href='purchaseHistory.php?productId=" . $r['productId'] . "'>History</a>";
                echo " - " . $r['productName'] . " - " . $r['productDescription'] . " - $" . $r['price'] . "<br><br>";
                
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Ottermart Product Search</title>
        <link href='css/styles.css' rel='stylesheet' text='text/css'>
    </head>

    <body>
        <table align=center>
            <h1>Ottermart Product Search</h1>
            <form>
                
                <tr>
                <td>Product:</td>
                <td><input type='text' name='product' size='29'/></td>
                </tr>
                
                <tr>
                <td>Category:</td>
                <td><select name='category'>
                    <option value=''>Select One</option>
                    <?=displayCategories()?>
                </select></td>
                </tr>
                
                <tr>
                <td>Price:</td>
                <td>From <input type='text' name='lowPrice' size='7'>
                    To <input type='text' name='highPrice' size='7'></td>
                </tr>
                
                <tr>
                <td>Order result by:</td>
                <td><input type='radio' name='orderBy' value='price'>Price<br>
                    <input type='radio' name='orderBy' value='name'>Product Name</td>
                </tr>
                
                <tr align=center>
                <th colspan='2'><br><input type='submit' value='Search' name='searchForm' /></th>
                </tr>
                
            </form>
        </table>
        
        <hr>
        
        <div id='results'>
            <?=displaySearchResults()?>
        </div>
    </body>    
    
</html>