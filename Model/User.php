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
                
                //PREPARA O BANCO DE DADOS PARA RECEBER O COMANDO ACIMA ]
                $stmt = $this->db->prepare($sql);

                //REFERENCIAR OS DADOS PASSADOS PELO COMANDO SQL COM PARAMETROS DA FUNÇÃO 

                EXECUTAR TUDO 
            } catch (PDOException $error) {
        }

    }
}

?>