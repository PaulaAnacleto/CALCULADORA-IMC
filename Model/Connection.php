<?php
    //CONFIGURAÇÃO DE USO

    //EXEMPLO DE USO EM OUTRAS CLASSES = use Model\Connection;
    namespace Model;
    //IMPORTAÇÃO PARA COONEXÃO COM O BANCO DE DADOS
    use PDO;
    use PDOException;
    // BUSCANDO DADOS DE CONFIGURAÇÃO DDO BANCO DE DADOS
    require __DIR__ . '../Config/configuration.php';

    class Connection {
        //ATRIBUTO ESTATICO QUE IRÁ PERMITIR A CONEXÃO ABAIXO 
        private static $stmt;

        //CONEXÃO COM O BANCO DE DADOS
        public static function getInstance() {
            // CRIANDO UMA NOVA CONEXÃO SOMENTE SE A CONEXÃO NÃO EXISTIR
            try{
                if(empty(self::$stmt)){
                    self::$stmt = new PDO("mysql:host=" . DB_HOST . ";port" . DB_PORT . ";dbname=" . DB_NAME . "", DB_USER, DB_PASSWORD);
                }
            } catch (PDOException $error) {
                die("Erro ao estabelecer conexão: " . $error->getMessage());
            } 
            return self::$stmt;
        }
    }
?>