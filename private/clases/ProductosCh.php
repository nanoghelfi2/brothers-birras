<?php
class ProductosCh{
        
        private $idprod;
        private $idCh;
        private $marca;
        private $tipo;
        private $cantidad;
        private $unidad;
        private $valor;

        //Lo uso
        public function mostrarProductosxCh($idCh){
            $link = Conexion::conectar();
            $sql = "SELECT idprod, marca, tipo, cantidad, unidad, valor
                    FROM productosch WHERE idCh = '$idCh'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	   

            public function mostrarProductosxId($idprod){
                $link = Conexion::conectar();
                $sql = "SELECT marca, tipo, cantidad, unidad, valor
                        FROM productosch WHERE idprod = '$idprod'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	   

            public function agregarProducto($idCh, $marca, $tipo, $cantidad, $unidad, $valor){
                    $link = Conexion::conectar();
                    $sql = "INSERT INTO productosch (idCh, marca, tipo, cantidad, unidad, valor) 
                            VALUES (:idCh, :marca, :tipo, :cantidad, :unidad, :valor)";
                    $stmt = $link->prepare($sql);
                    $stmt->bindParam(':idCh', $idCh,PDO::PARAM_STR);
                    $stmt->bindParam(':marca', $marca,PDO::PARAM_STR);
                    $stmt->bindParam(':tipo', $tipo,PDO::PARAM_STR);
                    $stmt->bindParam(':cantidad', $cantidad,PDO::PARAM_STR);
                    $stmt->bindParam(':unidad', $unidad,PDO::PARAM_STR);
                    $stmt->bindParam(':valor', $valor,PDO::PARAM_STR);
                    if($stmt->execute()) {
                      echo "<br><br> Se agrego correctamente";
                    } else {
                      echo "Ocurrio un error al agregar Producto. Contactar con nano";				}
                    }

            public function borrarProducto($idprod){
                        $link = Conexion::conectar();
                        $sql = "DELETE FROM productosch 
                                WHERE idprod ='$idprod'";
                        $stmt = $link->prepare($sql);
                        if($stmt->execute()){
                            echo "<h3> Se a eliminado el producto correctamente </h3>";
                        }else{echo "Algo salio mal :(";}
                        }
            public function borrarProductosChango($idCh){
                        $link = Conexion::conectar();
                        $sql = "DELETE FROM productosch 
                                WHERE idCh ='$idCh'";
                        $stmt = $link->prepare($sql);
                        if($stmt->execute()){
                            echo "<h3> Se a eliminado el producto correctamente </h3>";
                        }else{echo "Algo salio mal :(";}
                        }                               



public function getIdprod()
{
    return $this->idprod;
}

public function setIdprod($idprod)
{
    $this->idprod = $idprod;
    return $this;
}



public function getIdCh()
{
    return $this->idCh;
}

public function setIdCh($idCh)
{
    $this->idCh = $idCh;
    return $this;
}



 public function getMarca()
        {
            return $this->marca;
        }
        
        public function setMarca($marca)
        {
            $this->marca = $marca;
            return $this;
        }       


public function getTipo()
{
    return $this->tipo;
}

public function setTipo($tipo)
{
    $this->tipo = $tipo;
    return $this;
}


public function getCantidad()
{
    return $this->cantidad;
}

public function setCantidad($cantidad)
{
    $this->cantidad = $cantidad;
    return $this;
}


public function getUnidad()
{
    return $this->unidad;
}

public function setUnidad($unidad)
{
    $this->unidad = $unidad;
    return $this;
}

public function getValor()
{
    return $this->valor;
}

public function setValor($valor)
{
    $this->valor = $valor;
    return $this;
}

}

?>