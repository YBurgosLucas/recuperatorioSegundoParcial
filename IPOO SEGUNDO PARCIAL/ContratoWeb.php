<?php

    class ContratoWeb extends Contrato{
        private $porcentajeDescuento;
        
        public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){

            parent::__construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);
            $this->porcentajeDescuento=10;

        }
        public function getPorcentajeDescuento(){
            return $this->porcentajeDescuento;
        }
        public function setPorcentajeDescuento($porcentajeDescuento){
            $this->porcentajeDescuento=$porcentajeDescuento;
        }
        public function __toString(){
            $cad=parent::__toString();
            return $cad;
        }
        public function calcularImporte(){
            $importeFinal=parent::calcularImporte();
            $porcentajeDescuento=$this->getPorcentajeDescuento()/100;
            $importeFinal=$importeFinal-($importeFinal*$porcentajeDescuento);
            return $importeFinal;
        }
    }