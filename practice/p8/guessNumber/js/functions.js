    
    var randomNumber = Math.floor(Math.random() * 99) + 1;
    var guesses = document.querySelector('#guesses');
    var lastResult = document.querySelector('#lastResult');
    var lowOrHi = document.querySelector('#lowOrHi');
    
    var guessSubmit = document.querySelector('.guessSubmit');
    var guessField = document.querySelector('.guessField');
    
    var guessCount = 1;
    var resetButton = document.querySelector('#reset');
    resetButton.style.display = 'none';
    guessField.focus();
    
    function checkGuess() {
        var userGuess = Number(guessField.value);
        if (guessCount === 1) {
            guesses.innerHTML = 'Previous guesses: ';
        }
        guesses.innerHTML += userGuess + ' ';
        
        if (userGuess === randomNumber) {
            lastResult.innerHTML = 'Congratulations! You got it right!';
            lastResult.style.background = 'green';
            lowOrHi.innerHTML = '';
            setGameOver();
        }
        else if (guessCount === 7) {
            lastResult.innerHTML = 'Sorry, you lost!';
            setGameOver();
        }
        else {
            lastResult.innerHTML = 'Wrong!';
            lastResult.style.background = 'red';
            if (userGuess > randomNumber) {
                lowOrHi.innerHTML = 'Last guess was too low!';
            }
            if (userGuess < randomNumber) {
                lowOrHi.innerHTML = 'Last guess was too high!';
            }
        }
        
        guessCount++;
        guessField.value = '';
        guessField.focus();
    }
    
    guessSubmit.addEventListener('click', checkGuess);
    
    function setGameOver() {
        guessField.disabled = true;
        guessSubmit.disabled = true;
        resetButton.style.display = 'incline';
        resetButton.addEventListener('click', resetGame);
    }
    
    function resetGame() {
        var resetParas = document.querySelectorAll('.resultParas p');
        for (var i = 0; i < resetParas.length; ++i) {
            resetParas[i].textContent = '';
        }
        
        resetButton.style.display = 'none';
        
        guessField.disabled = true;
        guessSubmit.disabled = true;
        guessCount = 1;
        guessField.value = '';
        guessField.focus();
        
        lastResult.style.backgroundColor = 'white';
        
        var randomNumber = Math.floor(Math.random() * 99) + 1;
    }
    
    console.log(randomNumber);
    document.getElementById("numberToGuess").innerHTML = randomNumber;