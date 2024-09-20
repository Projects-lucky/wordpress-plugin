<?php 
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}


require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

// Custom list table class
class ListTable extends WP_List_Table {

    var $data = array(
        array('form' => 'signup', 'shortcode' => 'custom_signup'),
        array('form' => 'login', 'shortcode' => 'custom_login'),
    );

public function prepare_items(){
        $this->items = $this->data;
        $columns = $this->get_columns();
        $this->_column_headers = array ($columns);
}

public function get_columns(){
        $columns = array(
            'form' => 'Form',
            'shortcode' => 'Shortcode',
        );
        return $columns;
}

public function column_default($item, $column_name){
    switch($column_name){
        case 'form':
        case 'shortcode':
            return $item[$column_name];
        default: 
        return "no value";
    }
   
}
}

function MY_table_show_data(){
        $tab = new ListTable();
        $tab->prepare_items();
        $tab->display();
}

MY_table_show_data();


