    
    var guessedWords = '';
    var selectedWord = '';
    var selectedHint = '';
    var needsHint = true;
    var board = [];
    var remainingGuesses = 6;
    var words = [{ word:'snake', hint:"It's a reptile" }, 
                 { word:'monkey', hint:"It's a mammal" }, 
                 { word:'beetle', hint:"It's an insect" }];
    var alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    window.onload = startGame();
    
    function startGame() {
        pickWord();
        initBoard();
        createLetters();
        updateBoard();
        initGuesses();
    }
    
    function pickWord() {
        var randomInt = Math.floor(Math.random() * words.length);
        selectedWord = words[randomInt].word.toUpperCase();
        selectedHint = words[randomInt].hint;
    }
    
    function initBoard() {
        for (var letter in selectedWord) {
            board.push('_');
        }
        
        $('#hint').click(function() {
            console.log("Getting hint: " + selectedHint);
            displayHint();
        });
    }
    
    function createLetters() {
        for (var letter of alphabet) {
            $('#letters').append("<button class='letter' id='" + letter + "'>" 
                                 + letter + "</button>");
        }
        
        $('.letter').click(function() {
            console.log($(this).attr('id'));
            checkLetter($(this).attr('id'));
            disableButton($(this));
        });
    }
    
    function disableButton(btn) {
        btn.prop('disabled', true);
        btn.attr('class', 'btn btn-danger');
    }
    
    function checkLetter(letter) {
        var positions = new Array();
        
        for (var i = 0; i < selectedWord.length; ++i) {
            console.log(selectedWord);
            if (letter == selectedWord[i]) {
                positions.push(i);
            }
        }
        
        if (positions.length > 0) {
            updateWord(positions, letter);
            
            if(!board.includes('_')) {
                endGame(true);
            }
        }
        else {
            --remainingGuesses;
            updateMan();
        }
        
        if (remainingGuesses <= 0) {
            endGame(false);
        }
    }
    
    function displayHint() {
        if (needsHint) {
            needsHint = false;
            $('#hint').empty();
            
            if (remainingGuesses > 1) {
                $('#hint').append("<span class='hint'>Hint: " + selectedHint + "</span>");
                --remainingGuesses;
                updateMan();
            }
            else {
                $('#hint').append("<span class='hint'>Can't get hints at the last guess!</span>");
            }
        }
    }
    
    function updateBoard() {
        $('#word').empty();
        
        for (var letter of board) {
            document.getElementById('word').innerHTML += letter + " ";
        }
        
        $('#word').append("<br />");
    }
    
    function updateWord(positions, letter) {
        for (var pos of positions) {
            board[pos] = letter;
        }
        updateBoard();
    }
    
    function updateMan() {
        $('#hangImg').attr('src', 'img/stick_' + (6 - remainingGuesses) + '.png');
    }
    
    function initGuesses() {
        var storedWords = sessionStorage.getItem('guessedWords');
        if (storedWords !== null) {
            guessedWords = storedWords;
        }
        updateGuesses();
    }
    
    function updateGuesses() {
        $('#guesses').empty();
        $('#guesses').append("Guesses:<br>")
        for (var letter of guessedWords) {
            if (letter === ':') {
                $('#guesses').append('<br>');
            }
            else {
                $('#guesses').append(letter);
            }
        }
    }
    
    function endGame(win) {
        $('#letters').hide();
        
        if (win) {
            $('#won').show();
            guessedWords += selectedWord + ':';
            updateGuesses();
        }
        else {
            $('#lost').show();
        }
        
        $('.replayBtn').on('click', function() {
            sessionStorage.setItem('guessedWords', guessedWords);
            location.reload();
        });
    }
    
    