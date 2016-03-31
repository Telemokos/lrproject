# lrproject
The project for the clickable LR Set Review

The purpose of this script is to provide a simple card-by-card view of each card in a new set, and play the short audio clip from the Limited Resources set review specific to that one card.

This script uses Jquery.

Folder Structure:

/

/scripts

/scripts/sets

/images

/images/site

/audio

/audio/bfz


Revelvant Files:

1. index.php - The only relevant part of this file is the container class where the card images should go and an HTML5 audio tag that can be called from the javascript.
2. scripts/clickableSetReview.js - This is the primary code where the JSON is read, the images are created, and the audio is played
3. scripts/clickableSetReview.css - This is where a few elements are stylized
4. scripts/sets/bfz.json - This is an example of one set's JSON object that is called by the javascript - these should be named the 3 letter code of the set
5. audio/bfz/.. - This is the directory where the audio clips should be stored, the folder name matches the 3 letter code and the clip names should be the card names with spaces and special characters escaped.
6. images/site/.. - This is where the 'loading' and 'playing' gifs are stored. Honestly these gifs are pretty bad and should probably be replaced at some point.

Defining variables and paths:
All paths and important names are dynamic and are assigned at the top of the clickableSetReview.js file - this is where you should set the following:

1. The current 3 letter set code
2. file path to the JSON objects folder
3. file path to the Audio clips folder
4. file path to the animations folder
5. class name for the parent container for the cards


