<?php
/*
Plugin Name: 플러그인 개발
Plugin URI: http://localhost:8080/wp
Description: 플러그인을 만들어 봅시다.
Version: 0.1
Author: 홍길동
Author URI: http://localhost:8080/wp
*/

define('JTMPLUG_DIR_PATH', dirname(__FILE__));
define('JTMPLUG_URL_PATH', plugins_url('', __FILE__));

include_once 'class/JtmNewWidget.class.php';
include_once 'class/JtmBoard.class.php';

function jtm_plugin_register_widget(){
	register_widget('JtmNewWidget');
}
add_action('widgets_init', 'jtm_plugin_register_widget');



/*
 * 관리자메뉴에 추가
 */
add_action('admin_menu', 'jtmplug_settings_menu');
function jtmplug_settings_menu(){
	add_menu_page('페이지 타이틀', '메뉴1', 'administrator', 'jtmplug_setting', 'jtmplug_settings_menu');
	add_submenu_page('jtmplug_setting', '페이지 타이틀', __('서브1', 'sub1'), 'administrator', 'jtmplug_settings_page1', 'jtmplug_settings_page1');
	add_submenu_page('jtmplug_setting', '페이지 타이틀', __('서브2', 'sub2'), 'administrator', 'jtmplug_settings_page2', 'jtmplug_settings_page2');
}

function jtmplug_settings_page1(){


	$uid = isset($_GET['uid'])?$_GET['uid']:'';
	if($uid) $result = new JtmBoard($uid);

	include_once 'view/page1.php';
}


/*
 * 목록 페이지
 */
function jtmplug_settings_page2(){

	global $wpdb;

	include_once 'class/JtmBoardListTable.class.php';
	$table = new JtmBoardListTable();

	if(isset($_GET['uid']) && $_GET['action'] == 'view'){
		wp_redirect(admin_url('admin.php?page=jtmplug_settings_page1&uid=' . $_GET['uid']));

	} else if(isset($_GET['uid']) && 'delete_all' === $table->current_action() ) {
       foreach($_GET['uid'] as $id) {
            $wpdb->query("DELETE FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$id'");
            //echo "DELETE FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$id'";
        }

    } else if(isset($_GET['uid']) &&'delete' === $table->current_action()){ 
        $id = $_GET['uid'];   
        $wpdb->query("DELETE FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$id'");
        // echo "DELETE FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$id'";

    } 

	$table->prepare_items();
	include_once 'view/page2.php';
}




/*
 * 활성화
 */
register_activation_hook(__FILE__, 'jtmplug_activation');
function jtmplug_activation($networkwide){
	global $wpdb;
	// echo '<pre>'; print_r($wpdb); echo '</pre>';
	
	jtmplug_activation_execute();
}


/*
 * 활성화 실행
 */
function jtmplug_activation_execute(){
	global $wpdb;
	
	$wpdb->query("CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}jtmplug_setting` (
		`uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`board_name` varchar(127) NOT NULL,
		`skin` varchar(127) NOT NULL,
		`use_comment` varchar(5) NOT NULL,
		`use_editor` varchar(5) NOT NULL,
		`permission_read` varchar(127) NOT NULL,
		`permission_write` varchar(127) NOT NULL,
		`admin_user` text NOT NULL,
		`use_category` varchar(5) NOT NULL,
		`category1_list` text NOT NULL,
		`category2_list` text NOT NULL,
		`page_rpp` int(10) unsigned NOT NULL,
		`created` char(14) NOT NULL,
		PRIMARY KEY (`uid`)
	) DEFAULT CHARSET=utf8");

}

/*
 * 비활성화
 */
register_deactivation_hook(__FILE__, 'jtmplug_deactivation');
function jtmplug_deactivation($networkwide){
	
}


/*
 * 언인스톨
 */
register_uninstall_hook(__FILE__, 'jtmplug_uninstall');
function jtmplug_uninstall(){
	global $wpdb;
	jtmplug_uninstall_execute();
}


/*
 * 언인스톨 실행
 */
function jtmplug_uninstall_execute(){
	global $wpdb;
	$wpdb->query("DROP TABLE 
		`{$wpdb->prefix}jtmplug_setting`
	");
}



/*
 * 게시판 정보 수정
 */
add_action('admin_post_jtmplug_update_action', 'jtmplug_update');
function jtmplug_update(){
	global $wpdb;

	$uid 				= isset($_POST['uid'])?intval($_POST['uid']):'';
	$board_name 		= isset($_POST['board_name'])?addslashes($_POST['board_name']):'';
	$skin 				= isset($_POST['skin'])?addslashes($_POST['skin']):'';
	$create 			= date('Y-m-d H:i:s', time());


	if(!$uid){
		$wpdb->query("INSERT INTO `{$wpdb->prefix}jtmplug_setting` (`board_name`, `skin`, `page_rpp`, `use_comment`, `use_editor`, `permission_read`, `permission_write`, `admin_user`, `use_category`, `category1_list`, `category2_list`, `created`) VALUES ('$board_name', '$skin', '$page_rpp', '$use_comment', '$use_editor', '$permission_read', '$permission_write', '$admin_user', '$use_category', '$category1_list', '$category2_list', '$create')");
		$uid = $wpdb->insert_id;
	}
	else{
		$wpdb->query("UPDATE `{$wpdb->prefix}jtmplug_setting` SET `board_name`='$board_name', `skin`='$skin', `page_rpp`='$page_rpp', `use_comment`='$use_comment', `use_editor`='$use_editor', `permission_read`='$permission_read', `permission_write`='$permission_write', `use_category`='$use_category', `category1_list`='$category1_list', `category2_list`='$category2_list', `admin_user`='$admin_user' WHERE `uid`='$uid'");
	}
	wp_redirect(admin_url('admin.php?page=jtmplug_settings_page2'));
}


/*
 * 관리자 페이지 스타일 파일을 출력한다.
 */
add_action('admin_enqueue_scripts', 'jtmplug_admin_style', 999);
function jtmplug_admin_style(){
	wp_enqueue_script('jtmplug-admin-js', plugins_url('/develop/js/admin.js'), array());
	wp_enqueue_style('jtmplug-admin-css', plugins_url('/develop/css/admin.css'), array());
}


/*
 * 스크립트와 스타일 파일 등록
 */
add_action('wp_enqueue_scripts', 'jtmplug_css_scripts', 999);
function jtmplug_css_scripts(){
	wp_enqueue_script('jquery');

	
	wp_enqueue_script('jtmplug-jquery-min', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	wp_enqueue_script('jtmplug-script', plugins_url('/develop/js/basic.js'));
	wp_enqueue_style('jtmplug-style', plugins_url('/develop/css/style.css'));
	
}

add_action( 'wp_enqueue_scripts', 'jtmgplug_ajax' );
 function jtmgplug_ajax() {
 
    wp_enqueue_script( 'jtmgplug_ajax_plugin', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ) );
 
    wp_localize_script( 'jtmgplug_ajax_plugin', 'hwangcAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) ); 
}

add_action( 'wp_ajax_jtmplug_post', 'ajax_jtmplug_post');
add_action( 'wp_ajax_nopriv_jtmplug_post', 'ajax_jtmplug_post' );
 
function ajax_jtmplug_post() {
    if ( ! empty( $_POST['uid'] ) ) {
        $post = array('value' => $_POST['uid']);
        echo json_encode( $post );
    } else {
    	echo "fail";
	}
 
    wp_die();
}



/*
 * 게시판 생성 숏코드
 */
add_shortcode('jtmplug', 'jtmplug_builder');
function jtmplug_builder($args){
	if(!$args['id']) return 'plugin 알림 :: id=null, 아이디값은 필수입니다.';
	
	if($args['id']) {
		$result = new JtmBoard($args['id']);
		// echo '<pre>'; print_r($result); echo '</pre>';

		include_once 'view/view1.php';
		
	} else {
		return 'plugin 알림 :: id='.$args['id'].' 는 존재하지 않는 자료 입니다.';
	}
	
}



?>