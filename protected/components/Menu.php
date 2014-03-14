<?php

class Menu {

    private static $_controller;

    public static function getMenu($controller) {
        self::$_controller = $controller;
        $items = array();
        if (Util::checkAccess(array('action_ui_usermanagementadmin'))) {
            $items = array(
                array('label' => 'Dashboard', 'url' => array('/site/index')),
                array('label' => 'Form', 'url' => array('/site/page', 'view' => 'forms')),
                array('label' => 'Administración', 'url' => Yii::app()->user->ui->userManagementAdminUrl),
            );
        }
        return self::generateMenu($items);
    }

    public static function getAdminMenu($controller) {
        self::$_controller = $controller;
        $items = array(
            array('label' => '<i class="icon-mail-reply"></i>  Regresar a la App', 'url' => array('/site/index')),
            array('label' => '<i class="icon-user"></i>  Usuarios', 'url' => Yii::app()->user->ui->userManagementAdminUrl, 'access' => 'Cruge.ui.*', 'active_rules' => array('module' => 'cruge')),
            array('label' => '<i class="icon-upload-alt"></i>  Importar Archivo CSV', 'url' => array('/importcsv/'), 'access' => 'importar_archivo_csv', 'active_rules' => array('module' => 'importcsv')),
            array('label' => '<i class="icon-book"></i>  CatÃ¡logos', 'url' => '#', 'items' => array(
                    array('label' => 'Industrias', 'url' => array('/crm/industria/admin'), 'access' => 'action_industria_admin', 'active_rules' => array('module' => 'crm', 'controller' => 'industria')),
                )),
        );

        return self::generateMenu($items);
    }

    /**
     * Function to create a menu with acces rules and active item
     * @param array $items items to build the menu
     * @return array the formated menu
     */
    private static function generateMenu($items) {
        $menu = array();

        foreach ($items as $k => $item) {
            $access = false;
            $menu_item = $item;

            // Check children access
            if (isset($item['items'])) {
                $menu_item['items'] = array();
                // Check childrens access
                foreach ($item['items'] as $j => $children) {
                    if ($access = Yii::app()->user->checkAccess($children['access'])) {
                        $menu_item['items'][$j] = $children;
                        if (isset($children['active_rules']) && self::getActive($children['active_rules'])) {
                            $menu_item['items'][$j]['active'] = true;
                            $menu_item['active'] = true;
                        }
                    }
                }
            } else {
                // Check item access
                if (isset($item['access'])) {
                    $access = Yii::app()->user->checkAccess($item['access']);
                } else {
                    $access = true;
                }
                // Check active
                if (isset($item['active_rules'])) {
                    $menu_item['active'] = self::getActive($item['active_rules']);
                }
            }

            // If acces to the item or any child add to the menu
            if ($access) {
                $menu[] = $menu_item;
            }
        }

        return $menu;
    }

    /**
     * Function to compare the menu active rules with the current url
     * @param array $active_rules the array of rules to compare
     * @return boolean true if the rules match the current url
     */
    private static function getActive($active_rules) {
        $current = false;
        if (self::$_controller) {
            if (isset($active_rules['module']) && self::$_controller->module) {
                $current = (self::$_controller->module->id == $active_rules['module']);
            }
            if (isset($active_rules['controller'])) {
                $current = (self::$_controller->id == $active_rules['controller']);
            }
            if (isset($active_rules['action'])) {
                $current = (self::$_controller->action->id == $active_rules['action']);
            }
        }
        return $current;
    }

}
