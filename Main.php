<?php

namespace StaffListUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	
   public function onEnable(){
       $this->getLogger()->info(C::GREEN . "StaffListUI by SigitGamers Aktif!");
       
       @mkdir($this->getDataFolder());
       $this->saveDefaultConfig();
       $this->getResource("config.yml");
   }

   public function onLoad(){
       $this->getLogger()->info(C::YELOW . "Memuat....");
   }

   public function onDisable(){
       $this->getLogger()->info(C::RED . "StaffListUI by SigitGamers Mati!");
   }

   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
       switch($cmd->getName()) {
             case "sui":
                 if($sender instanceof Player) {
                    $this->openStaffUI($sender);
                    return true;
                 }
       }
       return true;
   }
   
   public function openStaffUI($sender){
   	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
           $result = $data;
           if($result === null){
               return true;
           }             
           switch($result){
               case 0:
               break;
               }
           });
           $form->setTitle($this->getConfig()->get("Staff-Title"));
           $form->setContent($this->getConfig()->get("Staff-info"));
           $form->addButton($this->getConfig()->get("Kembali"));
           $form->sendToPlayer($sender);
           return $form;
   }
}
