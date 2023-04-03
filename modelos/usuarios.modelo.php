<?php 

require_once "conexion.php";

class ModeloUsuarios
{
    static public function mdlIngresoUsuario($tabla,$item,$valor) 
    {
        if($item != null)
        {
             $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
 
        }
        else
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }
       
        $stmt->close();

        $stmt = null;   
    }

    static public function mdlCrearUsuario($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,usuario,paswword,perfil,foto) VALUES(:nombre,:usuario,:paswword,:perfil,:foto)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":paswword", $datos["paswword"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlEditarUsuario($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, paswword = :paswword, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":paswword", $datos["paswword"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlActivarUsuario($tabla,$item1,$valor1,$item2,$valor2)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "erro";
        }

        $stmt->close();

        $stmt = null;        
    }
}