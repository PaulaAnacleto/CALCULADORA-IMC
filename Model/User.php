<?php
    namespace Model;

    use Model\Connection;

    use PDO;
    use PDOException;

    class User {
        private $db;

        /**
         * MÉTODO QUE IRÁ SER EXECCUTADO TODA VEZ QUE 
         * FOR CRIADO UM OBJETO DA CLASSE -> USER 
         */

        public function __construct() {
            $this->db = Connection::getInstance();
        }

        //FUNÇÃO CRIAR USUÁRIO
        public function registerUser($user_fullname, $email, $password) {
            try {
                //INSERÇÃO DE DADOS NA LINGUGEM SQL
                $sql = 'INSERT INTO user (user_fullname, email, password, created_at) VALUES (:user_fullname, :email, :password, NOW())';

                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                
                //PREPARA O BANCO DE DADOS PARA RECEBER O COMANDO ACIMA ]
                $stmt = $this->db->prepare($sql);

                //REFERENCIAR OS DADOS PASSADOS PELO COMANDO SQL COM PARAMETROS DA FUNÇÃO 
                $stmt->bindParam(':user_fullname', $user_fullname, PDO::PARAM_STR);
                $stmt->bindParam(':email', $user_fullname, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashPassword, PDO::PARAM_STR);

                //EXECUTAR TUDO 
                $stmt->execute();
                //EXIBIR MENSAGEM DE ERRO COMPLETA E PARRAR A EXECUÇÃO 
            } catch (PDOException $error) {
                echo "Erro ao executar o comando: " . $error->getMessage();
                return false; 
        }

    }
}

?>