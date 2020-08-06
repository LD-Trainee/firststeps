<?php


abstract class ArtistClass extends MusikrichtungClass
{
    public $artistName;

    function __construct($coverIn, $richtungIn, $AnameIn)
    {
        parent::__construct($coverIn, $richtungIn);
        $this->artistName=$AnameIn;
    }
}