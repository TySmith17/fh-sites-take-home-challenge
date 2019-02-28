<?php

namespace PokerHand;

class Card
{
  protected $value;
  protected $suit;

    public function __construct($card)
    {
      $this->value =  $card[0];
      $this->suit = $card[1];
    }

    public function getValue() {
      return $this->value;
    }

    public function getSuit() {
      return $this->suit;
    }

}
