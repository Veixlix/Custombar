<?php
namespace Ignacio\Custombar;

use pocketmine\scheduler\Task;

class SendTipTask extends Task{
	public $main;
	public function __construct(Main $main)
	{
		$this->main = $main;
	}

	public function onRun(int $currentTick)
	{
		$this->main->Custombar();
	}
}