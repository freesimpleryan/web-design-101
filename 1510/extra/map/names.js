var currentUrl = window.location.href;
var endPart = /\w\.html/;
var match = endPart.exec(currentUrl);
var letter = match[0].charAt(0);

document.title = letter.toUpperCase();
document.getElementById('heading').innerHTML = letter.toUpperCase();

var roster = [
'Bivins, Britainey',
 'Bonner, Aprille',
 'Broomfield, Kyle',
 'Brown, Ryan',
 'Carroll, Allie',
 'Curtis, Dakota',
 'Dagnan, Gregory',
 'Daise, Stephanie',
 'Davis, Andrea',
 'Dhanani, Shezan',
 'Gonzalez, Yesilyne',
 'Grady, Christopher',
 'Hall, Robert',
 'Ivey, Alissa',
 'Koumba, Carole',
 'Macy, Matthew',
 'Mohammed, Sabat',
 'Moncrief, Joshua',
 'Pagan, Dominique',
 'Pop, Jacob',
 'Pop, Matthew',
 'Rich, Gina',
 'Richardson, Carna',
 'Robinson, Kadeem',
 'Rodriguez Chacon, Harold',
 'Smith, Shelby',
 'Vaughan, Ashley'
];

var out = '';

for(var i = 0; i < roster.length; i++){
	if(roster[i].charAt(0).toLowerCase() === letter){
		out += "<li>" + roster[i] + "</li>";
	}
}

if(out == ''){
	out = "<li>No entries for this letter.</li>"
}

document.getElementById("studentNames").innerHTML = out;