<?php
	class Wonderlist{
        
        private $id;
        private $marca;
        private $tipo;
        private $precioCompra;
        private $precioVenta;
        private $precioPack;
        private $stock;
        private $tipoCerveza;

        public function mostrarId($marca, $tipo){
            $link = Conexion::conectar();
            $sql = "SELECT id
                    FROM wonderlist 
                    WHERE marca = '$marca'
                    AND tipo = '$tipo'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

        public function mostrarWonderlist(){
			$link = Conexion::conectar();
			$sql = "SELECT marca, tipo, precioCompra, precioVenta, precioPack, stock
					FROM wonderlist";
			$stmt = $link->prepare($sql);
			$stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function mostrarWonderlistxMarca($marca){
                $link = Conexion::conectar();
                $sql = "SELECT id, marca, tipo, precioCompra, precioVenta, precioPack, stock
                        FROM wonderlist WHERE marca = '$marca'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function mostrarWonderlistxID($id){
                $link = Conexion::conectar();
                $sql = "SELECT  marca, tipo, precioCompra, precioVenta, precioPack, stock
                        FROM wonderlist WHERE id = '$id'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function mostrarMarcas(){
                $link = Conexion::conectar();
                $sql = "SELECT DISTINCT marca
                        FROM wonderlist";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function mostrarTipos($marca){
                $link = Conexion::conectar();
                $sql = "SELECT tipo
                        FROM wonderlist WHERE marca = '$marca'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function mostrarPrecioUnitario($marca, $tipo){
                $link = Conexion::conectar();
                $sql = "SELECT precioVenta
                        FROM wonderlist WHERE marca='$marca' AND tipo='$tipo'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}
                
            public function usuario($usus, $psps){
            $link = Conexion::conectar();
            $sql = "SELECT *
                    FROM usus
                    WHERE usus='$usus' AND ususp=MD5('$psps');";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount();} 	

            public function mostrarPrecioPack($marca, $tipo){
                $link = Conexion::conectar();
                $sql = "SELECT precioPack
                        FROM wonderlist WHERE marca='$marca' AND tipo='$tipo'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            public function mostrarStock($marca, $tipo){
                    $link = Conexion::conectar();
                    $sql = "SELECT stock
                            FROM wonderlist WHERE marca='$marca' AND tipo='$tipo'";
                    $stmt = $link->prepare($sql);
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

                public function cambioStock($marca, $tipo, $stock){
                    $link = Conexion::conectar();
                    $sql = 	"UPDATE wonderlist 
                             SET stock = :stock
                             WHERE marca = '$marca' AND tipo = '$tipo'";
                    $stmt = $link->prepare($sql);
                    $stmt->bindParam(':stock', $stock,PDO::PARAM_STR);
                    if($stmt->execute()) {
                    echo "STOCK CAMBIADO CON EXITO <br>";
                    } else {
                    echo "Ocurrio un error";}}

                    //EDICIONES P/ CAMBIO DE STOCK

                    public function cambioMarca($id, $marca){
                        $link = Conexion::conectar();
                        $sql = 	"UPDATE wonderlist 
                                 SET marca = :marca
                                 WHERE id = '$id'";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':marca', $marca,PDO::PARAM_STR);
                        if($stmt->execute()) {
                        echo "MARCA CAMBIADA CON EXITO <br>";
                        } else {
                        echo "Ocurrio un error";}}
                      
                    public function cambioTipo($id, $tipo){
                        $link = Conexion::conectar();
                        $sql = 	"UPDATE wonderlist 
                                 SET tipo = :tipo
                                 WHERE id = '$id'";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':tipo', $tipo,PDO::PARAM_STR);
                        if($stmt->execute()) {
                        echo "TIPO CAMBIADO CON EXITO <br>";
                        } else {
                        echo "Ocurrio un error";}}

                    public function cambioCosto($id, $precioCompra){
                        $link = Conexion::conectar();
                        $sql = 	"UPDATE wonderlist 
                                 SET precioCompra = :precioCompra
                                 WHERE id = '$id'";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':precioCompra', $precioCompra,PDO::PARAM_STR);
                        if($stmt->execute()) {
                        echo "COSTO CAMBIADO CON EXITO <br>";
                        } else {
                        echo "Ocurrio un error";}}

                    public function cambioVentaU($id, $precioVenta){
                        $link = Conexion::conectar();
                        $sql = 	"UPDATE wonderlist 
                                 SET precioVenta = :precioVenta
                                 WHERE id = '$id'";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':precioVenta', $precioVenta,PDO::PARAM_STR);
                        if($stmt->execute()) {
                        echo "VENTA x UNIDAD CAMBIADO CON EXITO <br>";
                        } else {
                        echo "Ocurrio un error";}}

                    public function cambioVentaP($id, $precioPack){
                        $link = Conexion::conectar();
                        $sql = 	"UPDATE wonderlist 
                                 SET precioPack = :precioPack
                                 WHERE id = '$id'";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':precioPack', $precioPack,PDO::PARAM_STR);
                        if($stmt->execute()) {
                        echo "VENTA x PACK CAMBIADO CON EXITO <br>";
                        } else {
                        echo "Ocurrio un error";}}

                    public function cambioStockId($id, $stock){
                        $link = Conexion::conectar();
                        $sql = 	"UPDATE wonderlist 
                                 SET stock = :stock
                                 WHERE id = '$id'";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':stock', $stock,PDO::PARAM_STR);
                        if($stmt->execute()) {
                        echo "STOCK CAMBIADO CON EXITO <br>";
                        } else {
                        echo "Ocurrio un error";}}

                    public function agregarProducto($marca, $tipo, $precioCompra, $precioVenta, $precioPack, $stock, $tipoCerveza){  
                        $link = Conexion::conectar();
                        $sql = "INSERT INTO wonderlist (marca, tipo, precioCompra, precioVenta, precioPack, stock, tipoCerveza) 
                                VALUES (:marca, :tipo, :precioCompra, :precioVenta, :precioPack, :stock, :tipoCerveza)";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':marca', $marca,PDO::PARAM_STR);
                        $stmt->bindParam(':tipo', $tipo,PDO::PARAM_STR);
                        $stmt->bindParam(':precioCompra', $precioCompra,PDO::PARAM_STR);
                        $stmt->bindParam(':precioVenta', $precioVenta,PDO::PARAM_STR);
                        $stmt->bindParam(':precioPack', $precioPack,PDO::PARAM_STR);
                        $stmt->bindParam(':stock', $stock,PDO::PARAM_STR);
                        $stmt->bindParam(':tipoCerveza', $tipoCerveza,PDO::PARAM_STR);
                        if($stmt->execute()) {
                          echo "<br><br> Se agrego correctamente";
                        } else {
                          echo "Ocurrio un error al agregar Producto. Contactar con nano";}
                        }


                        //BORRAR UN PRODUCTO
                        public function borrarProducto($id){
                            $link = Conexion::conectar();
                            $sql = "DELETE FROM wonderlist 
                                    WHERE id ='$id'";
                            $stmt = $link->prepare($sql);
                            if($stmt->execute()){
                                echo "<h3> Se a eliminado el producto correctamente </h3>";
                            }else{echo "Algo salio mal :(";}
                            }


                            //PARA LA PAG OFFI

                            public function mostrarMarcasTipo($tipoCerveza){
                                $link = Conexion::conectar();
                                $sql = "SELECT DISTINCT marca
                                        FROM wonderlist WHERE tipoCerveza = '$tipoCerveza'";
                                $stmt = $link->prepare($sql);
                                $stmt->execute();
                                return $stmt->fetchAll(PDO::FETCH_ASSOC);}

                            public function mostrarMarcasTipoDos($marca){
                                $link = Conexion::conectar();
                                $sql = "SELECT id, precioVenta, precioPack, stock
                                        FROM wonderlist WHERE marca = '$marca'";
                                $stmt = $link->prepare($sql);
                                $stmt->execute();
                                return $stmt->fetchAll(PDO::FETCH_ASSOC);}

                            public function mostrarPOID($id){
                                $link = Conexion::conectar();
                                $sql = "SELECT marca, precioVenta, stock
                                        FROM wonderlist WHERE id = '$id'";
                                $stmt = $link->prepare($sql);
                                $stmt->execute();
                                return $stmt->fetchAll(PDO::FETCH_ASSOC);}
                                
                            public function contadorCervezas($tipoCerveza){
                                $link = Conexion::conectar();
                                $sql = "SELECT marca
                                        FROM wonderlist WHERE tipoCerveza = '$tipoCerveza'";
                                $stmt = $link->prepare($sql);
                                $stmt->execute();
                                return $stmt->fetchAll(PDO::FETCH_ASSOC);}


                        

            public function mostrarStockAlerta($cantidad){
                $link = Conexion::conectar();
                $sql = "SELECT  id, marca, tipo, stock
                        FROM wonderlist 
                        WHERE stock <= '$cantidad' 
                        AND id NOT IN (19,20,21,22,23)
                        ORDER BY stock asc";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	


//getters and setters 
public function getId()
{
    return $this->id;
}

public function setId($id)
{
    $this->id = $id;
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


public function getPrecioCompra()
{
    return $this->precioCompra;
}

public function setPrecioCompra($precioCompra)
{
    $this->precioCompra = $precioCompra;
    return $this;
}


public function getPrecioVenta()
{
    return $this->precioVenta;
}

public function setPrecioVenta($precioVenta)
{
    $this->precioVenta = $precioVenta;
    return $this;
}


public function getPrecioPack()
{
    return $this->precioPack;
}

public function setPrecioPack($precioPack)
{
    $this->precioPack = $precioPack;
    return $this;
}


public function getStock()
{
    return $this->stock;
}

public function setStock($stock)
{
    $this->stock = $stock;
    return $this;
}


public function getTipoCerveza()
{
    return $this->tipoCerveza;
}

public function setTipoCerveza($tipoCerveza)
{
    $this->tipoCerveza = $tipoCerveza;
    return $this;
}




}?>