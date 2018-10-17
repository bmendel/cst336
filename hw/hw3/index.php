<?php
    include 'inc/card.php';
    
    function isValid() {
        $fields = ['name', 'type', 'rarity'];
        foreach ($fields as $f) {
            if (empty($_GET[$f])) {
                echo '<div class=\'error\'>Please fill in all fields!</div>';
                return false;
            }
        }
        return true;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC" rel="stylesheet">
    </head>
    
    <body>
        <h1>Call of Cthulhu Trading Card Generator</h1>
        <h2>Create your very own eldritch horror!</h2>
        
        <form>
            <table align=center class='menu'>
                <tr>
                    <td>Name:</td>
                    <td><input type='text' name='name' value=<?php echo '\'' . $_GET['name'] . '\''?>></td>
                </tr>
                
                <tr>
                    <td>Monster:</td>
                    <td><select name='type'>
                        <option value=''>Select</option>
                        <option value='deep_one'>Deep One</option>
                        <option value='elder_thing'>Elder Thing</option>
                        <option value='shoggoth'>Shoggoth</option>
                    </select></td>
                </tr>
                
                <tr>
                    <td>Color:</td>
                    <td>
                        R: <input type='number' name='r' value=<?php echo '\'' . $_GET['r'] . '\''?> min='0', max='255'> <br />
                        G: <input type='number' name='g' value=<?php echo '\'' . $_GET['g'] . '\''?> min='0', max='255'> <br />
                        B: <input type='number' name='b' value=<?php echo '\'' . $_GET['b'] . '\''?> min='0', max='255'> <br />
                    </td>
                </tr>
                
                <tr>
                    <td>Rarity:</td>
                    <td>
                        <input type='radio' name='rarity' value='common'>Common <br />
                        <input type='radio' name='rarity' value='rare'>Rare <br />
                        <input type='radio' name='rarity' value='legend'>Legendary <br />
                    </td>
                    
                </tr>
            
            </table>
            <br /><input type="submit" value="Create Your Card!" /><br />
            
        </form>
        
        <br />
        <?php 
            if (isValid()) {
                $color = getColor($_GET['r'], $_GET['g'], $_GET['b']);
                makeCard($_GET['name'], $_GET['type'], $color, $_GET['rarity']);
            }
        ?>
        <br />
        
        <footer>
            <br /><br />
            Internet Programming. 2018&copy; Mendel <br />
            <strong>Disclaimer:</strong> The information on this webpage is fictitious.<br />
            It is used for academic purposes only.
        </footer>
    </body>
</html>