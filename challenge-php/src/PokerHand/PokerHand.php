<?php

namespace PokerHand;

class PokerHand {

  private $cards;

    public function __construct($hand) {
      $raw_hand = preg_split('/\s+/', $hand);

      foreach( $raw_hand as $card ) {
          $this->cards[] = new Card( $card );
      }
    }

    public function getRank() {
        // TODO: Implement poker hand ranking
        return 'Royal Flush';
    }
}
