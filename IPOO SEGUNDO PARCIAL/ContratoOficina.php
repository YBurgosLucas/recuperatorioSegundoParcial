<?php
    class ContratoOficina extends Contrato{
        public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){
            parent::__construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);

        }
        public function __toString(){
            $cad=parent::__toString();
            return $cad;
        }

    }