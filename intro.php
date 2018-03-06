<!DOCTYPE html>
<html>
<style>
div {
	margin-top: 20px;
	margin-bottom: 20px;
}
</style>
<body>
<h1>Hello world...</h1>
<?php 

# Comments can be doen with different symbols.
/* This is also possible */
// Dynamically writing down HTML statements.
echo "<p>hello world</p>";
echo "<div style='color: blue; font-size: 30px'>This is for testing PHP code.</div>";


// Variables start with $ sign.
// These are "global" variables
$a = 2;
$b = 5;
$c = "test";
$d = "hello";

// sometimes you need to case a variable type
// Concatenation of strings: use a dot (.)
echo "the value of a is " . $a . "<br>";

echo "a is " . (string)$a . "<br>";
echo "b is " . (string)$b . "<br>";
echo ("<br>");

// print is same to echo
print ("a+b = " . (string)($a+$b) . "<br>");
print ("a/b = " .(string)($a/$b) . "<br>");
print ("a%b = " .(string)($a%$b) . "<br>");
print ("a*b = " .(string)($a*$b) . "<br>");
echo ("<br>");
echo ($c . " " . $d);


// A function can be defined similar to JavaScript
function test_func($text){
	echo "<div><strong>This is the 'test_func' function.</strong></div>";
	echo "<div>" . $text . "</div>";
	// using a variable name inside a text also works..
	echo "<div>$text</div>";
	echo "<div></div>";
	echo "$d is a global variable, but cannot be accessed directly inside a function.";

	// once declared as "global" inside a function, you can access to it.
	global $d;	
	echo "<div>After decaring d as global: <strong>$d</strong>";

	// local variable.
	$local = 3;	
	echo "<div>$local is a local variable</div>";
	$local++;

	// static variable.
	static $static = 1;
	echo "<div>$static is a static variable</div>";
	$static++;
}

function ourFunction($sample) {
	echo "<br>The value of our parameter is " . $sample . "<br>";
	return $sample * 2;
}

$var = ourFunction(17);
echo $var . "<br>"; 
echo ourFunction(23) . "<br>"; 

$names = array('Rebecca', 'Nnamdi', 'Anna', 'Ben');
foreach ($names as $k => $r) {
	echo $r . " is in the room (index number " . $k . "). ";
}

$rawdata = array('Susquehana', 'Talbot', 'South Campus');
for ($i=0; $i < count($rawdata); $i++) { 
	echo $rawdata[$i] . " - " . $i . "<br>"; 
}

$x = array('First' => 'Rebecca', 'Last' => 'Follman')

test_func("first run.");
test_func("second run.");
test_func("thrid run.");
echo "<div>You cannot access to $local outside the function.</div>";

?>

</body>
</html>