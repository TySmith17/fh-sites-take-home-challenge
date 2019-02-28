<?php

namespace PokerHand;

class PokerHand {

  private $cards;

    public function __construct($hand) {
      //replace face cards with numbers, because logic where A is greater then 10 is horrible
      $hand = str_replace(['A','K','Q','J'],['14','13','12','11'],$hand);
      $raw_hand = preg_split('/\s+/',$hand);

      foreach($raw_hand as $card) {
          $this->cards[] = new Card(
            $chars = preg_split('//',$card,-1,PREG_SPLIT_NO_EMPTY);
          );
      }
    }

    public function getRank() {
        // TODO: Implement poker hand ranking
        return 'Royal Flush';
    }

    private function isFlush() {
      $first_suit = $this->cards[0]->getSuit();
      for ($i=1; $i < 5 ; $i+1) {
        if($first_suit !== $this->cards[i]->getSuit()){
          return false;
        }
      }
      return true;
    }

    private function isStraight() {
      for ($i=0; $i < 4 ; $i+1) {
        if($this->cards[i]->getValue() !== $this->cards[i+1]->getValue()-1){
          return false;
        }
      }
      return true;
    }

    private function


}
