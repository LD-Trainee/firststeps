<?php


abstract class MusikrichtungClass extends CD
{
    public $richtung;

    function __construct($coverIn, $richtungIn)
    {
        parent::__construct($coverIn);
        $this->richtung = $richtungIn;
    }
}