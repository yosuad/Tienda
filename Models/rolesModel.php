<?php

class rolesModel extends mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectRoles()
    {
        //EXTRAE ROLES
        $sql = "SELECT * FROM rol WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }
}
