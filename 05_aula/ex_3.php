<!-- 
3 __ Apos isso crie uma nova classe chamada 'usuario' com os atributos: Nome, CPF, Sexo, Email, Estao Civil, Cidade, Estado, Endereco e CEP.

4 __ Crie 3 objetos utilizando a classe do exercício 3, seguindo as seguintes
informações:
Usuário 1:
- Nome: Josenildo Afonso Souza
- CPF: 100.200.300-40
- Sexo: Masculino
- Email: josenewdo.souza@gmail.com
- Estado civil: Casado
- Cidade: Xique-Xique
- Estado: Bahia
- Endereço: Rua da amizade, 99
- CEP: 40123-98

Usuário 2:
- Nome: Valentina Passos Scherrer
- CPF: 070.070.060-70
- Sexo: Feminino
- Email: scherrer.valen@outlook.com
- Estado civil: Divorciada
- Cidade: Iracemápolis
- Estado: São Paulo
- Endereço: Avenida da saudade, 1942
- CEP: 23456-24

Usuário 3:
- Nome: Claudio Braz Nepumoceno
- CPF: 575.575.242-32
- Sexo: Masculino
- Email: Clauclau.nepumoceno@gmail.com
- Estado civil: Solteiro
- Cidade: Piripiri
- Estado: Piauí
- Endereço: Estrada 3, 33
- CEP: 12345-99
-->

<?php
class Usuario {

    public $Nome;
    public $CPF;
    public $Sexo;
    public $Email;
    public $EstadoCivil;
    public $Cidade;
    public $Estado;
    public $Endereco;
    public $CEP;

    public function __construct($Nome, $CPF, $Sexo, $Email, $EstadoCivil, $Cidade, $Estado, $Endereco, $CEP) {
        $this->Nome = $Nome;
        $this->CPF = $CPF;
        $this->Sexo = $Sexo;
        $this->Email = $Email;
        $this->EstadoCivil = $EstadoCivil;
        $this->Cidade = $Cidade;
        $this->Estado = $Estado;
        $this->Endereco = $Endereco;
        $this->CEP = $CEP;
    }

    public function exibirInfo() {
        echo "Nome: {$this->Nome}, CPF: {$this->CPF}, Sexo: {$this->Sexo}, Email: {$this->Email}, ";
        echo "Estado Civil: {$this->EstadoCivil}, Cidade: {$this->Cidade}, Estado: {$this->Estado}, ";
        echo "Endereço: {$this->Endereco}, CEP: {$this->CEP}<br>";
    }
}

// Criando os 3 usuários com os dados fornecidos
$usuarios = [
    new Usuario(
        "Josenildo Afonso Souza",
        "100.200.300-40",
        "Masculino",
        "josenewdo.souza@gmail.com",
        "Casado",
        "Xique-Xique",
        "Bahia",
        "Rua da amizade, 99",
        "40123-98"
    ),
    new Usuario(
        "Valentina Passos Scherrer",
        "070.070.060-70",
        "Feminino",
        "scherrer.valen@outlook.com",
        "Divorciada",
        "Iracemápolis",
        "São Paulo",
        "Avenida da saudade, 1942",
        "23456-24"
    ),
    new Usuario(
        "Claudio Braz Nepumoceno",
        "575.575.242-32",
        "Masculino",
        "Clauclau.nepumoceno@gmail.com",
        "Solteiro",
        "Piripiri",
        "Piauí",
        "Estrada 3, 33",
        "12345-99"
    )
];

// Exibindo as informações dos usuários
foreach($usuarios as $usuario){
    $usuario->exibirInfo();
}

?>
