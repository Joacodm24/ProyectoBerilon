<?php 
    // Nombre del archivo de la clase
    namespace App\Mvc2025\Model;

    interface notas {

        public function getNotas(float $primeraNota, float $segundaNota, float $terceraNota);
        public function calcularPromedio();
    }

    class NotasModel implements notas {

        private $primeraNota;
        private $segundaNota;
        private $terceraNota;
        
        public function getNotas(float $primeraNota, float $segundaNota, float $terceraNota) {

            $this->primeraNota = $primeraNota;
            $this->segundaNota = $segundaNota;
            $this->terceraNota = $terceraNota;
        
        }

        public function calcularPromedio() {

            $promedio = ($this->primeraNota + $this->segundaNota + $this->terceraNota) / 3;

            if(intval($promedio) == floatval($promedio)) return $promedio;

            return number_format($promedio, 2);

        }
    }


?>