<?php
function suma($arg1, $arg2)
{
    return $arg1 + $arg2;
}

$a = 20;
$b = 30;
$suma = suma($a, $b);
print "<p>$a + $b = $suma</p>\n";
print "\n";
print "<p>$a + $b = " . suma($a, $b) . "</p>\n";
?>