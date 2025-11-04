<?php
// Concepto de contador:
$cont = 0; //Inicializamos el contador
for ($i = 0; $i < 9; $i++) {
    $dado = rand(1, 6);
  
    print "<img src='/img/$dado.jpg' width=100 height=100>\n"; 
    if ($dado == 2) {
        $cont++;//cont=cont+1
    }
}
print "<h1>Han salido $cont dos(es).</h1>\n";
?>