<?php
	class Cliente{

    private $idcliente;
    private $nombreCliente;
    private $contacto;
    private $contactoDos;
    private $lugar;
    private $lugarDos;
    private $lugarTemporal;
    private $descTemporal;

            //lo uso
        public function mostrarNombresClientes(){
            $link = Conexion::conectar();
            $sql = "SELECT  idcliente, nombreCliente
                    FROM cliente ORDER BY nombreCliente ASC";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}	

            //lo uso
         public function mostrarDatosCliente($idcliente){
            $link = Conexion::conectar();
            $sql = "SELECT  nombreCliente, contacto, contactoDos, lugar, lugarDos, lugarTemporal
                    FROM cliente WHERE idcliente = '$idcliente'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}

            //lo uso
            public function onlyName($idcliente){
                $link = Conexion::conectar();
                $sql = "SELECT  nombreCliente
                        FROM cliente WHERE idcliente = '$idcliente'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}
            


                //Lo uso
            public function MostrarLugares($idcliente){
                $link = Conexion::conectar();
                $sql = "SELECT  idcliente, nombreCliente, lugar, lugarTemporal
                        FROM cliente WHERE idcliente = '$idcliente'";
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);}   

                //lo uso
        public function agregarCliente($nombreCliente, $contacto, $contactoDos, $lugar, $lugarDos){
			$link = Conexion::conectar();
			$sql = "INSERT INTO cliente (nombreCliente, contacto, contactoDos, lugar, lugarDos) 
					VALUES (:nombreCliente, :contacto, :contactoDos, :lugar, :lugarDos)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(':nombreCliente', $nombreCliente,PDO::PARAM_STR);
            $stmt->bindParam(':contacto', $contacto,PDO::PARAM_STR);
            $stmt->bindParam(':contactoDos', $contactoDos,PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $lugar,PDO::PARAM_STR);
            $stmt->bindParam(':lugarDos', $lugarDos,PDO::PARAM_STR);
			if($stmt->execute()) {
                $ultimaid = $link->lastInsertId();
                header("location:chango.php?newChangoClient=".$ultimaid);
			} else {
			  echo "Ocurrio un error al agregar Cliente. Contactar con nano";				}
            }


                //lo uso
            public function borrarCliente($idcliente){
                $link = Conexion::conectar();
                $sql = "DELETE FROM Cliente 
                        WHERE idcliente ='$idcliente'";
                $stmt = $link->prepare($sql);
                if($stmt->execute()){
                    echo "<h3> Se a eliminado el chango correctamente </h3>";
                }else{echo "Algo salio mal :(";}
                }      
                
                //lo uso
            public function editarLugarTemporal($idCliente, $lugarTemporal){
                $link = Conexion::conectar();
                $sql = 	"UPDATE cliente 
                         SET lugarTemporal = :lugarTemporal 
                         WHERE idCliente =".$idCliente;
                $stmt = $link->prepare($sql);
                $stmt->bindParam(':lugarTemporal', $lugarTemporal,PDO::PARAM_STR);
                if($stmt->execute()) {
                echo "Lugar editado con exito editada con exito!";
                } else {
                echo "Ocurrio un error";}}

                

//GETERS AND SETTERS
public function getIdcliente()
{
    return $this->idcliente;
}

public function setIdcliente($idcliente)
{
    $this->idcliente = $idcliente;
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


public function getcontacto()
{
    return $this->contacto;
}

public function setcontacto($contacto)
{
    $this->contactoUno = $contacto;
    return $this;
}



public function getContactoDos()
{
    return $this->contactoDos;
}

public function setContactoDos($contactoDos)
{
    $this->contactoDos = $contactoDos;
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


public function getLugarDos()
{
    return $this->lugarDos;
}

public function setLugarDos($lugarDos)
{
    $this->lugarDos = $lugarDos;
    return $this;
}

public function getLugarTemporal()
{
    return $this->lugarTemporal;
}

public function setLugarTemporal($lugarTemporal)
{
    $this->lugarTemporal = $lugarTemporal;
    return $this;
}

public function getDescTemporal()
{
    return $this->descTemporal;
}

public function setDescTemporal($descTemporal)
{
    $this->descTemporal = $descTemporal;
    return $this;
}
}
?>