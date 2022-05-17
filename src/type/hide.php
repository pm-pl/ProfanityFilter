<?php

namespace xqwtxon\HiveProfanityFilter\type;

use xqwtxon\HiveProfanityFilter\Main;
use xqwtxon\HiveProfanityFilter\utils\language;
use xqwtxon\HiveProfanityFilter\utils\config_manager;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\Event;

class hide implements Listener {
	private language $lang;
	private config_manager $config;
	public function __construct(Main $plugin){
		$this->lang = $lang;
		$this->config = $config;
	}
	public function onChat(PlayerChatEvent $ev) :void {
		$chat_format = $ev->getFormat();
		$msg = $ev->getMessage();
		$player = $ev->getPlayer();
		$playerName = $player->getName();
		$words = array_map("strtolower", $this->config->banned_words()->get("banned-words"), []));
		if (in_array($words), $msg){
			$ev->cancel();
			// HIVE TRICK FOR HIDING MESSAGE ;)
			// IT WILL DONT BROADCAST TO OTHER PLAYERS INSTEAD FROM YOU.
			$player->sendMessage($chat_format . " " . $message);
		}
	}
	
	
}