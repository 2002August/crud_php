<?php
if (!empty($_POST)) {
    $txt_id        = $_POST["txt_id"];
    $txt_codigo    = $_POST["txt_codigo"];
    $txt_nombres   = $_POST["txt_nombres"];
    $txt_apellidos = $_POST["txt_apellidos"];
    $txt_direccion = $_POST["txt_direccion"];
    $txt_telefono  = $_POST["txt_telefono"];
    $drop_puesto   = $_POST["drop_puesto"];
    $txt_fn        = $_POST["txt_fn"];

    include("datos_conexion.php");
    $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);

    // muy importante
    $db_conexion->set_charset("utf8mb4");

    $sql = "";
    if (isset($_POST['btn_agregar'])) {
        $sql = "INSERT INTO empleados(codigo,nombres,apellidos,direccion,telefono,fecha_nacimiento,id_puesto) 
                VALUES ('$txt_codigo','$txt_nombres','$txt_apellidos','$txt_direccion','$txt_telefono','$txt_fn',$drop_puesto)";
    }
    if (isset($_POST['btn_modificar'])) {
        $sql = "UPDATE empleados 
                SET codigo='$txt_codigo',
                    nombres='$txt_nombres',
                    apellidos='$txt_apellidos',
                    direccion='$txt_direccion',
                    telefono='$txt_telefono',
                    fecha_nacimiento='$txt_fn',
                    id_puesto=$drop_puesto 
                WHERE id_empleado=$txt_id";
    }
    if (isset($_POST['btn_eliminar'])) {
        $sql = "DELETE FROM empleados WHERE id_empleado=$txt_id";
    }

    if ($db_conexion->query($sql) === TRUE) {
        $db_conexion->close();
        header('Location: index.php');
    } else {
        echo "Error: " . $db_conexion->error;
        $db_conexion->close();
    }
}
?>
