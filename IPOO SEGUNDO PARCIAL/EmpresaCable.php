<?php

class EmpresaCable{
    private $colPlanes;
    private $colContratosRealizadosEmpresa;

    public function __construct($colPlanes, $colContratosRealizadosEmpresa){
        $this->colPlanes=$colPlanes;
        $this->colContratosRealizadosEmpresa=$colContratosRealizadosEmpresa;
    }
    public function getColPlanes(){
        return $this->colPlanes;
    }
    public function getColContratosRealizadosEmpresa(){
        return $this->colContratosRealizadosEmpresa;
    }
    public function setColPlanes($colPlanes){
        $this->colPlanes=$colPlanes;
    }
    public function setColContratosRealizadosEmpresa($colContratosRealizadosEmpresa){
        $this->colContratosRealizadosEmpresa=$colContratosRealizadosEmpresa;
    }
    public function retornarPlanes(){
        $cad="";
        $colPlanes=$this->getColPlanes();
        foreach($colPlanes as $unPlan){
            $cad.=$unPlan."\n";
        }
        return $cad;
    }
    public function retornarContratos(){
        $cad="";
        $colContratos=$this->getColContratosRealizadosEmpresa();
        foreach($colContratos as $unContrato){
            $cad.=$unContrato."\n";
        }
        return $cad;
    }
    public function __toString(){
        $cad="COLECCION DE PLANES:".$this->retornarContratos().
             "\nCOLECCION DE CONTRATOS REALIZADOS POR LA EMPRESA:\n".$this->retornarContratos();
        return $cad;
    }
    public function incorporarPlan($objPlan){
        $colPlanes=$this->getColPlanes();
        $encontrado=false;
        $i=0;
        while($i<count($colPlanes) && $encontrado==false){
            if($colPlanes[$i] == $objPlan){
                $encontrado=true;
            }
            $i++;
        }
        if($encontrado== false){
            $nuevoPlan=$objPlan;
            $colPlanes[]=$nuevoPlan;
            $this->setColPlanes($colPlanes);
        }
        return $encontrado;
    }
    public function incorporarContrato($objPlan,$objCliente,$fechaDesde,$fechaVenc,$esViaWeb){
            $costo=0;
            $seRennueva="";
            $colContratos=$this->getColContratosRealizadosEmpresa();
            if($this->incorporarPlan($objPlan)){
                if($esViaWeb == true){//$fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente
                    $nuevoContrato=new ContratoWeb($fechaDesde, $fechaVenc, $objPlan, $costo, $seRennueva, $objCliente); 
                    $colContratos[]=$nuevoContrato;
                    $this->setColContratosRealizadosEmpresa($colContratos);
                 }
                 else{//$fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente
                    $nuevoContrato=new ContratoOficina($fechaDesde, $fechaVenc, $objPlan, $costo, $seRennueva, $objCliente); 
                    $colContratos[]=$nuevoContrato;
                    $this->setColContratosRealizadosEmpresa($colContratos);
                 }
            }
    }
    public function retornarImporteContratos($codigoPlan){
        $importe=0;
        $colContratos=$this->getColContratosRealizadosEmpresa();
        foreach($colContratos as $unContrato){
            if($unContrato->getObjPlan()->getCodigo() == $codigoPlan){
                $importe+=$unContrato->calcularImporte();
            }
        }
        return $importe;
    }

    public function pagarContrato($objContrato){
        
        $dias=$objContrato->diasContratoVencido();
        if($objContrato->getEstado() == "AL DIA"){
            $importeFinal=$objContrato->calcularImporte();
            $estado="AL DIA";
           $objContrato->setEstado($estado);
        }
        elseif( $objContrato->getEstado() == "MOROSO"){
            $incremento=10/100;
            $multa=$objContrato->calcularImporte()*$incremento*$dias;
            $importeFinal=$objContrato->calcularImporte()+$multa;
            $estado="AL DIA";
            $objContrato->setEstado($estado);
        }
        else {
            $incremento=10/100;
            $multa=$objContrato->calcularImporte()*$incremento*$dias;
            $importeFinal=$objContrato->calcularImporte()+$multa;
            $estado="AL DIA";
            $objContrato->setEstado($estado);
            
        }
        return $importeFinal;
        
    }
}
?>