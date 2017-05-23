<?php

require 'BoardingCard.class.php';
require 'Trip.class.php';
						
$boardingCard = array();
$sortedBoardingCard = array();

$boardingCard[3] = new BoardingCard(Trip::$transportType[0],'78A','NA','45B','NA','Madrid','Barcelona','3');
$boardingCard[1] = new BoardingCard(Trip::$transportType[1],'NA','NA','NA','NA','Barcelona','Gerona Airport','1');
$boardingCard[0] = new BoardingCard(Trip::$transportType[2],'SK455','45B','3A','ticket counter 344','Gerona Airport','Stockholm','0');
$boardingCard[2] = new BoardingCard(Trip::$transportType[2],'SK22','22','7B','automatically transferred','Stockholm','New York JFK','2');
$boardingCard[4] = new BOardingCard(Trip::$transportType[0],'K102','NA','356','NA','Shanghai','Beijing','4');

$trip = new Trip($boardingCard);
$trip->prepare_boardingCard();
$trip->filter_boardingCards();
$trip->sort_boardingCards();

for($i=0;$i<count($boardingCard);$i++){
	echo "currentID:".$boardingCard[$i]->getCurrentID()."previewID:".$boardingCard[$i]->getPreviewID()."\""
			.$boardingCard[$i]->getDepart()."\" \"".$boardingCard[$i]->getArrive()."\" "."followID:"
			.$boardingCard[$i]->getFollowID()."<br/>";
}

$output_str = $trip->output_boardingCards();
echo $output_str;

?>