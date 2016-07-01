<?php
/**
 * JtmBoard 설정 테이블
 * @link www.cosmosfarm.com
 * @copyright Copyright 2013 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */
class JtmBoard {
	var $uid;
	var $row;

	public function __construct($uid=''){
		if($uid) $this->getView($uid);
	}

	public function getView($uid){
		global $wpdb;
		$this->uid = intval($uid);
		$this->row = $wpdb->get_row("SELECT * FROM `{$wpdb->prefix}jtmplug_setting` WHERE `uid`='$uid'");
			
		// echo '<pre>'; print_r($this->row); echo '</pre>';
		return $this;

	}





}