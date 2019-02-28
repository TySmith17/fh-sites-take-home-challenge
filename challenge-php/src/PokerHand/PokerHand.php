<?php

namespace PokerHand;

class PokerHand {

  private $cards;

    public function __construct($hand) {
      //replace face cards with numbers, because logic where A is greater then 10 is horrible
      $hand = str_replace(['A','K','Q','J'],['14','13','12','11'],$hand);
      $raw_hand = preg_split('/\s+/',$hand);
      foreach($raw_hand as $card) {
        $chars = preg_split('//',$card,-1,PREG_SPLIT_NO_EMPTY);
          $this->cards[] = new Card($chars);
      }
      $this->sortCards();
    }

    public function getRank() {
        if($this->isFlush() && $this->isStraight()) {
          if($this->cards[0]->getValue() === 14){
            return 'Royal Flush';
          }
          return 'Straight Flush';
        } elseif ($this->fourOfAKind()) {
          return 'Four of a Kind';
        } elseif ($this->fullHouse()) {
          return 'Full House';
        } elseif ($this->isFlush()) {
          return 'Flush';
        } elseif ($this->isStraight()) {
          return 'Straight';
        } elseif ($this->threeOfAKind()) {
          return 'Three of a Kind';
        } elseif ($this->twoPair()) {
          return 'Two Pair';
        } elseif ($this->aPair()) {
          return 'One Pair';
        }
        echo 'You should just fold';
        return 'High Card';
    }

    private function sortCards() {
      usort($this->cards,function($a,$b){
        if ($a->getValue() === $b->getValue()){
            return 0;
        }
        return ($a->getValue() < $b->getValue() ) ? 1 : -1;
      });
    }

    private function isFlush() {
      $first_suit = $this->cards[0]->getSuit();
      for($i=1; $i < sizeof($this->cards) ; $i++) {
        if($first_suit !== $this->cards[$i]->getSuit()){
          return false;
        }
      }
      return true;
    }

    private function isStraight() {
      for ($i=0; $i < sizeof($this->cards)-1 ; $i++) {
        if($this->cards[$i]->getValue() !== ($this->cards[$i+1]->getValue()+1) ){
          return false;
        }
      }
      return true;
    }

    private function fourOfAKind() {
      if($this->cards[0]->getValue() === $this->cards[3]->getValue() ||
         $this->cards[1]->getValue() === $this->cards[4]->getValue()
       ) {
         return true;
       }
       return false;
    }

    private function fullHouse(){
      if ($this->threeOfAKind() &&
          $this->cards[0]->getValue() === $this->cards[1]->getValue() &&
          $this->cards[3]->getValue() === $this->cards[4]->getValue()
      ){
        return true;
      }
      return false;
    }

    private function threeOfAKind() {
      for ($i=0; $i < sizeof($this->cards)-2 ; $i++) {
        if($this->cards[$i]->getValue() === $this->cards[$i+2]->getValue()) {
          return true;
        }
      }
      return false;
    }

    private function aPair($i = 0){
      while ($i < sizeof($this->cards)-1 ) {
        if($this->cards[$i]->getValue() === $this->cards[$i+1]->getValue()) {
          //dont return a zero
          return $i+1;
        }
        $i++;
      }
      return false;
    }

    private function twoPair() {
      $first_match = $this->aPair();
      if($first_match) {
        return $this->aPair($first_match);
      }
    }

}
