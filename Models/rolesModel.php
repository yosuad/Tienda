<?php

class rolesModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectRoles()
    {
        // EXTRAER ROLES
        $sql = "SELECT * FROM rol WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }
}
