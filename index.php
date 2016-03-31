<html>
	<head>
		<script src="scripts/jquery-2.1.4.min.js"></script>
		<script src="scripts/pageLoad.js"></script>
		<link rel="stylesheet" type="text/css" href="scripts/reset.css">
		<link rel="stylesheet" type="text/css" href="scripts/main.css">
	</head>
	<body>
	
		<?php
				$numberOfCards = 0; //Define the total number of cards
				$string = file_get_contents("scripts/sets/bfz.json"); //Load cardset JSON
				$json = json_decode($string, true); //Decode JSON into array object
				$cardsArray = array(
					"cards" => array() //Create a new array object called cardsArray which will hold our sorted and filtered cardset
				);
				
				//loop through the array, remove all basic lands and put cards into our custom sorted cardsArray
				foreach($json['cards'] as $card){ //Loop through MONO-WHITE CARDS
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if(((count($card['colors']) == 1) && ($card['colors'][0] == "White")) || ((is_null($card['colors']) && (strpos($card['manaCost'],'{W}')>=1)))){ //Check to see if cards are MONOWHITE
								array_push($cardsArray['cards'],$card); //add all of these cards to the custom sorted array
								
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through MONO-BLUE (w Devoid) CARDS
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( //Check to see if cards are MONOBLUE or BLUE DEVOID
								(
									(count($card['colors']) == 1) &&
									($card['colors'][0] == "Blue")
								) || 
								(
									(is_null($card['colors'])) &&
									(
										(strpos($card['manaCost'],'U}')>=1) &&
										(strpos($card['manaCost'], "W")===false) &&
										(strpos($card['manaCost'], "B")===false) &&
										(strpos($card['manaCost'], "R")===false) &&
										(strpos($card['manaCost'], "G")===false)
									)
								)
							){
								array_push($cardsArray['cards'],$card);
								
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through MONO-BLACK (w Devoid) CARDS
					
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( //Check to see if cards are MONOBLACK or BLACK DEVOID
								(
									(count($card['colors']) == 1) &&
									($card['colors'][0] == "Black")
								) || 
								(
									(is_null($card['colors'])) &&
									(
										(strpos($card['manaCost'],'B}')>=1) &&
										(strpos($card['manaCost'], "W")===false) &&
										(strpos($card['manaCost'], "U")===false) &&
										(strpos($card['manaCost'], "R")===false) &&
										(strpos($card['manaCost'], "G")===false)
									)
								)
							){
								array_push($cardsArray['cards'],$card);
								
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through MONO-RED (w Devoid) CARDS
					
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( //Check to see if cards are MONORED or RED DEVOID
								(
									(count($card['colors']) == 1) &&
									($card['colors'][0] == "Red")
								) || 
								(
									(is_null($card['colors'])) &&
									(
										(strpos($card['manaCost'],'R}')>=1) &&
										(strpos($card['manaCost'], "W")===false) &&
										(strpos($card['manaCost'], "U")===false) &&
										(strpos($card['manaCost'], "B")===false) &&
										(strpos($card['manaCost'], "G")===false)
									)
								)
							){
								array_push($cardsArray['cards'],$card);
								
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through MONO-GREEN (w Devoid) CARDS
					
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( //Check to see if cards are MONOGREEN or GREEN DEVOID
								(
									(count($card['colors']) == 1) &&
									($card['colors'][0] == "Green")
								) || 
								(
									(is_null($card['colors'])) &&
									(
										(strpos($card['manaCost'],'G}')>=1) &&
										(strpos($card['manaCost'], "W")===false) &&
										(strpos($card['manaCost'], "U")===false) &&
										(strpos($card['manaCost'], "B")===false) &&
										(strpos($card['manaCost'], "R")===false)
									)
								)
							){
								array_push($cardsArray['cards'],$card);
								
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through MULTICOLORED (w Devoid) CARDS
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( //Check to see if cards are MULTICOLORED or MULTICOLOR DEVOID
								(count($card['colors']) > 1) ||
								(
									(count($card['colors']) < 1) &&
									(
										((strpos($card['manaCost'],'W')>=1) && (strpos($card['manaCost'],'U')>=1)) ||
										((strpos($card['manaCost'],'U')>=1) && (strpos($card['manaCost'],'B')>=1)) ||
										((strpos($card['manaCost'],'B')>=1) && (strpos($card['manaCost'],'R')>=1)) ||
										((strpos($card['manaCost'],'R')>=1) && (strpos($card['manaCost'],'G')>=1)) ||
										((strpos($card['manaCost'],'G')>=1) && (strpos($card['manaCost'],'W')>=1)) ||
										((strpos($card['manaCost'],'W')>=1) && (strpos($card['manaCost'],'B')>=1)) ||
										((strpos($card['manaCost'],'U')>=1) && (strpos($card['manaCost'],'R')>=1)) ||
										((strpos($card['manaCost'],'B')>=1) && (strpos($card['manaCost'],'G')>=1)) ||
										((strpos($card['manaCost'],'R')>=1) && (strpos($card['manaCost'],'W')>=1)) ||
										((strpos($card['manaCost'],'G')>=1) && (strpos($card['manaCost'],'U')>=1))
									)
								)
							){
								array_push($cardsArray['cards'],$card);
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through COLORLESS (non artifact/land) CARDS				
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( (count($card['colors']) < 1) && ( //Check to see if cards are NON-ARTIFACT NON-LAND COLORLESS
								(strpos($card['manaCost'], "W")===false) &&
								(strpos($card['manaCost'], "U")===false) &&
								(strpos($card['manaCost'], "B")===false) &&
								(strpos($card['manaCost'], "R")===false) &&
								(strpos($card['manaCost'], "G")===false)
								) ){
									if(strpos($card['type'],'Land') !== 0){
										if(strpos($card['type'],'Artifact') !== 0){
											array_push($cardsArray['cards'],$card);
										}
									}
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through ARTIFACT CARDS
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( (count($card['colors']) < 1) && ( //Check to see if cards are ARTIFACTS
								(strpos($card['manaCost'], "W")===false) &&
								(strpos($card['manaCost'], "U")===false) &&
								(strpos($card['manaCost'], "B")===false) &&
								(strpos($card['manaCost'], "R")===false) &&
								(strpos($card['manaCost'], "G")===false)
								) ){
									if(strpos($card['type'],'Land') !== 0){
										if(strpos($card['type'],'Artifact') !== false){
											array_push($cardsArray['cards'],$card);
										}
									}
							}
						//}
					}
					
				}
				foreach($json['cards'] as $card){ //Loop through LAND CARDS
					if(strpos($card['type'],'Basic Land') !== 0){ //Remove Basic Lands
						//if(($card['rarity'] == "Common") || ($card['rarity'] == "Uncommon")){ //Remove all but Commons and Uncommons
							if( (count($card['colors']) < 1) && ( //Check to see if cards are LANDS
								(strpos($card['manaCost'], "W")===false) &&
								(strpos($card['manaCost'], "U")===false) &&
								(strpos($card['manaCost'], "B")===false) &&
								(strpos($card['manaCost'], "R")===false) &&
								(strpos($card['manaCost'], "G")===false)
								) ){
									if(strpos($card['type'],'Land') !== false){
											array_push($cardsArray['cards'],$card);
									}
							}
						//}
					}
					
				}
				
		?>

		<audio class ="audio-player" name=" " src=" " ></audio> <!-- Define the audio player with an empty source, the audio files will be loaded on demand -->
		<div id="container">
			<p>Click on any card to play the selected clip from the <a href='http://www.lrcast.com' target='_blank'>Limited Resources</a> set review</p>
			<p>This is a volunteer project to support the Limited Resources Podcast. Please support the show & sponsors at <a href='http://www.lrcast.com' target='_blank'>lrcast.com</a> and <a href='http://www.channelfireball.com' target='_blank'>ChannelFireball.com</a></p>
			<?php 
				foreach($cardsArray['cards'] as $card){ //Loop through each card in our custom sorted cardsArray, display the card div with its image and overlay a hidden animation
			?>	
				
			<div id='card_<?php echo $numberOfCards;?>_<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $card['name']));?>' class="card">
				<img class="cardImage" id="img_<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $card['name']))?>" src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=<?php echo $card['multiverseid']?>&type=card" />
				<img class="animation" id="animation_<?php echo $numberOfCards;?>" src="images/site/soundbars.gif" />
				<img class="loadingAnimation" id="loading_<?php echo $numberOfCards;?>" src="images/site/loading.gif" />
			</div>
			
			<?php 
				$numberOfCards = $numberOfCards + 1; //Incremenet the total number of cards
				} //end foreach loop
			?>
			<input id="numberOfCards" type="hidden" value="<?php echo $numberOfCards;?>" />  <!-- Set the total number of cards so our Javascript can access it -->
		</div>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68481314-1', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>