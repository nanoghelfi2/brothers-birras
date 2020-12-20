<?php
	class Ventas{
        private $id;
        private $nombreCliente;
        private $productosVendidos;
        private $valorVenta;
        private $lugar;
        private $fecha;
    

        public function verVentasSegun($productosVendidos){
            $link = Conexion::conectar();
            $sql = "SELECT id, nombreCliente, productosVendidos, valorVenta, lugar, fecha
                    FROM ventas WHERE productosVendidos LIKE '%$productosVendidos%'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

        public function verVentasAyer($fecha){
            $link = Conexion::conectar();
            $sql = "SELECT id, nombreCliente, productosVendidos, valorVenta, lugar, fecha
                    FROM ventas WHERE fecha = '$fecha' ORDER BY fecha DESC";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function verVentasResto($fecha){
                $link = Conexion::conectar();
                $sql = "SELECT id, nombreCliente, productosVendidos, valorVenta, lugar, fecha
                        FROM ventas 
                        WHERE fecha < '$fecha' 
                        ORDER BY fecha DESC";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function verVentasParam($fecha1, $fecha2){
                $link = Conexion::conectar();
                $sql = "SELECT id, nombreCliente, productosVendidos, valorVenta, lugar, fecha
                        FROM ventas 
                        WHERE fecha < '$fecha1' 
                        AND fecha > '$fecha2'
                        ORDER BY fecha DESC";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	 

		public function verVentas(){
            $link = Conexion::conectar();            
            $sql = "SELECT id, nombreCliente, productosVendidos, valorVenta, lugar, fecha
                    FROM ventas ORDER BY fecha DESC";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	  
    
		public function verVentasXid($id){
            $link = Conexion::conectar();
            $sql = "SELECT id, nombreCliente, productosVendidos, valorVenta, lugar, fecha
                    FROM ventas WHERE id = '$id'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	 
            
		public function agregarVenta($nombreCliente, $productosVendidos, $valorVenta, $lugar, $fecha){
			$link = Conexion::conectar();
			$sql = "INSERT INTO ventas (nombreCliente, productosVendidos, valorVenta, lugar, fecha) 
					VALUES (:nombreCliente, :productosVendidos, :valorVenta, :lugar, :fecha)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(':nombreCliente', $nombreCliente,PDO::PARAM_STR);
            $stmt->bindParam(':productosVendidos', $productosVendidos,PDO::PARAM_STR);
            $stmt->bindParam(':valorVenta', $valorVenta,PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $lugar,PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $fecha,PDO::PARAM_STR);
			if($stmt->execute()) {
			  echo "<h3> ¡Felicidades por la venta! </h3>";
			} else {
			  echo "Ocurrio un error al realizar la venta. Contactar con nano";				}
            }
    
    //GETTERS AND SETTERS
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }
    
    public function setnombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;
        return $this;
    }
    


    public function getProductoVendido()
    {
        return $this->productosVendidos;
    }
    
    public function setProductoVendido($productosVendidos)
    {
        $this->productoVendido = $productosVendidos;
        return $this;
    }
    
    
    public function getValorVenta()
    {
        return $this->valorVenta;
    }
    
    public function setValorVenta($valorVenta)
    {
        $this->valorVenta = $valorVenta;
        return $this;
    }
    
    
    public function getLugar()
    {
        return $this->lugar;
    }
    
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
        return $this;
    }
    
    
    public function getFecha()
    {
        return $this->fecha;
    }
    
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }
    
    


}?>