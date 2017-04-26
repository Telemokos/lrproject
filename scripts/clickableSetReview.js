//**Set the below variables as needed for the specific page **
var currentSetCode = "akh"; //The 3 letter code for the set to be displayed
var showRares = "false"; //Set to false until the Rares/Mythics review is up, once all cards are done, set to true
var pathToJSON = "scripts/sets/"; //Where the JSON files are stored
var pathToAudio = "audio/"; //Where the audio clips are stored
var pathToAnimations = "images/site/"; //Where the loading and sound animations are stored
var containerClassName = "cardsContainer"; //The class name of the container to be displayed and called - this needs to be the same in the HTML, CSS, and JS
//************

var currentPlayingID = null;
var numberOfCards = 0;
var cardsObject = [];
var sortedCards = [];
for(i=0;i<8;i++){
	sortedCards[i] = [];
}




$( document ).ready(function() {
	//Load the JSON data from the selected set, sort in WUBRG order, then display cards on page
	loadCardJSON();

	
	//When a card is clicked
	$(document).on("click",'.card',function(){
		//Call the playAudio function, passing the clicked object and the total number of cards value
		playAudio($(this), numberOfCards);
	});
	
	//Whenever an audio file stops playing, automatically stop the gif
	$(".audio-player")[0].addEventListener('ended', function(){
   			$(".animation").hide();
	});
	
	$(".audio-player")[0].addEventListener('loadeddata', function(){
   			$(".loadingAnimation").hide();
   			$("#animation_"+this.name).show();
	});
	
	
});

//Load the JSON file for the current set and assign the cards data to an array called CardsObject
function loadCardJSON(){
	//Read the cards from the JSON file and assign to a temp variable
	$.getJSON(pathToJSON+currentSetCode+".json", function(data) {
		//Assign the JSON card data to an array of cards
		cardsObject.push(data['cards']);
		
		//Sort the cards by color and save them to a sorted array
		sortData(cardsObject);
		
		//Loop through the sorted array and display each card into the HTML
		$.each(sortedCards, function(){
			$.each(this, function(){
				if(
					((this['layout'] == "aftermath") && (this['name'] == this['names'][0])) || (this['number'] <= 269)
				){
					if(showRares == "false"){
						switch(this['rarity']){
							case "Rare":	break;
							case "Mythic Rare":	break;
							default:	displayCard(this);
										numberOfCards++;
										break;
						}
					}else{
						displayCard(this);
						numberOfCards++;
					}
				}
			});
		});
			
	});
	
	
}
//sortData function, which takes an array of cards and sorts them in WUBRG order
function sortData(cardObject){
	//Loop through each card and assign it to the sorted array
	$.each(cardsObject[0], function(key, val){
				if(!this['manaCost'] && this['type'].indexOf("Land") == -1){
				}else{ //If a mana cost exists (i.e. not a back side of DFC)
					//Sort order W-U-B-R-G-C-L
					if(this['colors']){
						if(this['colors'] == "White"){
							sortedCards[0].push(this);
						}else if(this['colors'] == "Blue"){
							sortedCards[1].push(this);
						}else if(this['colors'] == "Black"){
							sortedCards[2].push(this);
						}else if(this['colors'] == "Red"){
							sortedCards[3].push(this);
						}else if(this['colors'] == "Green"){
							sortedCards[4].push(this);
						}else if(this['colors'].length > 1){ //If the card is multicolored
							sortedCards[5].push(this);
						}
					}
					else{
						if(!this['colors'] && this['types'] == "Artifact"){
							sortedCards[6].push(this);
						}else if(this['type'].indexOf("Basic") == -1){ 
							sortedCards[7].push(this);
						}
					}
				}
			});
}
//displayCard function, which takes a single card object and displays it on the page
function displayCard(cardObject){
	//Replace the string of the card name to escape spaces and special characters
	replacedName = cardObject.name.replace(/[^A-Z0-9]/ig, "")
	
	//If it's an aftermath card, adjust the name to "to"
	if(cardObject.layout == "aftermath"){
		replacedName = cardObject.names[0].concat("to"+cardObject.names[1]);	 
	}
	
	//Create a div in the HTML for the card
	$("<div />", {
		"id": 'card_'+numberOfCards+'_'+replacedName,
		"class": 'card'
	}).appendTo('#'+containerClassName);
	
	//Create the IMG tag for the card in the HTML
	$("<img />", {
		"id": 'img_'+replacedName,
		"class": 'cardImage',
		"src": "http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid="+cardObject.multiverseid+"&type=card"
	}).appendTo('#card_'+numberOfCards+'_'+replacedName);
	
	//Create the SoundBars animation gif on the card in the HTML
	$("<img />", {
		"id": 'animation_'+numberOfCards,
		"class": 'animation',
		"src": pathToAnimations+"soundbars.gif"
	}).appendTo('#card_'+numberOfCards+'_'+replacedName);
	
	//Create the Loading animation gif on the card in the HTML
	$("<img />", {
		"id": 'loading_'+numberOfCards,
		"class": 'loadingAnimation',
		"src": pathToAnimations+"loading.gif"
	}).appendTo('#card_'+numberOfCards+'_'+replacedName);
		
}
//playAudio function, which takes a clicked object and the total number of cards
function playAudio($this, numberOfCards){
	//Grab the card ID number from the HTML element ID of clicked object
	var id = $this.attr('id').substring($this.attr('id').indexOf("_")+1,$this.attr('id').indexOf("_",$this.attr('id').indexOf("_")+1));
	//Grab the card name from the HTML element ID of clicked object
	var cardname = $this.attr('id').substring($this.attr('id').lastIndexOf("_")+1, $this.attr('id').length);
	
	
	//Check if the audio player is currently PAUSED
	if($(".audio-player")[0].paused) {
				
		//Set the filename of the audio file of clicked card
		$(".audio-player")[0].src = pathToAudio+currentSetCode+"/"+ cardname + ".mp3";
		$(".audio-player")[0].name = id;
		//Reload the audio file
		$(".audio-player")[0].load();
		
		
		//if so, play the new clip
		$(".audio-player")[0].play();
		//Set the ID of the current playing card
		currentPlayingID = id;
		//...and start the animation
		//$("#animation_"+id).show();
		//When clicked, show the 'audio loading' gif
		$("#loading_"+id).show();
		
	}else{ //Check to see if the audio player is currently PLAYING

		//if so, pause the player
		$(".audio-player")[0].pause();
		//...reset the clip to the beginning
		$(".audio-player")[0].currentTime = 0;
		//...and pause all other animations that could be playing
		for(j=0;j<numberOfCards;j++){
			$("#animation_"+j).hide();
		}
		
		//Check if a DIFFERENT card was clicked
		if(id != currentPlayingID){
			//Set the filename of the audio file of clicked card
			$(".audio-player")[0].src = pathToAudio+currentSetCode+"/"+cardname + ".mp3";
			$(".audio-player")[0].name = id;
			//Reload the audio file
			$(".audio-player")[0].load();
			//play the new clip
			$(".audio-player")[0].play();
			//...and start the animation
			//Set the ID of the current playing card
			currentPlayingID = id;
			//When clicked, show the 'audio loading' gif
			$("#loading_"+id).show();
		
		}
	}
	
	
	
}