<?php

namespace OGame\GameMissions;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use OGame\Factories\PlanetServiceFactory;
use OGame\Factories\PlayerServiceFactory;
use OGame\GameMissions\Abstracts\GameMission;
use OGame\GameMissions\Models\MissionPossibleStatus;
use OGame\GameObjects\Models\UnitCollection;
use OGame\Models\FleetMission;
use OGame\Models\Planet\Coordinate;
use OGame\Models\Resources;
use OGame\Services\PlanetService;

class ColonisationMission extends GameMission
{
    protected static string $name = 'Colonisation';
    protected static int $typeId = 7;
    protected static bool $hasReturnMission = false;

    public function startMissionSanityChecks(PlanetService $planet, Coordinate $targetCoordinate, UnitCollection $units, Resources $resources): void
    {
        // Call the parent method
        parent::startMissionSanityChecks($planet, $targetCoordinate, $units, $resources);

        if ($units->getAmountByMachineName('colony_ship') == 0) {
            throw new Exception(__('You need a colony ship to colonize a planet.'));
        }

        // Try to load planet. If it succeeds it means the planet is not empty.
        $planetServiceFactory =  app()->make(PlanetServiceFactory::class);
        if ($planetServiceFactory->makeForCoordinate($targetCoordinate) != null) {
            throw new Exception(__('You can only colonize empty planets.'));
        }
    }

    /**
     * @inheritdoc
     */
    public function isMissionPossible(PlanetService $planet, ?PlanetService $targetPlanet, UnitCollection $units): MissionPossibleStatus
    {
        if ($targetPlanet == null) {
            // Check if a colony ship is present in the fleet
            if ($units->getAmountByMachineName('colony_ship') > 0) {
                return new MissionPossibleStatus(true);
            } else {
                // Return error message
                return new MissionPossibleStatus(false, __('You need a colony ship to colonize a planet.'));
            }
        }

        return new MissionPossibleStatus(false);
    }

    /**
     * @throws BindingResolutionException
     */
    protected function processArrival(FleetMission $mission): void
    {
        // Sanity check: make sure the target coordinates are valid and the planet is (still) empty.
        $planetServiceFactory =  app()->make(PlanetServiceFactory::class);
        $target_planet = $planetServiceFactory->makeForCoordinate(new Coordinate($mission->galaxy_to, $mission->system_to, $mission->position_to));

        // Load the mission owner user
        $playerServiceFactory = app()->make(PlayerServiceFactory::class);
        $player = $playerServiceFactory->make($mission->user_id);

        if ($target_planet != null) {
            // TODO: add unittest for this behavior.
            // Cancel the current mission.
            $this->cancel($mission);
            // Send fleet back.
            $this->startReturn($mission);
            return;
        }

        // Sanity check: colonisation mission without a colony ship is not possible.
        if ($mission->colony_ship < 1) {
            // Cancel the current mission.
            $this->cancel($mission);
            // Send fleet back.
            $this->startReturn($mission);
        }

        // Create a new planet at the target coordinates.
        $target_planet = $planetServiceFactory->createAdditionalForPlayer($player, new Coordinate($mission->galaxy_to, $mission->system_to, $mission->position_to));

        // Success message
        $this->messageService->sendMessageToPlayer($target_planet->getPlayer(), 'Settlement Report', 'The fleet has arrived at the assigned coordinates [coordinates]' . $target_planet->getPlanetCoordinates()->asString() . '[/coordinates], found a new planet there and are beginning to develop upon it immediately.', 'colony_established');

        // Add resources to the target planet if the mission has any.
        $resources = $this->fleetMissionService->getResources($mission);
        $target_planet->addResources($resources);

        // Remove the colony ship from the fleet as it is consumed in the colonization process.
        $mission->colony_ship -= 1;

        // Mark the arrival mission as processed
        $mission->processed = 1;
        $mission->save();

        // Check if the mission has any ships left. If yes, start a return mission to send them back.
        if ($this->fleetMissionService->getFleetUnitCount($mission) > 0) {
            // Create and start the return mission.
            $this->startReturn($mission);
        }
    }

    protected function processReturn(FleetMission $mission): void
    {
        // Load the target planet
        $planetServiceFactory =  app()->make(PlanetServiceFactory::class);
        $target_planet = $planetServiceFactory->make($mission->planet_id_to);

        // Transport return trip: add back the units to the source planet. Then we're done.
        $target_planet->addUnits($this->fleetMissionService->getFleetUnits($mission));

        // Add resources to the origin planet (if any).
        // TODO: make messages translatable by using tokens instead of directly inserting dynamic content.
        $return_resources = $this->fleetMissionService->getResources($mission);
        if ($return_resources->sum() > 0) {
            $target_planet->addResources($return_resources);

            // Send message to player that the return mission has arrived
            // TODO: replace [planet] with coordinates if planet is not available.
            // TODO: move this message to a generic place? It is used in multiple mission types for the generic return of fleet message.
            $this->messageService->sendMessageToPlayer($target_planet->getPlayer(), 'Return of a fleet', 'Your fleet is returning from planet [planet]' . $mission->planet_id_from . '[/planet] to planet [planet]' . $mission->planet_id_to . '[/planet] and delivered its goods:
            
Metal: ' . $mission->metal . '
Crystal: ' . $mission->crystal . '
Deuterium: ' . $mission->deuterium, 'return_of_fleet');
        } else {
            // Send message to player that the return mission has arrived
            $this->messageService->sendMessageToPlayer($target_planet->getPlayer(), 'Return of a fleet', 'Your fleet is returning from planet [planet]' . $mission->planet_id_from . '[/planet] to planet [planet]' . $mission->planet_id_to . '[/planet].
                    
                    The fleet doesn\'t deliver goods.', 'return_of_fleet');
        }

        // Mark the return mission as processed
        $mission->processed = 1;
        $mission->save();
    }
}
