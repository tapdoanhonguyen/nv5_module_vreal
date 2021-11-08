<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 04/18/2017 09:47
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!function_exists('vreal_search_product_mobile')) {

    /**
     * vreal_search_product_mobile()
     *
     * @param mixed $block_config
     * @return
     *
     */
    function vreal_search_product_mobile($block_config)
    {
        global $nv_Cache, $site_mods, $my_head, $db_config, $module_name, $module_info, $nv_Request, $catid, $rid, $module_config, $global_config;

        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];
        $pro_config = $module_config[$module];

        include NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_DATA . '.php';

        $keyword = $nv_Request->get_string('keyword', 'get');
        $price1_temp = $nv_Request->get_string('price1', 'get', '');
        $price2_temp = $nv_Request->get_string('price2', 'get', '');
        $typemoney = $nv_Request->get_string('typemoney', 'get', '');
        $cataid = $nv_Request->get_int('cata', 'get', 0);
		$raid = $nv_Request->get_int( 'raid', 'get', 0 );
		
        if ($cataid == 0) {
            $cataid = $catid;
        }
        if ($raid == 0) {
            $raid = $rid;
        }		
        if ($price1_temp == '') {
            $price1 = -1;
        } else {
            $price1 = floatval($price1_temp);
        }
        if ($price2_temp == '') {
            $price2 = -1;
        } else {
            $price2 = floatval($price2_temp);
        }

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $mod_file . '/block_vreal_search_mobile.tpl')) {
            $block_theme = $global_config['module_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('block_vreal_search_mobile.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
        $xtpl->assign('LANG', $lang_module);
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('MODULE_NAME', $module);

        $sql = 'SELECT catid, lev, ' . NV_LANG_DATA . '_title AS title FROM ' . $db_config['prefix'] . '_' . $mod_data . '_catalogs ORDER BY sort ASC';
        $list = $nv_Cache->db($sql, '', $module);

        foreach ($list as $row) {
            $xtitle_i = '';
            if ($row['lev'] > 0) {
                $xtitle_i .= '&nbsp;&nbsp;&nbsp;';
                for ($i = 1; $i <= $row['lev']; $i++) {
                    $xtitle_i .= '&nbsp;&nbsp;&nbsp;';
                }
                $xtitle_i .= '&nbsp;';
            }
            $row['xtitle'] = $xtitle_i . $row['title'];
            $row['selected'] = ($cataid == $row['catid']) ? 'selected="selected"' : '';
            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.loopcata');
        }

        // Get money
        $sql = 'SELECT code, currency FROM ' . $db_config['prefix'] . '_' . $mod_data . '_money_' . NV_LANG_DATA;
        $list = $nv_Cache->db($sql, '', $module);

        foreach ($list as $row) {
            $row['selected'] = ($typemoney == $row['code']) ? 'selected="selected"' : '';
            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.typemoney');
        }
		
		$sql = 'SELECT ' . NV_LANG_DATA . '_title AS title, rid FROM ' . $db_config['prefix'] . '_' . $mod_data . '_real_type ORDER BY rid ASC';
		$list = $nv_Cache->db( $sql, '', $module );

		foreach( $list as $row )
		{
			$row['selected'] = ( $raid == $row['rid'] ) ? 'selected="selected"' : '';
			$xtpl->assign( 'ROW', $row );
			$xtpl->parse( 'main.loop_real_type' );
		}	
		
        if ($price1 == -1) {
            $price1 = '';
        }
        if ($price2 == -1) {
            $price2 = '';
        }

        $xtpl->assign('value_keyword', $keyword);
        $xtpl->assign('value_price1', $price1);
        $xtpl->assign('value_price2', $price2);

        if ($pro_config['active_price']) {
            $xtpl->parse('main.price');
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = vreal_search_product_mobile($block_config);
}
