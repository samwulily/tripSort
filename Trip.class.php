<?php

class Trip
{
	public static $transportType = array('train','bus','flight','boat');
	private $depart;
	private $arrive;
	private $boardingCards_num;
	private $boardingCards;
	private $sorted_boardingCards;
	
	public function __construct($boardingCards){
		$this->boardingCards = $boardingCards;
		$this->boardingCards_num = count($boardingCards);
		$this->sorted_boardingCards = array();
	}
	
	public function prepare_boardingCard(){
		for($i=0;$i<$this->boardingCards_num;$i++){
			for($j=$i+1;$j<$this->boardingCards_num;$j++){
				if(strcmp($this->boardingCards[$i]->getDepart(),$this->boardingCards[$j]->getArrive())==0){
					$this->boardingCards[$i]->setPreviewID($this->boardingCards[$j]->getCurrentID());
					$this->boardingCards[$j]->setFollowID($this->boardingCards[$i]->getCurrentID());
				}
				if(strcmp($this->boardingCards[$i]->getArrive(),$this->boardingCards[$j]->getDepart())==0){
					$this->boardingCards[$i]->setFollowID($this->boardingCards[$j]->getCurrentID());
					$this->boardingCards[$j]->setPreviewID($this->boardingCards[$i]->getCurrentID());
				}
			}
		}
	}
	
	/*
	This function get rid of the boarding card which was not in the trip, get the start and the end of the trip 
	*/
	public function filter_boardingCards(){
		for($i=0;$i<$this->boardingCards_num;$i++){
			if(strcmp($this->boardingCards[$i]->getPreviewID(),"-1")==0
			 &&strcmp($this->boardingCards[$i]->getFollowID(),"-1")==0){	//	this boarding card was not in the trip, drop it
				unset($this->boardingCards[$i]);
				continue;
			}
			if(strcmp($this->boardingCards[$i]->getPreviewID(),"-1")==0
			 &&strcmp($this->boardingCards[$i]->getFollowID(),"-1")!=0){	
			 //	this boarding card was the start of the trip, push this card into the sorted cards and remove it from the original cards
				$this->depart = $this->boardingCards[$i]->getDepart();
				array_push($this->sorted_boardingCards,$this->boardingCards[$i]);
				unset($this->boardingCards[$i]);
			}
		//	if(strcmp($this->boardingCards[$i]->getPreviewID(),"-1")!=0
		//	 &&strcmp($this->boardingCards[$i]->getFollowID(),"-1")==0){	//	this boarding card was the end of the trip
		//		$this->arrive = $this->boardingCards[$i]->getArrive();
		//	}
		}
	}
	
	public function sort_boardingCards(){
		
		while(count($this->boardingCards)!=0){
			$sorted_last_card = end($this->sorted_boardingCards);
			foreach($this->boardingCards as $key => $val){
				if(strcmp($val->getDepart(),$sorted_last_card->getArrive())==0){
					array_push($this->sorted_boardingCards,$val);
					unset($this->boardingCards[$key]);
				}
			}
		}
	}
	
	public function output_boardingCards()
    {
		
        foreach ($this->sorted_boardingCards as $key => $val) {
            $stack[] = "Take " . $val->getTransType() ." ".$val->getNum(). " from " . $val->getDepart() . " to " . $val->getArrive() .
            	" Gate:".$val->getGate()." The seat is: " . $val->getSeat()." Baggage:".$val->getBaggage()."<br/>";
        }
        $final = implode("\n", $stack);

        return $final;
    }
	
	public function output_ori_boardingCards(){
		for($i=0;$i<count($this->boardingCards);$i++){
			echo "currentID:".$this->boardingCards[$i]->getCurrentID()."previewID:".$this->boardingCards[$i]->getPreviewID()."\""
			.$this->boardingCards[$i]->getDepart()."\" \"".$this->boardingCards[$i]->getArrive()."\" "."followID:"
			.$this->boardingCards[$i]->getFollowID()."<br/>";
		}
	}
}

?>