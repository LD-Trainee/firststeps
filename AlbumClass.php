<?php


class AlbumClass extends artistClass
{
    public $albumName;

    function __construct($coverIn, $richtungIn, $AnameIn, $albumNameIn)
    {
        parent::__construct($coverIn, $richtungIn, $AnameIn);
        $this->albumName = $albumNameIn;
    }

    function ausleihen() : array
    {
        if(empty($this->cover)){
            echo 'ist null!!     jaaaaaa';
        }
        return [$this->albumName, $this->cover,$this->artistName,$this->richtung];
    }
}