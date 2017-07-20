<?php
class Database {
	var $domain_id;
	var $conn;
	var $table;
	var $sql;
	var $result;
	var $size;
	var $rows;
	var $insert_id;
	/// var for tree structure
	var $primary_key;
	var $parent_table;
	var $child_table;
	var $parent_primary_key;
	var $child_primary_key;
	var $error;
	// var for tranlslate
	var $site_language;
	var $is_translate = false;
	var $parent_translate_table;
	var $translate_table;
	// var for live
	var $live_table;
	var $stat_table;
	public function __construct($table,$primary_key='id'){
		$this->connect() ;
		$this->table = $table ;
		$this->primary_key = $primary_key ;
		$this-> select_db();
	}
	function domainCheck(){
		$allowed_hosts = array('example.com');
		if(!in_array($_SERVER['HTTP_HOST'], $allowed_hosts)) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
			exit;
		}
 	}
	public function connect(){
		$this->conn = @mysql_connect(DB_SERVER,DB_USER,DB_PASS);
	}
	public function select_db(){
			@mysql_select_db(DB_DATABASE,$this->conn) ;
			@mysql_query("SET NAMES UTF8"); 
			@mysql_query("SET CHARACTER SET 'uft8'");  
	}
	private function disconnect() {
		return @mysql_close();
	}
	private function query(){
		$this->result = NULL ;
		$this->result = mysql_query($this->sql) or die( mysql_error() );
	}
	private function num_rows() {
		return @mysql_num_rows($this->result);
	}
	private function free_result() {
		return @mysql_free_result($this->result);
	}
	private function num_fields() {
		return @mysql_num_fields($this->result);
	}
	private function fields_name($offset) {
		return mysql_field_name($this->result);
	}
	private function fetch_array() {
		return @mysql_fetch_array($this->result,MYSQL_ASSOC);
	}
	private function fetch_assoc() {
		return mysql_fetch_assoc($this->result);
	}
	private function fetch_rows() {
		return @mysql_fetch_row($this->result);
	}
	private function fetch_object() {
		return @mysql_fetch_object($result);
	}
	private function fetch_field() {
		return @mysql_fetch_field($result);
	}
	public function insertID() {
		return mysql_insert_id();
	}
	public function NumRows() {
		return mysql_num_rows($this->result);
	}
	public function select(){
		 $this->query();
	}
	public function setRows(){
		$this->rows =NULL;
		$cnt=0 ;
		while($row=$this->fetch_assoc()){
			$this->rows [$cnt] = $row; 
			$cnt++;
		}
		$this-> free_result();
	}
	
	public function getRows(){
		$this->rows =NULL;
		$cnt=0;
		while($row=$this->fetch_assoc()){
			$this->rows [$cnt] = $row; 
			$cnt++;
		}
		$this-> free_result();
		return $this->rows;
	}
	public function insert(){
		$result = $this->query();
		$this->insert_id = $this->insertID();
		return $this->insert_id; 
	}
	public function update(){
		 return $this->query();
	}
	public function delete(){
		 return $this->query();
	}
	public function createSlug($str){ 
		$str = $this->sanitize($str);
		return $str;
	}
	private function utf8_uri_encode( $utf8_string, $length = 0 ) {
	    $unicode = '';
	    $values = array();
	    $num_octets = 1;
	    $unicode_length = 0;

	    $string_length = strlen( $utf8_string );
	    for ($i = 0; $i < $string_length; $i++ ) {

	        $value = ord( $utf8_string[ $i ] );

	        if ( $value < 128 ) {
	            if ( $length && ( $unicode_length >= $length ) )
	                break;
	            $unicode .= chr($value);
	            $unicode_length++;
	        } else {
	            if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

	            $values[] = $value;

	            if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
	                break;
	            if ( count( $values ) == $num_octets ) {
	                if ($num_octets == 3) {
	                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
	                    $unicode_length += 9;
	                } else {
	                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
	                    $unicode_length += 6;
	                }

	                $values = array();
	                $num_octets = 1;
	            }
	        }
	    }

	    return $unicode;
	}
	private function seems_utf8($str) {
	    $length = strlen($str);
	    for ($i=0; $i < $length; $i++) {
	        $c = ord($str[$i]);
	        if ($c < 0x80) $n = 0; # 0bbbbbbb
	        elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
	        elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
	        elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
	        elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
	        elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
	        else return false; # Does not match any model
	        for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
	            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
	                return false;
	        }
	    }
	    return true;
	}
	private function sanitize($title) {
	    $title = strip_tags($title);
	    // Preserve escaped octets.
	    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	    // Remove percent signs that are not part of an octet.
	    $title = str_replace('%', '', $title);
	    // Restore octets.
	    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
	    if ($this->seems_utf8($title)) {
	        if (function_exists('mb_strtolower')) {
	            $title = mb_strtolower($title, 'UTF-8');
	        }
	        $title = $this->utf8_uri_encode($title, 2048);
	    }
	    $title = strtolower($title);
	    $title = preg_replace('/&.+?;/', '', $title); // kill entities
	    $title = str_replace('.', '-', $title);
	    $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	    $title = preg_replace('/\s+/', '-', $title);
	    $title = preg_replace('|-+|', '-', $title);
	    $title = trim($title, '-');
	    return $title;
	}
	public function datePickerToTime($in_date){
		list($date,$time) = explode(' ',$in_date) ;
		list($month,$day,$year) = explode('/',$date);
		return $year.'-'.$month.'-'.$day.' '.$time.':00' ;
	}
	public function timeToDatePicker($in_date){
		list($date,$time) = explode(' ',$in_date) ;
		list($year,$month,$day) = explode('-',$date);
		list($h,$m,$s)=explode(':',$time);
		return $month.'/'.$day.'/'. $year.' '.$h.':'.$m ;
	}
	public function setString($string){ 
		return htmlentities($string,ENT_QUOTES,'UTF-8');
	}
	public function getString($string){
		return html_entity_decode($string,ENT_QUOTES,'UTF-8');
	}
	public function setInt($int){
		return (int)addslashes($int);
	}
	public function setFloat($float){
		return (float)addslashes($float);
	}
}
?>