<?php
/**
 * KBoard 게시판 리스트 테이블
 * @link www.cosmosfarm.com
 * @copyright Copyright 2013 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */
class JtmBoardListTable extends WP_List_Table {
	
	public function __construct(){
		parent::__construct( array(
	        'singular'  => 'uid',
	        'ajax'      => false      
	    ) ); 
		
	}

    public function prepare_items() {

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();


        $data = $this->table_data($_GET['s']);
        usort( $data, array( &$this, 'sort_data' ) );
        // $data = $this->display_rows($data);
        
        $perPage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->process_bulk_action(); 
        $this->items = $data;
    }

    public function get_columns() {
        $columns = array(
            'cb'          => '<input type="checkbox" />',
            'board_name'   => '제목',
            'skin'   		=> '스킨'
        );

        return $columns;
    }

    public function get_hidden_columns(){
        return array();
    }

    public function get_sortable_columns(){

		$sortable_columns = array(
			'uid' => array('uid', false)
		);
        return $sortable_columns;
    }

    public function column_cb($item){
	    // return $item['uid'];

	    return sprintf(
	        '<input type="checkbox" name="%1$s[]" value="%2$s" />',
	        /*$1%s*/ $this->_args['singular'],  
	        /*$2%s*/ $item->uid                
    	);
	}

	public function column_board_name($item){
	    $actions = array(
	    	'view'			=> sprintf('<a href="'.admin_url("admin.php?page=%s&action=%s&uid=%s").'">view</a>', 	'jtmplug_settings_page1', 'view', $item->uid),
	        'edit'			=> sprintf('<a href="'.admin_url("admin.php?page=%s&action=%s&uid=%s").'">Update</a>', 	$_REQUEST['page'], 'edit', $item->uid),
	        'delete'    	=> sprintf('<a href="'.admin_url("admin.php?page=%s&action=%s&uid=%s").'">Delete</a>', 	$_REQUEST['page'], 'delete', $item->uid),
    	);

    	return sprintf('%1$s %2$s',
	        /*$1%s*/ $item->board_name,          
	        /*$2%s*/ $this->row_actions($actions)
	    );
	}

	public function column_default( $item, $column_name ){
        switch( $column_name ) {
            case 'uid':
            case 'board_name':
            case 'skin':
                return $item->$column_name;
            default:
                return print_r( $item, true ) ;
        }
    }

    private function table_data($search){
    	global $wpdb;
    	
    	$search_query = "";
    	if($search){
    		$search_query .= " AND board_name like '%{$search}%' ";
    	}
    	$contents = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}jtmplug_setting` WHERE 1 $search_query ORDER BY uid DESC ");
    	return $contents;
    }


    private function sort_data( $a, $b ){
        // Set defaults
        $orderby = 'uid';
        $order = 'desc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }

        $result = strnatcmp( $a->$orderby, $b->$orderby );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }

    function get_bulk_actions(){
        return array(
                'delete_all' => __('삭제')
        );
    }

    // function process_bulk_action() {        
    //     global $wpdb;

    //     if( 'delete_all' === $this->current_action() ) {
    //        foreach($_GET['uid'] as $id) {
    //             $wpdb->query("DELETE FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$id'");
    //         }
    //     } else if('delete' === $this->current_action()){ 
    //         $id = $_GET['uid'];   
    //         $wpdb->query("DELETE FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$id'");
    //     } 
    // }
		


}
?>