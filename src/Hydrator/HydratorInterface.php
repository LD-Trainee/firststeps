<?php


namespace App\Hydrator;


interface HydratorInterface
{
    public function hydrate(array $data, $object);
    public function extract($object);
}