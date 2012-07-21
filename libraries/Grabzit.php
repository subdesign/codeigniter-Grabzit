<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* GrabzIt API Wrapper class (http://grabz.it)
*
* Make screenshots of a website
*
* @package CodeIgniter
* @subpackage Libraries
* @category Libraries
* @author Barna Szalai <sz.b@devartpro.com>
* @created 20/07/2012
* @license www.opensource.org/licenses/MIT
*/

class Grabzit
{
	private $_grabzit_application_key = '';
	private $_grabzit_application_secret = '';
	private $_image_dir = '';
	private $_grabzIt;
	private $_ci;

	public function __construct()
	{
		$this->_ci =& get_instance();

		$this->_ci->load->config('grabzit');
		$this->_ci->load->helper('string');
		$this->_grabzit_application_key = $this->_ci->config->item('grabzit_application_key');
		$this->_grabzit_application_secret = $this->_ci->config->item('grabzit_application_secret');
		$this->_image_dir = $this->_ci->config->item('image_dir');

		if(! defined('GRABZIT_ROOT')) define('GRABZIT_ROOT', dirname(__DIR__));

		require_once(GRABZIT_ROOT.'/vendor/GrabzItClient.class.php');

		$this->_grabzIt = new GrabzItClient($this->_grabzit_application_key, $this->_grabzit_application_secret);

		log_message('debug', 'Grabzit library started');
	}

	public function grab_image($params)
	{
		try
		{
			// if we didn't give a filename
			if( ! strlen($params[1]))
		    {
		    	$filename = random_string('alnum', 8).'.jpg';
		    }
		    else
		    {
		    	$filename = $params[1];
		    }		    

		    $params[1] = "";
			
			$id = call_user_func_array(array($this->_grabzIt, "TakePicture"), $params);

			while(true)
			{
			    $result = $this->get_picture($id);

			    if ($result)
			    {
			    	write_file($this->_image_dir.DIRECTORY_SEPARATOR.$filename, $result);			        
			        return $id;
			    }

			    sleep(1);
			}
		}
		catch (Exception $e)
		{
		    return $e->getMessage();
		}
	}

	public function get_picture($id)
	{
		return $this->_grabzIt->GetPicture($id);
	}	

	public function get_status($id)
	{
		return $this->_grabzIt->GetStatus($id);
	}

	public function get_cookies($domain)
	{
		return $this->_grabzIt->GetCookies($domain);
	}
	
	public function set_cookie($name, $domain, $value = "", $path = "/", $httponly = false, $expires = "")
	{
		return $this->_grabzIt->SetCookie($name, $domain, $value, $path, $httponly, $expires);
	}

	public function delete_cookie($name, $domain)
	{
		return $this->_grabzIt->DeleteCookie($name, $domain);
	}	
	
}