<?php
namespace Ignacio\Custombar;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

	public function onEnable()
	{
		$this->getScheduler()->scheduleRepeatingTask(new SendTipTask($this), 20);
	}

	public function getPreciseCPS() : \luca28pet\PreciseCpsCounter\Main{
		/** @var \luca28pet\PreciseCpsCounter\Main $api */
		$api = $this->getServer()->getPluginManager()->getPlugin("PreciseCpsCounter");
		return $api;
	}

	public function Custombar(){
		$pl = $this->getServer()->getOnlinePlayers();

		$playersOnline = count($pl);
		$maxOnline = $this->getServer()->getMaxPlayers();

		$tps = $this->getServer()->getTicksPerSecond();
		$load = $this->getServer()->getTickUsage();

		foreach($pl as $p) {
			$mehcps = $this->getPreciseCPS()->getCps($p);

			if($mehcps > 2) {
				$msg = TextFormat::colorize("&fCPS: &c$mehcps [&d&lRival&fMC&r] &fOnline: &c$playersOnline&f/&c$maxOnline");
			} else {
				$msg = TextFormat::colorize("&fPing: &c" . round($p->getPing() * 0.8) . "&fms [&d&lRival&fMC&r] &fOnline: &c$playersOnline&f/&c$maxOnline \n");
			}
			$p->sendTip($msg);
		}
	}
}