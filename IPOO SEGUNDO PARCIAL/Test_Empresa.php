<?php
    include_once "Canal.php";
    include_once "Cliente.php";
    include_once "Contrato.php";
    include_once "ContratoWeb.php";
    include_once "ContratoOficina.php";
    include_once "EmpresaCable,php";
    include_once "Plan.php";

    //$colPlanes, $colContratosRealizadosEmpresa
    $colPlanes=[];
    $colContratosRealizadosEmpresa=[];
    $objEmpresaCable= new EmpresaCable($colPlanes, $colContratosRealizadosEmpresa);

    //$tipo, $importe, $esHD,$incluyeMG
    $objCanal1= new Canal("deportivo", 100, "si", "si");//noticias, interés general, musical, deportivo, películas, educativo, infantil, educativo infantil, aventura.
    $objCanal2= new Canal("noticias", 100, "no", "no");
    $objCanal3= new Canal("musical", 100, "si", "si");
    
    //$codigo, $colCanales, $importe
    $colCanales=[$objCanal1, $objCanal2, $objCanal3];
    $objPlan1= new Plan(111, $colCanales , 500);
    $objPlan2= new Plan(100, $colCanales , 500);
    $colPlanes=[$objPlan1, $objPlan2];
    $objEmpresaCable->setColPlanes($colPlanes);

    //$denominacion, $cuit, $direccion
    $objCliente= new Cliente( 12345, 123457, "santa fe 200");

    //$fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente
    $fechainicio=date("d-m-y");
    $fechaVencimiento="12-07-2024";
    $objContrato1= new ContratoOficina($fechaInicio,$fechaVencimiento, $objPlan1, 200, 0, $objCliente );
    $objContrato2= new ContratoWeb($fechaInicio,$fechaVencimiento, $objCanal1, 200, 0, $objCliente );
    $objContrato3= new ContratoWeb($fechaInicio,$fechaVencimiento, $objPlan2, 200, 0, $objCliente);
    
    // invocamos al metodo calcularimporte
    $importe=$objContrato1->calcularImporte();
    echo "el Contrato 1 tiene un importe del $".$importe."\n";

    $importe=$objContrato2->calcularImporte();
    echo "el Contrato 2 tiene un importe del $".$importe."\n";

    $importe=$objContrato3->calcularImporte();
    echo "el Contrato 3 tiene un importe del $".$importe."\n";

    //invocamos IncorporarPlan
    $objEmpresaCable->incorporarPlan($objPlan1);
    $objEmpresaCable->incorporarPlan($objPlan1);

    //invocamos al metodo incoporar Contrato
    $objEmpresaCable->incorporarContrato($objPlan1, $objCliente, date("d-m-y"), $fechaVencimiento, false);
    $objEmpresaCable->incorporarContrato($objPlan1, $objCliente, date("d-m-y"), $fechaVencimiento, true);
    
    //invocamo al metodo Pagar contrato
    $objEmpresaCable->pagarContrato($objContrato1);
    $objEmpresaCable->pagarContrato($objContrato2);

    //invocamos al metodo retornar importe contratos
    $objEmpresaCable->retornarImporteContratos(111);
