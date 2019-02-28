<?php

namespace PokerHand;

class Card {
  private $value;
  private $suit;

    public function __construct($card) {
      $this->suit = array_pop($card);
      $this->value = intval(join('',$card));
    }

    public function getValue() {
      return $this->value;
    }

    public function getSuit() {
      return $this->suit;
    }

}
