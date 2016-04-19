<?php

namespace Muqsit;

use pocketmine\plugin\PluginBase;
use pocketmine\level\particle\FlameParticle;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\Listener;

class Spiral extends PluginBase implements Listener {
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Spiral has been enabled.");
    }
    
    /*
    255,0,0,1 - Red
    0,255,0,1 - Green
    0,0,255,1 - Blue
    192,192,192,1 - Gray
    255,255,0,1 - Yellow
    255,0,255,1 - Magenta
    */
    
    public function onMove(PlayerMoveEvent $event) {
        $sender = $event->getPlayer();
        $level = $sender->getLevel();
        $x = $sender->getX();
        $y = $sender->getY();
        $z = $sender->getZ();
        $center = new Vector3($x, $y, $z);
        $particle = new FlameParticle($center);
        for($yaw = 0, $y = $center->y; $y < $center->y + 4; $yaw += (M_PI * 2) / 20, $y += 1 / 20) {
            $x = -sin($yaw) + $center->x;
            $z = cos($yaw) + $center->z;
            $particle->setComponents($x, $y, $z);
            $level->addParticle($particle);
        }
    }
    
    public function onDisable() {
        $this->getLogger()->info("SpiralParticle has been disabled.");
    }
    
}
