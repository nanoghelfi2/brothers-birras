<?php
	class ProductosPag{
        
        private $id;
        private $idWl;
        private $titulo;
        private $aclaracion;
        private $estilo;
        private $envase;
        private $descripcion;
        private $imgMineatura;
        private $imgGrande;


        public function mostrarPrincipal($idWl){
            $link = Conexion::conectar();
            $sql = "SELECT id, titulo, aclaracion, imgMineatura
                    FROM productospag 
                    WHERE idWl = '$idWl'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}

        public function mostrarBirra($idWl){
            $link = Conexion::conectar();
            $sql = "SELECT titulo, estilo, envase, descripcion, imgGrande
                    FROM productospag 
                    WHERE idWl = '$idWl'";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);}


        public function agregarProducto($idWl, $titulo){  
            $link = Conexion::conectar();
            $sql = "INSERT INTO productospag (idWl, titulo) 
                     VALUES (:idWl, :titulo)";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':idWl', $idWl,PDO::PARAM_STR);
            $stmt->bindParam(':titulo', $titulo,PDO::PARAM_STR);
            if($stmt->execute()) {
              echo "<br><br> Se agrego correctamente";
            } else {
              echo "Ocurrio un error al agregar Producto. Contactar con nano";}
            }



//getters and setters
public function getEnvase()
{
    return $this->envase;
}

public function setEnvase($envase)
{
    $this->envase = $envase;
    return $this;
}


public function getId()
{
    return $this->id;
}

public function setId($id)
{
    $this->id = $id;
    return $this;
}

public function getIdWl()
{
    return $this->idWl;
}

public function setIdWl($idWl)
{
    $this->idWl = $idWl;
    return $this;
}


public function getTitulo()
{
    return $this->titulo;
}

public function setTitulo($titulo)
{
    $this->titulo = $titulo;
    return $this;
}

public function getAclaracion()
{
    return $this->aclaracion;
}

public function setAclaracion($aclaracion)
{
    $this->aclaracion = $aclaracion;
    return $this;
}

public function getDescripcion()
{
    return $this->descripcion;
}

public function setDescripcion($descripcion)
{
    $this->descripcion = $descripcion;
    return $this;
}

public function getEstilo()
{
    return $this->estilo;
}

public function setEstilo($estilo)
{
    $this->estilo = $estilo;
    return $this;
}

public function getImgMineatura()
{
    return $this->imgMineatura;
}

public function setImgMineatura($imgMineatura)
{
    $this->imgMineatura = $imgMineatura;
    return $this;
}



public function getImgGrande()
{
    return $this->imgGrande;
}

public function setImgGrande($imgGrande)
{
    $this->imgGrande = $imgGrande;
    return $this;
}


}?>