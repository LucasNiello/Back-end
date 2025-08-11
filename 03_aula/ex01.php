<!-- ###################### 
1.-->

<?php
//Solicita que o usuário digite a idade
echo "Digite sua idade: ";
$idade = fgets(STDIN); //Lê a entrada do usuario no terminal
if ($idade >= "18") {  // Verifica se é igual ou maior que 18
    echo "Você é maior de idade.";
} else { 
    echo "Você é menor de idade.";
}

?>

