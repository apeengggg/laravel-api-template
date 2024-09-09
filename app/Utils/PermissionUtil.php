<?php

namespace App\Utils;

class PermissionUtil {

    public static function createObjectPermission($permissions){
        $permissions = json_decode($permissions, true);
        // dd($permissions);
        $parent = array_filter($permissions, function ($o) {
            return $o['parent_function_id'] === null;
        });


        $children = array_filter($permissions, function ($o) {
            return $o['parent_function_id'] !== null;
        });

        foreach ($parent as &$p) {
            $p['child'] = [];

            foreach ($children as $c) {
                if ($c['parent_function_id'] === $p['function_id']) {
                    $p['child'][] = $c;
                }
            }
        }

        $parent = array_values($parent);
        return $parent;
    }
}