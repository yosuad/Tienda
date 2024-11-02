<?php

class Roles extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Roles()
    {
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles Usuario";
        $data['page_name'] = "rol_usuario";
        $data['page_title'] = "  Roles Usuario <small>Tienda Virtual</small>";

        $this->views->getView($this, "roles", $data);
    }

    // MOSTRAR ROLES
    public function getRoles()
    {
        $arrData = $this->model->selectRoles();
        for ($i = 0; $i < count($arrData); $i++) {

            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['options'] = '<div class="text-center">
            <button class="btn btn-secondary btn-sm btnPermisosRol" rl="' . $arrData[$i]['idrol'] . '" title="Permisos"><i class="fas fa-key" aria-hidden="true"></i></button>
            <button class="btn btn-primary btn-sm btnEditRol" rl="' . $arrData[$i]['idrol'] . '" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
            <button class="btn btn-danger btn-sm btnDelRol" rl="' . $arrData[$i]['idrol'] . '" title="Eliminar"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
            </div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setRol()
    {

        $intIdrol = intval($_POST['idRol']);
        $strRol =  strClean($_POST['txtNombre']);
        $strDescipcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);

        if ($intIdrol == 0) {
            //Crear
            $request_rol = $this->model->insertRol($strRol, $strDescipcion, $intStatus);
            $option = 1;
        } else {
            //Actualizar
            $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
            $option = 2;
        }

        if ($request_rol > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
            }
        } else if ($request_rol == 'exist') {

            $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
        } else {
            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
