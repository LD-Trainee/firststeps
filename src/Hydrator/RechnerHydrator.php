<?php

namespace App\Hydrator;

use App\Entity\Rechner;

class RechnerHydrator implements HydratorInterface
{
    public function hydrate(array $data,  $object)
    {
        /** @var Rechner $object */
        if (empty($data['ergebnis'])) {
            $data['ergebnis'] = 0;
        }

        $object->setZahl($data['ergebnis']);

        return $object;

    }

    public function extract($object)
    {
        /** @var Rechner $object */
        $data = [];

        $data['ergebnis'] = $object->getZahl();

        return $data;
    }
}