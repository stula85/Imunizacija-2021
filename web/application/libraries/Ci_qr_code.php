<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * PHP QR Code porting for Codeigniter
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @porting author	dwi.setiyadi@gmail.com
 * @original author	http://phpqrcode.sourceforge.net/
 * @link 			https://github.com/dwisetiyadi/CodeIgniter-PHP-QR-Code
 * @version		1.0
 * @license
 */

class Ci_qr_code
{
	private $_cacheable 		= TRUE;
	private $_cachedir 			= 'global/tmp/cache/';
	private $_error_log_dir 	= 'global/tmp/logs/';
	private $_ci_qr_code_lib 	= 'application/third_party/qrcode/';
	private $_quality 			= TRUE;
	private $_size 				= 1024;


	/**
	 * Constructor
	 */
	public function __construct($config = array())
	{
		$this->initialize($config);
	}

	/**
	 * initialize
	 * Default Method to initailize the QR Code Library
	 *
	 * @access public
	 * @param  array
	 * @return
	 */

	public function initialize($config = array())
	{
		$this->_cacheable 		= (isset($config['cacheable'])) ? $config['cacheable'] : $this->_cacheable;
		$this->_cachedir 		= (isset($config['cachedir'])) ? $config['cachedir'] : FCPATH.$this->_cachedir;
		$this->_error_log_dir 	= (isset($config['errorlog'])) ? $config['errorlog'] : FCPATH.$this->_error_log_dir;
		$this->_ci_qr_code_lib 	= (isset($config['ciqrcodelib'])) ? $config['ciqrcodelib'] : FCPATH.$this->_ci_qr_code_lib;
		$this->_quality 		= (isset($config['quality'])) ? $config['quality'] : $this->_quality;
		$this->_size 			= (isset($config['size'])) ? $config['size'] : $this->_size;

		// use cache - more disk reads but less CPU power, masks and format templates are stored there
		if ( ! defined('QR_CACHEABLE'))
		{
			define('QR_CACHEABLE', $this->_cacheable);
		}

		// used when QR_CACHEABLE === true
		if ( ! defined('QR_CACHE_DIR'))
		{
			define('QR_CACHE_DIR', $this->_cachedir);
		}

		// default error logs dir
		if ( ! defined('QR_LOG_DIR'))
		{
			define('QR_LOG_DIR', $this->_error_log_dir);
		}

		// if true, estimates best mask (spec. default, but extremally slow; set to false to significant performance boost but (propably) worst quality code
		if ($this->_quality)
		{
			if ( ! defined('QR_FIND_BEST_MASK'))
			{
				define('QR_FIND_BEST_MASK', TRUE);
			}
		}
		else {
			if ( ! defined('QR_FIND_BEST_MASK'))
			{
				define('QR_FIND_BEST_MASK', FALSE);
			}
			if ( ! defined('QR_DEFAULT_MASK'))
			{
				define('QR_DEFAULT_MASK', $this->_quality);
			}
		}

		// if false, checks all masks available, otherwise value tells count of masks need to be checked, mask id are got randomly
		if ( ! defined('QR_FIND_FROM_RANDOM'))
		{
			define('QR_FIND_FROM_RANDOM', FALSE);
		}

		// maximum allowed png image width (in pixels), tune to make sure GD and PHP can handle such big images
		if ( ! defined('QR_PNG_MAXIMUM_SIZE'))
		{
			define('QR_PNG_MAXIMUM_SIZE',  $this->_size);
		}

		// call original library
		include_once($this->_ci_qr_code_lib."qrconst.php");
		include_once($this->_ci_qr_code_lib."qrtools.php");
		include_once($this->_ci_qr_code_lib."qrspec.php");
		include_once($this->_ci_qr_code_lib."qrimage.php");
		include_once($this->_ci_qr_code_lib."qrinput.php");
		include_once($this->_ci_qr_code_lib."qrbitstream.php");
		include_once($this->_ci_qr_code_lib."qrsplit.php");
		include_once($this->_ci_qr_code_lib."qrrscode.php");
		include_once($this->_ci_qr_code_lib."qrmask.php");
		include_once($this->_ci_qr_code_lib."qrencode.php");
	}
	/**
	 * generate
	 * Method to generate the qr code
	 *
	 * @access public
	 * @param  array
	 * @return
	 */
	public function generate($params = array())
	{
		if(isset($params['black'])
			&& is_array($params['black'])
			&& count($params['black']) == 3
			&& array_filter($params['black'], 'is_int') === $params['black']) {
			QRimage::$black = $params['black'];
		}

		if(isset($params['white'])
			&& is_array($params['white'])
			&& count($params['white']) == 3
			&& array_filter($params['white'], 'is_int') === $params['white']) {
			QRimage::$white = $params['white'];
		}

		$params['data'] = (isset($params['data'])) ? $params['data'] : 'QR Code Library';


		$level = 'L';
		if(isset($params['level']) && in_array($params['level'], array('L','M','Q','H')))
		{
			$level = $params['level'];
		}

		$size = 4;
		if(isset($params['size']))
		{
			$size = min(max((int)$params['size'], 1), 10);
		}

		if(isset($params['savename']))
		{
			QRcode::png($params['data'], $params['savename'], $level, $size, 2);
			return $params['savename'];
		}
		else
		{
			QRcode::png($params['data'], NULL, $level, $size, 2);
		}
	}
}
// END Ci_qr_code Class
/* End of file Ci_qr_code.php */
/* Location: ./application/libraries/Ci_qr_code.php */