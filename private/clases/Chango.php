<?php
class Chango{
	private $id;
    private $marca;
    private $tipo;
    private $cantidad;
    private $unidad;
    private $valor;
    private $nombreCliente;
    private $estadoVenta;

        public function mostrarProductos($id){
            $link = Conexion::conectar();
            $sql = "SELECT id, marca, tipo, cantidad, unidad, valor
                    FROM chango WHERE id = '$id'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	   

            public function verProductoChID($id){
                $link = Conexion::conectar();
                $sql = "SELECT marca, tipo, cantidad, unidad
                        FROM chango WHERE id = '$id'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}	 

        //ESTO MUESTRA LOS CHANGOS ACTIVOS SEGUN CLIENTE (EN USO)
        public function mostrarPorCliente($nombreCliente){
            $link = Conexion::conectar();
            $sql = "SELECT id, estadoVenta
                    FROM chango WHERE nombreCliente = '$nombreCliente'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	  
        
        //tectnicamente en uso
        public function changosEnProceso(){
            $link = Conexion::conectar();
            $sql = "SELECT id, nombreCliente
                    FROM chango WHERE estadoVenta = 'proceso'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	
            
        public function changosEntregaPend(){
            $link = Conexion::conectar();
            $sql = "SELECT id, nombreCliente
                    FROM chango WHERE estadoVenta = 'pendiente'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}

            //---------- ESTO LO USO
                //BUSCO EL ESTADO DEL CHANGO PARA PONERLO EN UNA VARIABLE Y UTILIZARLO
            public function mostrarEstado($id){
                $link = Conexion::conectar();
                $sql = "SELECT nombreCliente, estadoVenta
                        FROM chango WHERE id = '$id'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}

            // --------- ESTO LO USO
                //CREA UN CHANGO NUEVO CON EL ID DEL CLIENTE Y EN ESTADO PROCESO
            public function nuevoChango($nombreCliente){
                $link = Conexion::conectar();
                $sql = "INSERT INTO chango (nombreCliente) 
                        VALUES (:nombreCliente)";
                $stmt = $link->prepare($sql);
                $stmt->bindParam(':nombreCliente', $nombreCliente,PDO::PARAM_STR);
                if($stmt->execute()) {
                    $ultimaid = $link->lastInsertId();
                    header("location:chango.php?changoNumero=".$ultimaid);
                } else {
                  echo "Ocurrio un error al agregar Producto. Contactar con nano";				}
                }


		public function agregarProducto($nombreCliente, $marca, $tipo, $cantidad, $unidad, $valor, $estadoVenta){
			$link = Conexion::conectar();
			$sql = "INSERT INTO chango (nombreCliente, marca, tipo, cantidad, unidad, valor, estadoVenta) 
					VALUES (:nombreCliente, :marca, :tipo, :cantidad, :unidad, :valor, :estadoVenta)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(':nombreCliente', $nombreCliente,PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca,PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo,PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad,PDO::PARAM_STR);
            $stmt->bindParam(':unidad', $unidad,PDO::PARAM_STR);
            $stmt->bindParam(':valor', $valor,PDO::PARAM_STR);
            $stmt->bindParam(':estadoVenta', $estadoVenta,PDO::PARAM_STR);
			if($stmt->execute()) {
			  echo "<br><br> Se agrego correctamente";
			} else {
			  echo "Ocurrio un error al agregar Producto. Contactar con nano";				}
            }
            
        public function borrarProducto($id){
            $link = Conexion::conectar();
            $sql = "DELETE FROM chango 
                    WHERE id ='$id'";
            $stmt = $link->prepare($sql);
            if($stmt->execute()){
                echo "<h3> Se a eliminado el producto correctamente </h3>";
            }else{echo "Algo salio mal :(";}
            }

        public function borrarChango($nombreCliente){
            $link = Conexion::conectar();
            $sql = "DELETE FROM chango 
                    WHERE id ='$nombreCliente' AND estadoVenta = 'proceso'";
            $stmt = $link->prepare($sql);
            if($stmt->execute()){
                echo "<h3> Se a eliminado el chango correctamente </h3>";
            }else{echo "Algo salio mal :(";}
            }      
            
        public function borrarChangoFfinal($idChango){
            $link = Conexion::conectar();
            $sql = "DELETE FROM chango 
                    WHERE id ='$idChango' AND estadoVenta = 'pendiente'";
            $stmt = $link->prepare($sql);
            if($stmt->execute()){
                echo "<h3> Se a eliminado con exito </h3>";
            }else{echo "Algo salio mal :(";}
            }    

            public function cambioEstado($idChango){
                $link = Conexion::conectar();
                $sql = 	"UPDATE chango 
                         SET estadoVenta = 'pendiente'
                         WHERE id = '$idChango'";
                $stmt = $link->prepare($sql);
                if($stmt->execute()) {
                echo "cambio estado realizado";
                } else {
                echo "Ocurrio un error";}}


            ## AGREGA DESCUENTO
            public function editarDescTemporal($idChango, $descTemporal){
                    $link = Conexion::conectar();
                    $sql = 	"UPDATE chango 
                             SET descuento = :descTemporal 
                             WHERE id =".$idChango;
                    $stmt = $link->prepare($sql);
                    $stmt->bindParam(':descTemporal', $descTemporal,PDO::PARAM_STR);
                    if($stmt->execute()) {
                    echo "Descuento realizado!";
                    } else {
                    echo "Ocurrio un error";}}
            ## MUESTRA DESCUENTO
            public function mostrarDescuento($id){
                $link = Conexion::conectar();
                $sql = "SELECT descuento
                        FROM chango WHERE id = '$id'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}

            ## EN USO 
            public function cambiarCliente($id, $nombreCliente){
                $link = Conexion::conectar();
                $sql = 	"UPDATE chango 
                         SET nombreCliente = :nombreCliente 
                         WHERE id =".$id;
                $stmt = $link->prepare($sql);
                $stmt->bindParam(':nombreCliente', $nombreCliente,PDO::PARAM_STR);
                if($stmt->execute()) {
                echo "Cliente editado con exito editada con exito!";
                } else {
                echo "Ocurrio un error";}}

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

public function getNombreCliente()
{
    return $this->nombreCliente;
}

public function setNombreCliente($nombreCliente)
{
    $this->nombreCliente = $nombreCliente;
    return $this;
}

public function getEstadoVenta()
{
    return $this->estadoVenta;
}

public function setEstadoVenta($estadoVenta)
{
    $this->estadoVenta = $estadoVenta;
    return $this;
}



} ?>
