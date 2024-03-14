<?php 

/*
Autor: Thiago Mota
E-mail: thiagomotaita1@gmail.com
*/

// TESTE YMONETIZE - QUESTÃO 4
/*
Desenvolva uma função em PHP para validar e filtrar dados de entrada sensíveis, como senhas, utilizando as melhores práticas de segurança. Considere aspectos como proteção contra ataques de injeção e manipulação maliciosa.
*/

class UserService
{
    protected $_email;
    protected $_password;

    protected $_db;
    protected $_user;

    // Construtor
    public function __construct(PDO $db, $email, $password) 
    {
       $this->_db = $db;
       $this->_email = $email;
       $this->_password = $password;
    }

    // Método de validação de login
    public function login()
    {
        $user = $this->_checkCredentials();
        if ($user) {
            $this->_user = $user;
            $_SESSION['user_id'] = $user['id'];
            return $user['id'];
        }
        return false;
    }

    // Verifica as credenciais para acesso
    /* 
    Neste exemplo, coloquei nome de tabela e coluna com caracteres diferentes;
    Também fiz o tratamento para SQL Injection
    */
    protected function _checkCredentials()
    {
        // Aqui, usei o PDO prepared para evitar o SQL Injection (Uma das maneiras de ataque)
        $stmt = $this->_db->prepare('SELECT email_tm, name_tm FROM tb_user_tm WHERE email_tm = ?');
        $stmt->execute(array($this->email_tm));
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Neste ponto, usei o sha1 para criptografar as senhas dos usuários
            // Usei o salt para evitar que senhas idênticas produzam o mesmo hash
            $submitted_pass = sha1($user['salt'] . $this->_password);
            if ($submitted_pass == $user['password_tm']) {
                return $user;
            }
        }
        return false;
    }
}


// Conexão com o Banco de dados local
$pdo = new PDO('mysql:dbname=simple_db', 'thiagomota', 'fSyTVR!OnKSPs');

// Chamamos o serviço de login após preenchimento do formulário de login
// Neste caso, não desenvolvi a página HTML com o formulário, pois o propósito do teste não é esse
$userService = new UserService($pdo, $_POST['email'], $_POST['password']);
if ($user_id = $userService->login()) {
    echo ('Logged it as user id: '.$user_id."<hr/>");
    echo ('You are logged!');
} else {
    echo ('Invalid login');
}

?>