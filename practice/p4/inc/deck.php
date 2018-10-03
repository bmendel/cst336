<?php
    
    class Card {
        public $name;
        public $value;
    }
    
    class Deck {
        
        public $deck;
        
        function __construct() {
            $this->createDeck();
        }
        
        function createDeck() {
            $this->deck = array();
            $suit = array("clubs", "diamonds", "hearts", "spades");
        
            for ($i = 0; $i < 52; $i++) {
                $card = new Card();
                $card->name = 'cards/'.$suit[$i/13].'/'.($i%13+1).'.png';
                $card->value = ($i%13+1);
                $this->deck[$i] = $card;
            }
            shuffle($this->deck);
        }
        
        function printDeck() {
            foreach ($this->deck as $card) {
                echo "$card->name  $card->value<br />";
            }
        }
        
        function drawFromDeck() {
            return array_pop($this->deck);
        }
    }
    
?>