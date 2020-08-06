<?php

interface HüllenInterface
{
    function ausleihen();
}

abstract class Datenträger implements HüllenInterface{
    public $cover;
}
