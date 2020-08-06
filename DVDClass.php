<?php
abstract class DVD extends Datenträger
{

    function __construct($nameIn, $coverIn){
        $this->name = $nameIn;
        $this->cover = $coverIn;
    }

    /**function getInfo() : array
    {
        $info = [
            'cover' => $this->cover,
            'name' => $this->name
        ];

        return $info;
    }
     * **/
}