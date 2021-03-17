<?php
$lista = file('br-utf8.txt');
//removendo palavras com mais de 10 caracteres da lista
foreach($lista as $key => $item) {
    $item = trim($item);
    $l = mb_strlen($item, 'utf8');
    if($l >= 10) { //removendo palavras muito longas
        unset($lista[$key]);
    } else {
        $lista[$key] = $item;
    }
}
sort($lista);
$total = count($lista);

//pegar a primeira palavra
$key = rand(0, count($lista) -1);
$frase = $lista[$key];
$palavras_aceitas = [];
$letras_usadas = [];

//echo "começando com {$frase}\r\n";
$palavras_aceitas[] = $frase;
$letras_usadas = str_split($frase);

$testes = 0;
while(mb_strlen($frase, 'utf8') != 10) {
    $aceitar = false;
    //pega outra palavra aleatoria
    $key = rand(0, count($lista) -1);
    $tmp = ($lista[$key]);
    
    //se juntar a palavra na frase, e for menor ou igual a 10, alterar a frase
    $teste = $frase.$tmp;
    $comprimento = mb_strlen($teste, 'utf8');
    if($comprimento <= 10) {
        $aceitar = true;
    }
    
    $letras = str_split($tmp);
    foreach($letras as $l) {//se já repetiu uma das letras, não aceitar
        if(in_array($l, $letras_usadas)) {
            $aceitar = false;
        }
    }
    
    if($aceitar) {
//        echo "aceitou {$tmp}.\r\n";
        $frase .= $tmp;
        $palavras_aceitas[] = $tmp;
    }
    
    $testes++;
    
    if($testes == $total) {
//        echo "não deu.";
        exit;
    }
}

echo implode(' ', $palavras_aceitas)."\r\n";