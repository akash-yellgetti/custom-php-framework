<?php

/**
* 
*/
class Common extends Model
{
	public function menus($role_code)
    {
        $parents =$this->menus_query('0',$role_code);
        foreach ($parents['result'] as $key => $value) {
            $data = $this->menus_query($value['menu_id'],$role_code);
            $parents['result'][$key]['sub-menu'] = $data['result'];
        }
         
        return $parents['result'];
    }
	public function menus_query($menu_parent_id,$role_code){
        
        $sql = "select menu_id,menu_text,menu_url,role_menu_insert,role_menu_update,role_menu_delete,role_menu_view,role_menu_export 
        from menu_master mm ,user_role_master rm
        where
        mm.menu_id = role_menu_id
        and role_code='$role_code'
        and menu_parent_id='$menu_parent_id'
        order by menu_seq
        ";
        $conn = $this->connect();
        $data = $this->select($sql);
        return $data;
    }
}