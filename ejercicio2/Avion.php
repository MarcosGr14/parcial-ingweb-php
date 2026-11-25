<?php
class Avion {
    private $id;
    private $nombre;
    private $tipo;
    private $hectareas;

    public function __construct($id, $nombre, $tipo, $hectareas) {
        $this->id = (int)$id;
        $this->nombre = (string)$nombre;
        $this->tipo = (int)$tipo;
        $this->hectareas = (float)$hectareas;
    }

    public function costoPorHectarea() {
        switch ($this->tipo) {
            case 0:
                return 1000.0;
            case 1:
                return 800.0;
            case 2:
                return 600.0;
            case 3:
                return 400.0;
            default:
                return 0.0;
        }
    }

    public function precio() {
        $costo = $this->costoPorHectarea();
        $subtotal = $this->hectareas * $costo;
        $impuesto = $subtotal * 0.07;
        $precioConImpuesto = $subtotal * 1.07;

        // Descuento del 10% para tipos 0 y 1; 5% para tipos 2 y 3
        $porcentaje = ($this->tipo === 0 || $this->tipo === 1) ? 0.10 : 0.05;

        // El descuento se aplica sobre el precio con impuesto
        $descuento = $precioConImpuesto * $porcentaje;
        $precioFinal = $precioConImpuesto - $descuento;

        return [
            'subtotal'            => $subtotal,
            'impuesto'            => $impuesto,
            'precioConImpuesto'   => $precioConImpuesto,
            'porcentajeDescuento' => $porcentaje * 100,
            'descuento'           => $descuento,
            'precioFinal'         => $precioFinal
        ];
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getHectareas() {
        return $this->hectareas;
    }
}
