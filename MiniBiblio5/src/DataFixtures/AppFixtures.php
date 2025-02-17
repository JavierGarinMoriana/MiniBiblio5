<?php

namespace App\DataFixtures;

use App\Factory\AutorFactory;
use App\Factory\EditorialFactory;
use App\Factory\LibroFactory;
use App\Factory\SocioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AutorFactory::createMany(200);
        EditorialFactory::createMany(100);
        SocioFactory::createMany(50);
        LibroFactory::createMany(50, function () {
            return [
                "autores" => AutorFactory::randomRange(1, 3),
                "socio" => SocioFactory::faker()->boolean(25) ? SocioFactory::random() : null,
                "editorial" => EditorialFactory::random()
            ];
        });

        $manager->flush();
    }
}
