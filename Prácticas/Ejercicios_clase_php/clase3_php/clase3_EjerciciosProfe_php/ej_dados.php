<html>
<head>
<style>
span{
	border: black 2px solid; padding: 10px; font-size: 300%;"
}
</style>
</head>
<body>
<?php
$dado1 = rand(1, 6);
$dado2 = rand(1, 6);
print "  <p>\n";
print "    <img src=\"img/$dado1.jpg\"  width=100 height=100>\n";
print "    <img src=\"img/$dado2.jpg\"  width=100 height=100>\n";
print "  </p>\n";
$suma=$dado1 + $dado2;
print "<span>$suma</span>";
?>
</body>