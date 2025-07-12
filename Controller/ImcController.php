<?php

    namespace Controller;

    use Model\Imcs; // importa a classe Imcs do namespace Model para manipulação de IMC

    use Exception;
    class ImcController{
        private $imcsModel;

        public function __construct(){
            $this->imcsModel = new Imcs();
        }
        //CALCULO E CLASSIFICAÇÃO 
        public function calculateImc($weight, $height) {
            try {
                /**
                 * result = [
                 * "imc" : 22.82,
                 * "BMIrage" : "Sobrepeso"
                 * ];
                 */

                 $result = [];
                 if(isset($weight) or isset($height)){
                    if($weight > 0 and $height > 0){
                        $imc = round($weight / ($height * $height),2);
                        $result['imc'] = $imc;

                        $result["BMIrange"] = match(true) {
                            $imc < 18.5 => "Abaixo do peso",
                            $imc >= 18.5 and $imc < 24.9 => "Peso normal",
                            $imc >= 25 and $imc < 29.9 => "Sobrepeso",
                            $imc >= 30 and $imc < 34.9 => "Obesidade grau I",
                            $imc >= 35 and $imc < 39.9 => "Obesidade grau II",
                            default => "Obesidade grau III ou mórbida"
                        };
                    }else {
                        $result["BMIrange"] = "O peso e a altura devem conter valores positivos.";
                    }

                 }else {
                     $result["BMIrange"] = "Por favor, informe o peso e a altura para obter o seu IMC.";
                 } return $result;
            }
            catch(Exception $error) {
                echo "Erro ao calcular IMC: " . $error->getMessage();
                return false; // retorna falso se ocorrer um erro
            }
        }

        public function saveImc($weight, $height, $IMCresult) {
            return $this->imcsModel->createImc($weight, $height, $IMCresult);
        }
    }  
?>