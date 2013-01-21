<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<select name="vote" id="vote" onchange="alert(this.text)">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
<input type="button" value="vote" onclick="castvote();">
<input type="text" value="castvote();"  />


<script type="text/javascript" >

function castvote() {
    var mySelect = document.getElementById("vote"); 
    (mySelect.options[mySelect.selectedIndex].value); 
}

</script>
</body>
</html>