<?php

namespace Muqsit;

use pocketmine\plugin\PluginBase;
use pocketmine\level\particle\FlameParticle;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Spiral extends PluginBase implements Listener {
    
    public function onEnable() {
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->reloadConfig();
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
    
    public function onGenerate() {
        $cfg = $this->getConfig();
        $level = $cfg->get("world");
        $x = $cfg->get("x");
        $y = $cfg->get("y");
        $z = $cfg->get("z");
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
        $this->getLogger()->info("Spiral has been disabled.");
    }
    
}
