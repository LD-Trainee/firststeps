<?php
abstract class CD extends Datenträger{

    function __construct($coverIn){
        $this->cover = $coverIn;
    }

    /*function getInfo() : array
    {
        return [
            'cover' => $this->cover,
            'name' => $this->name
        ];
    }
**/
}