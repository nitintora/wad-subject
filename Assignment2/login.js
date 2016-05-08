var xHRObject = false;

if (window.XMLHttpRequest)
    xHRObject = new XMLHttpRequest();
else if (window.ActiveXObject)
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

function retrieveInformation() 
{
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var type = "";
	var input = document.getElementsByTagName("input");
	for (var i=0; i < input.length; i++)
	{ 
	    if (input.item(i).value != null)
	        type = input.item(i).value;
	}
      xHRObject.open("GET", "loginRetrieve.php?id=" + Number(new Date) +"&email=" +email + "&password=" + password + "&type=" +type, true);
      xHRObject.onreadystatechange = function() {
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
               document.getElementById('information').innerHTML = xHRObject.responseText;
      }
      xHRObject.send(null); 
}









