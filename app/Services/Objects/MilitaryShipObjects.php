<?php

namespace OGame\Services\Objects;

use OGame\Services\Objects\Models\Fields\GameObjectAssets;
use OGame\Services\Objects\Models\Fields\GameObjectPrice;
use OGame\Services\Objects\Models\Fields\GameObjectProperties;
use OGame\Services\Objects\Models\Fields\GameObjectRapidfire;
use OGame\Services\Objects\Models\Fields\GameObjectRequirement;
use OGame\Services\Objects\Models\Fields\GameObjectSpeedUpgrade;
use OGame\Services\Objects\Models\ShipObject;

class MilitaryShipObjects
{
    /**
     * Returns all defined building objects.
     *
     * @return array<ShipObject>
     */
    public static function get() : array
    {
        $buildingObjectsNew = [];

        // --- Light Fighter ---
        $lightFighter = new ShipObject();
        $lightFighter->id = 204;
        $lightFighter->title = 'Light Fighter';
        $lightFighter->machine_name = 'light_fighter';
        $lightFighter->class_name = 'fighterLight';
        $lightFighter->description = 'This is the first fighting ship all emperors will build. The light fighter is an agile ship, but vulnerable on its own. In mass numbers, they can become a great threat to any empire. They are the first to accompany small and large cargoes to hostile planets with minor defenses.';
        $lightFighter->description_long = 'This is the first fighting ship all emperors will build. The light fighter is an agile ship, but vulnerable when it is on its own. In mass numbers, they can become a great threat to any empire. They are the first to accompany small and large cargoes to hostile planets with minor defenses.';
        $lightFighter->requirements = [
            new GameObjectRequirement('shipyard', 1),
        ];
        $lightFighter->price = new GameObjectPrice(3000, 1000, 0, 0);
        $lightFighter->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
        ];
        $lightFighter->properties = new GameObjectProperties();
        $lightFighter->properties->structural_integrity = 4000;
        $lightFighter->properties->shield = 10;
        $lightFighter->properties->attack = 50;
        $lightFighter->properties->speed = 12500;
        $lightFighter->properties->capacity = 50;
        $lightFighter->properties->fuel = 20;

        $lightFighter->assets = new GameObjectAssets();
        $lightFighter->assets->imgMicro = 'light_fighter_small.jpg';
        $lightFighter->assets->imgSmall = 'light_fighter_small.jpg';
        $buildingObjectsNew[] = $lightFighter;

        // --- Heavy Fighter ---
        $heavyFighter = new ShipObject();
        $heavyFighter->id = 205;
        $heavyFighter->title = 'Heavy Fighter';
        $heavyFighter->machine_name = 'heavy_fighter';
        $heavyFighter->class_name = 'fighterHeavy';
        $heavyFighter->description = 'This fighter is better armoured and has a higher attack strength than the light fighter.';
        $heavyFighter->description_long = 'In developing the heavy fighter, researchers reached a point at which conventional drives no longer provided sufficient performance. In order to move the ship optimally, the impulse drive was used for the first time. This increased the costs, but also opened new possibilities. By using this drive, there was more energy left for weapons and shields; in addition, high-quality materials were used for this new family of fighters. With these changes, the heavy fighter represents a new era in ship technology and is the basis for cruiser technology.
            
        Slightly larger than the light fighter, the heavy fighter has thicker hulls, providing more protection, and stronger weaponry.';
        $heavyFighter->requirements = [
            new GameObjectRequirement('shipyard', 3),
            new GameObjectRequirement('armor_technology', 2),
            new GameObjectRequirement('impulse_drive', 2),
        ];
        $heavyFighter->price = new GameObjectPrice(6000, 4000, 0, 0);
        $heavyFighter->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
            new GameObjectRapidfire('small_cargo', 66.67, 3),
        ];

        $heavyFighter->properties = new GameObjectProperties();
        $heavyFighter->properties->structural_integrity = 10000;
        $heavyFighter->properties->shield = 25;
        $heavyFighter->properties->attack = 150;
        $heavyFighter->properties->speed = 10000;
        $heavyFighter->properties->capacity = 100;
        $heavyFighter->properties->fuel = 75;

        $heavyFighter->assets = new GameObjectAssets();
        $heavyFighter->assets->imgMicro = 'heavy_fighter_small.jpg';
        $heavyFighter->assets->imgSmall = 'heavy_fighter_small.jpg';
        $buildingObjectsNew[] = $heavyFighter;

        // --- Cruiser ---
        $cruiser = new ShipObject();
        $cruiser->id = 206;
        $cruiser->title = 'Cruiser';
        $cruiser->machine_name = 'cruiser';
        $cruiser->class_name = 'cruiser';
        $cruiser->description = 'Cruisers are armoured almost three times as heavily as heavy fighters and have more than twice the firepower. In addition, they are very fast.';
        $cruiser->description_long = 'With the development of the heavy laser and the ion cannon, light and heavy fighters encountered an alarmingly high number of defeats that increased with each raid. Despite many modifications, weapons strength and armour changes, it could not be increased fast enough to effectively counter these new defensive measures. Therefore, it was decided to build a new class of ship that combined more armor and more firepower. As a result of years of research and development, the Cruiser was born.
        
        Cruisers are armored almost three times of that of the heavy fighters, and possess more than twice the firepower of any combat ship in existence. They also possess speeds that far surpassed any spacecraft ever made. For almost a century, cruisers dominated the universe. However, with the development of Gauss cannons and plasma turrets, their predominance ended. They are still used today against fighter groups, but not as predominantly as before.';

        $cruiser->requirements = [
            new GameObjectRequirement('shipyard', 5),
            new GameObjectRequirement('impulse_drive', 4),
            new GameObjectRequirement('ion_technology', 2),
        ];
        $cruiser->price = new GameObjectPrice(20000, 7000, 2000, 0);

        $cruiser->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
            new GameObjectRapidfire('light_fighter', 83.34, 6),
            new GameObjectRapidfire('rocket_launcher', 98, 10),
        ];

        $cruiser->properties = new GameObjectProperties();
        $cruiser->properties->structural_integrity = 27000;
        $cruiser->properties->shield = 50;
        $cruiser->properties->attack = 400;
        $cruiser->properties->speed = 15000;
        $cruiser->properties->capacity = 800;
        $cruiser->properties->fuel = 300;

        $cruiser->assets = new GameObjectAssets();
        $cruiser->assets->imgMicro = 'cruiser_small.jpg';
        $cruiser->assets->imgSmall = 'cruiser_small.jpg';
        $buildingObjectsNew[] = $cruiser;

        // --- Battleship ---
        $battleship = new ShipObject();
        $battleship->id = 207;
        $battleship->title = 'Battleship';
        $battleship->machine_name = 'battle_ship';
        $battleship->class_name = 'battleship';
        $battleship->description = 'Battleships form the backbone of a fleet. Their heavy cannons, high speed, and large cargo holds make them opponents to be taken seriously.';
        $battleship->description_long = 'Once it became apparent that the cruiser was losing ground to the increasing number of defense structures it was facing, and with the loss of ships on missions at unacceptable levels, it was decided to build a ship that could face those same type of defense structures with as little loss as possible. After extensive development, the Battleship was born. Built to withstand the largest of battles, the Battleship features large cargo spaces, heavy cannons, and high hyperdrive speed. Once developed, it eventually turned out to be the backbone of every raiding Emperors fleet.';
        $battleship->requirements = [
            new GameObjectRequirement('shipyard', 7),
            new GameObjectRequirement('hyperspace_drive', 4),
        ];
        $battleship->price = new GameObjectPrice(45000, 15000, 0, 0);
        $battleship->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
        ];

        $battleship->properties = new GameObjectProperties();
        $battleship->properties->structural_integrity = 60000;
        $battleship->properties->shield = 200;
        $battleship->properties->attack = 1000;
        $battleship->properties->speed = 10000;
        $battleship->properties->capacity = 1500;
        $battleship->properties->fuel = 500;

        $battleship->assets = new GameObjectAssets();
        $battleship->assets->imgMicro = 'battleship_small.jpg';
        $battleship->assets->imgSmall = 'battleship_small.jpg';
        $buildingObjectsNew[] = $battleship;

        // --- Battlecruiser ---
        $battlecruiser = new ShipObject();
        $battlecruiser->id = 215;
        $battlecruiser->title = 'Battlecruiser';
        $battlecruiser->machine_name = 'battlecruiser';
        $battlecruiser->class_name = 'interceptor';
        $battlecruiser->description = 'The Battlecruiser is highly specialized in the interception of hostile fleets.';
        $battlecruiser->description_long = 'This ship is one of the most advanced fighting ships ever to be developed, and is particularly deadly when it comes to destroying attacking fleets. With its improved laser cannons on board and advanced Hyperspace engine, the Battlecruiser is a serious force to be dealt with in any attack. Due to the ships design and its large weapons system, the cargo holds had to be cut, but this is compensated for by the lowered fuel consumption.';
        $battlecruiser->requirements = [
            new GameObjectRequirement('shipyard', 8),
            new GameObjectRequirement('hyperspace_drive', 5),
            new GameObjectRequirement('hyperspace_technology', 5),
            new GameObjectRequirement('laser_technology', 12),
        ];

        $battlecruiser->price = new GameObjectPrice(30000, 40000, 15000, 0);
        $battlecruiser->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
            new GameObjectRapidfire('heavy_fighter', 75, 4),
            new GameObjectRapidfire('cruiser', 75, 4),
            new GameObjectRapidfire('battle_ship', 85.72, 7),
            new GameObjectRapidfire('small_cargo', 66.67, 3),
            new GameObjectRapidfire('large_cargo', 66.67, 3),
        ];

        $battlecruiser->properties = new GameObjectProperties();
        $battlecruiser->properties->structural_integrity = 70000;
        $battlecruiser->properties->shield = 400;
        $battlecruiser->properties->attack = 700;
        $battlecruiser->properties->speed = 10000;
        $battlecruiser->properties->capacity = 750;
        $battlecruiser->properties->fuel = 250;

        $battlecruiser->assets = new GameObjectAssets();
        $battlecruiser->assets->imgMicro = 'battlecruiser_small.jpg';
        $battlecruiser->assets->imgSmall = 'battlecruiser_small.jpg';
        $buildingObjectsNew[] = $battlecruiser;

        // --- Bomber ---
        $bomber = new ShipObject();
        $bomber->id = 211;
        $bomber->title = 'Bomber';
        $bomber->machine_name = 'bomber';
        $bomber->class_name = 'bomber';
        $bomber->description = 'The bomber was developed especially to destroy the planetary defenses of a world.';
        $bomber->description_long = 'Over the centuries, as defenses were starting to get larger and more sophisticated, fleets were starting to be destroyed at an alarming rate. It was decided that a new ship was needed to break defenses to ensure maximum results. After years of research and development, the Bomber was created.
        
        Using laser-guided targeting equipment and Plasma Bombs, the Bomber seeks out and destroys any defense mechanism it can find. As soon as the hyperspace drive is developed to Level 8, the Bomber is retrofitted with the hyperspace engine and can fly at higher speeds.';
        $bomber->requirements = [
            new GameObjectRequirement('shipyard', 8),
            new GameObjectRequirement('impulse_drive', 6),
            new GameObjectRequirement('plasma_technology', 5),
        ];
        $bomber->price = new GameObjectPrice(50000, 25000, 15000, 0);

        $bomber->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
            new GameObjectRapidfire('rocket_launcher', 95, 20),
            new GameObjectRapidfire('light_laser', 95, 20),
            new GameObjectRapidfire('heavy_laser', 90, 10),
            new GameObjectRapidfire('ion_cannon', 90, 10),
            new GameObjectRapidfire('gauss_cannon', 80, 5),
            new GameObjectRapidfire('plasma_turret', 80, 5),
        ];

        $bomber->properties = new GameObjectProperties();
        $bomber->properties->structural_integrity = 75000;
        $bomber->properties->shield = 500;
        $bomber->properties->attack = 1000;
        $bomber->properties->speed = 4000;
        $bomber->properties->capacity = 500;
        $bomber->properties->fuel = 700;
        $bomber->properties->speed_upgrade = [
            new GameObjectSpeedUpgrade('hyperspace_drive', 8),
        ];

        $bomber->assets = new GameObjectAssets();
        $bomber->assets->imgMicro = 'bomber_small.jpg';
        $bomber->assets->imgSmall = 'robot_factory_micro.jpg';
        $buildingObjectsNew[] = $bomber;

        // --- Destroyer ---
        $destroyer = new ShipObject();
        $destroyer->id = 213;
        $destroyer->title = 'Destroyer';
        $destroyer->machine_name = 'destroyer';
        $destroyer->class_name = 'destroyer';
        $destroyer->description = 'The destroyer is the king of the warships.';
        $destroyer->description_long = 'The Destroyer is the result of years of work and development. With the development of Deathstars, it was decided that a class of ship was needed to defend against such a massive weapon. Thanks to its improved homing sensors, multi-phalanx Ion cannons, Gauss Cannons and Plasma Turrets, the Destroyer
        turned out to be one of the most fearsome ships created.
        
        Because the destroyer is very large, its manoeuvrability is severely limited, which makes it more of a battle station than a fighting ship. The lack of manoeuvrability is made up for by its sheer firepower, but it also costs significant amounts of deuterium to build and operate.';
        $destroyer->requirements = [
            new GameObjectRequirement('shipyard', 9),
            new GameObjectRequirement('hyperspace_drive', 6),
            new GameObjectRequirement('hyperspace_technology', 5),
        ];
        $destroyer->price = new GameObjectPrice(60000, 50000, 15000, 0);
        $destroyer->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 80, 5),
            new GameObjectRapidfire('solar_satellite', 80, 5),
            new GameObjectRapidfire('light_laser', 90, 10),
            new GameObjectRapidfire('battle_cruiser', 50, 2),
        ];
        $destroyer->properties = new GameObjectProperties();
        $destroyer->properties->structural_integrity = 110000;
        $destroyer->properties->shield = 500;
        $destroyer->properties->attack = 200;
        $destroyer->properties->speed = 5000;
        $destroyer->properties->capacity = 2000;
        $destroyer->properties->fuel = 1000;
        $destroyer->assets = new GameObjectAssets();
        $destroyer->assets->imgMicro = 'destroyer_small.jpg';
        $destroyer->assets->imgSmall = 'robot_factory_micro.jpg';
        $buildingObjectsNew[] = $destroyer;

        // --- Deathstar ---
        $deathstar = new ShipObject();
        $deathstar->id = 214;
        $deathstar->title = 'Deathstar';
        $deathstar->machine_name = 'deathstar';
        $deathstar->class_name = 'deathstar';
        $deathstar->description = 'The destructive power of the deathstar is unsurpassed.';
        $deathstar->description_long = 'The Deathstar is the most powerful ship ever created. This moon sized ship is the only ship that can be seen with the naked eye on the ground. By the time you spot it, unfortunately, it is too late to do anything.
        
        Armed with a gigantic graviton cannon, the most advanced weapons system ever created in the Universe, this massive ship has not only the capability of destroying entire fleets and defenses, but also has the capability of destroying entire moons. Only the most advanced empires have the capability to build a ship of this mammoth size.';

        $deathstar->requirements = [
            new GameObjectRequirement('shipyard', 12),
            new GameObjectRequirement('hyperspace_drive', 7),
            new GameObjectRequirement('hyperspace_technology', 6),
            new GameObjectRequirement('graviton_technology', 1),
        ];
        $deathstar->price = new GameObjectPrice(5000000, 4000000, 1000000, 0);
        $deathstar->rapidfire = [
            new GameObjectRapidfire('espionage_probe', 99.6, 250),
            new GameObjectRapidfire('solar_satellite', 99.6, 250),
            new GameObjectRapidfire('light_fighter', 99.5, 200),
            new GameObjectRapidfire('heavy_fighter', 99, 100),
            new GameObjectRapidfire('cruiser', 96.97, 33),
            new GameObjectRapidfire('battle_ship', 96.67, 30),
            new GameObjectRapidfire('bomber', 96, 25),
            new GameObjectRapidfire('destroyer', 80, 5),
            new GameObjectRapidfire('small_cargo', 99.6, 250),
            new GameObjectRapidfire('large_cargo', 99.6, 250),
            new GameObjectRapidfire('colony_ship', 99.6, 250),
            new GameObjectRapidfire('recycler', 99.6, 250),
            new GameObjectRapidfire('rocket_launcher', 99.5, 200),
            new GameObjectRapidfire('light_laser', 99.5, 200),
            new GameObjectRapidfire('heavy_laser', 99, 100),
            new GameObjectRapidfire('ion_cannon', 99, 100),
            new GameObjectRapidfire('gauss_cannon', 98, 50),
            new GameObjectRapidfire('battle_cruiser', 93.34, 15),
        ];

        $deathstar->properties = new GameObjectProperties();
        $deathstar->properties->structural_integrity = 9000000;
        $deathstar->properties->shield = 50000;
        $deathstar->properties->attack = 200000;
        $deathstar->properties->speed = 100;
        $deathstar->properties->capacity = 1000000;
        $deathstar->properties->fuel = 1;

        $deathstar->assets = new GameObjectAssets();
        $deathstar->assets->imgMicro = 'deathstar_small.jpg';
        $deathstar->assets->imgSmall = 'robot_factory_micro.jpg';
        $buildingObjectsNew[] = $deathstar;

        return $buildingObjectsNew;
    }
}