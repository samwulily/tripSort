<?php
class BoardingCard
{
	private $currentID;
	private $previousID;
	private $followID;
	private $transType;
	private $num;
	private $gate;
	private $seat;
	private $baggage_info;
	private $depart;
	private $arrive;
	
	public function __construct($trans_type,$num,$gate,$seat,$baggage,$depart,$arrive,$currentID){
		$this->transType = $trans_type;
		$this->num = $num;
		$this->gate = $gate;
		$this->seat = $seat;
		$this->baggage_info = $baggage;
		$this->depart = $depart;
		$this->arrive = $arrive;
		$this->currentID = $currentID;
		$this->previousID = -1;
		$this->followID = -1;
	}
	
	public function getTransType(){
		return $this->transType;
	}
	
	public function getNum(){
		return $this->num;
	}
	
	public function getGate(){
		return $this->gate;
	}
	
	public function getSeat(){
		return $this->seat;
	}
	
	public function getBaggage(){
		return $this->baggage_info;
	}
	
	public function getDepart(){
		return $this->depart;
	}
	
	public function getArrive(){
		return $this->arrive;
	}
	
	public function getCurrentID(){
		return $this->currentID;
	}
	
	public function getPreviewID(){
		return $this->previousID;
	}
	
	public function getFollowID(){
		return $this->followID;
	}
	
	public function setPreviewID($previousID){
		$this->previousID = $previousID;
	}
	
	public function setFollowID($followID){
		$this->followID = $followID;
	}
}
?>