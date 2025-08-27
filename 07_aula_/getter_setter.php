<?php 

class Pessoa {
    private $nome;
    private $cpf;
    private $telefone;
    private $idade;
    private $email;
    private $senha;

    public function __construct($nome, $cpf, $telefone, $idade, $email, $senha) {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setTelefone($telefone);
        $this->setIdade($idade);
        $this->email = $email;
        $this->senha = $senha;
    }

    public function setNome($nome) {
        $this->nome = ucwords(strtolower($nome));
    }
    public function getNome() {
        return $this->nome;
    }

    public function setCpf($cpf) {
        $this->cpf = preg_replace('/\D/', '', $cpf);
    }
    public function getCpf() {
        return $this->cpf;
    }

    public function setTelefone($telefone) {
        $this->telefone = preg_replace('/\D/', '', $telefone);
    }
    public function getTelefone() {
        return $this->telefone;
    }

    public function setIdade($idade){
        $this->idade = abs((int)$idade);
    }
    public function getIdade(){
        return $this->idade;
    }

    // Função para formatar CPF no padrão brasileiro
    private function formatarCpf(): string {
        $cpf = $this->getCpf();
        return substr($cpf,0,3) . '.' . substr($cpf,3,3) . '.' . substr($cpf,6,3) . '-' . substr($cpf,9,2);
    }

    // Função para formatar telefone no padrão brasileiro
    private function formatarTelefone(): string {
        $tel = $this->getTelefone();
        $len = strlen($tel);
        if ($len === 11) { // ex: 11987654321
            return '(' . substr($tel,0,2) . ') ' . substr($tel,2,5) . '-' . substr($tel,7,4);
        } elseif ($len === 10) { // ex: 1187654321
            return '(' . substr($tel,0,2) . ') ' . substr($tel,2,4) . '-' . substr($tel,6,4);
        } else {
            return $tel; // retorna como está se não tiver o tamanho esperado
        }
    }

    public function __toString(): string {
        return "Nome: " . ucwords(strtolower($this->getNome())) . "\n" .
               "CPF: " . $this->formatarCpf() . "\n" .
               "Telefone: " . $this->formatarTelefone() . "\n" .
               "Idade: " . $this->getIdade() . "\n" .
               "Email: " . strtolower($this->email) . "\n" .
               "Senha: " . $this->senha;
    }
}

// Criando um aluno
$aluno1 = new Pessoa(
    "lUCas terMINIellO", 
    "123.456.789-10", 
    "(11) 98765-4321", 
    -30, 
    "LuCaS@EmAiL.com", 
    "PalavraPasse123"
);

// Exibindo todas as informações diretamente
echo $aluno1;

?>
