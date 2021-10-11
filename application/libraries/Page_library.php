<?php 

/**
* This libarray is created for setting a page.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class Page_library {

	// creating a variable
	protected $title = null;

	protected $headCss = [];
	protected $headJs = [];
	protected $footerJs = [];

	protected $header = null;
	protected $ci;
	
	public function __construct() {
		$this->ci = & get_instance();	
	}


	/**
	 * Set page title
	 */

	public function setTitle($title = "") {
		$this->title = $title;
	}


	/**
	 * Get page title
	 */
	public function getTitle($title = "") {
		return $this->title;
	}

	/**
	 * set head style of page
	 */
	public function setHeadStyle($css = '') {
		array_push($this->headCss, $css);
	}

	/**
	 * get head style of page
	 */
	public function getHeadStyle($css = '') {
		return $this->headCss;
	}

	/**
	 * set head js of page
	 */
	public function setHeadJs($js = '') {
		array_push($this->headJs, $js);
	}

	/**
	 * get head js of page
	 */
	public function getHeadJs($js = '') {
		return $this->headJs;
	}

	/**
	 * set footer js of page
	 */
	public function setFooterJs($js = '') {
		array_push($this->footerJs, $js);
	}

	/**
	 * get footer js of page
	 */
	public function getFooterJs($js = '') {
		return $this->footerJs;
	}


	/**
	 * get page to be display
	 */
	public function getPage($sourceView = '',$data = null,$return = false) {
		if($return) {
			return $this->ci->load->view($sourceView,$data,$return);
		}else {
			$this->ci->load->view($sourceView,$data,$return);	
		}
		
	}

	/**
	 * get layout
	 */
	public function getLayout($data = null) {
		$this->ci->load->view('layout/layout',$data);
	}

	/**
	 * get Login layout
	 */
	public function getLoginLayout($data = null) {
		$this->ci->load->view('layout/loginLayout',$data);
	}


} 