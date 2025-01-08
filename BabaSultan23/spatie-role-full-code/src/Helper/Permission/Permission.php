<?php

namespace BabaSultan23\SpatieRoleFullCode\Helper\Permission;

class Permission {
    protected $permissions = [
        'super_admin' => 'Süper Admin Ayarları',
        'super_admin_role' => 'Süper Admin Rol',
        'super_admin_user' => 'Süper Admin Kullanıcı',
        'yeni_rol_izni' => 'Yeni Rol İzni',
    ];

    public function get_permissions() {
        return $this->permissions;
    }

    public static function scriptStripper($input, $ck_editor = false)
    {

        if ($input != null) {
            if ($ck_editor != false) {
                return $input;
            }
            return strip_tags($input);
        }
        if ($input == null) {
            return null;
        }
        /* kullanımı
               $test= new Helper();
               $menu->name = $test->scriptStripper($request->name);
            //eğer ck editör varsa
               $menu->name = $test->scriptStripper($request->name,true);
       */
    }

}