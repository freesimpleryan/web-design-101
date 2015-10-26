
var letterSize = function(){
	this.x1 =  0;
	this.y1 = 0;
	this.x2 = 60;
	this.y2 = 80;
	
	this.newCoordinate = function(coord, value){
		switch(coord){
			case 'x1':
				this.x1 = value;
				break;
			case 'x2':
				this.x2 = value;
				break;
			case 'y1':
				this.y1 = value;
				break;
			case 'y2':
				this.y2 = value;
				break;
		}
	}
};
var htmlOut = '';
var rowMax = 9;
var col = 1;
var currentLetter = new letterSize();
var LETTER = new letterSize();

for(var i = 97; i < 123; i++){
	
	htmlOut += '<area alt="'+ String.fromCharCode(i) + 
		'" title="'+ String.fromCharCode(i) + 
		'" href="' + String.fromCharCode(i) + 
		'.html" shape="rect" coords="' +
			currentLetter.x1 + ',' +
			currentLetter.y1 + ',' +
			currentLetter.x2 + ',' +
			currentLetter.y2 +
		'"/>';
		
		currentLetter.newCoordinate('x1', currentLetter.x2);
		currentLetter.x2 += LETTER.x2;
		
		col++;
		if(col > rowMax){
			col = 1;
			currentLetter.newCoordinate('x1', LETTER.x1);
			currentLetter.newCoordinate('x2', LETTER.x2);
			currentLetter.newCoordinate('y1', currentLetter.y2);
			currentLetter.y2 += LETTER.y2;
		}
}

document.getElementById('oswaldmap').innerHTML = htmlOut;