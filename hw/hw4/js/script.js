      
    var player = 'none';
    var comp = 'none';
    var start = true;
        
    function playerSelect(imageElement) {
        if (start) {
            imageElement.style.borderColor = 'gold';
            var player = imageElement.id;
            var comp = computerSelect();
            getResult(player, comp);
            start = false;
        }
    }
    
    function computerSelect() {
        var choice = Math.floor(Math.random()*3 + 1);
        switch (choice) {
            case 1:
                document.getElementById('c_rock').style.borderColor = 'gold';
                return 'rock';
            case 2:
                document.getElementById('c_paper').style.borderColor = 'gold';
                return 'paper';
            case 3:
                document.getElementById('c_scissors').style.borderColor = 'gold';
                return 'scissors';
        }
    }
    
    function getResult(player, comp) {
        var playerCol, compCol;
        if (player == comp) {
            playerCol = 'silver';
            compCol = 'silver';
            document.getElementById('message').innerHTML = "It's a tie!"
        }
        else if ((player == 'rock' && comp == 'scissors')
                || (player == 'paper' && comp == 'rock')
                || (player == 'scissors' && comp == 'paper')) {
            playerCol = 'green';
            compCol = 'red';
            document.getElementById('message').innerHTML = "The player wins!"
        }
        else {
            playerCol = 'red';
            compCol = 'green';
            document.getElementById('message').innerHTML = "The computer wins!"
        }
        
        document.getElementById('playerCol').style.backgroundColor = playerCol;
        document.getElementById('compCol').style.backgroundColor = compCol;
        document.getElementById('message').style.color = playerCol;
    }
    
    function resetGame() {
        
        document.getElementById('rock').style.borderColor = 'black';
        document.getElementById('paper').style.borderColor = 'black';
        document.getElementById('scissors').style.borderColor = 'black';

        document.getElementById('c_rock').style.borderColor = 'black';
        document.getElementById('c_paper').style.borderColor = 'black';
        document.getElementById('c_scissors').style.borderColor = 'black';

        player = 'none';
        comp = 'none';
        start = true;
        
        document.getElementById('playerCol').style.backgroundColor = 'white';
        document.getElementById('compCol').style.backgroundColor = 'white';
        document.getElementById('message').innerHTML = "Choose rock, paper, or scissors!"
        document.getElementById('message').style.color = 'black';
        
        
    }