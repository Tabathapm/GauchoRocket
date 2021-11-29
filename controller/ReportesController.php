<?php

class ReportesController{

    private $render;
    private $pdf;
    private $reportesModel;

    public function __construct(\Render $render, \ReportesModel $reportesModel, \PDF $pdf){
        $this->render = $render;
        $this->reportesModel = $reportesModel;
        $this->pdf = $pdf;
    }

    public function execute(){
        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($data["logueado"]) && isset($data["esAdmin"])){


            $data["grafico"] = $this->reportesModel->graficoViajes();



            echo $this->render->renderizar("view/reportes.mustache", $data);
        }
    }
}