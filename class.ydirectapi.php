<?php
/**
 * direct - This class is designed for interaction with a service yandex direct with the authorization using OAuth tokens
 *
 * @author sergey prokhorov  <sergey_prokhorov@list.ru>
 * @version 0.0.1
 */
class YDirectApi
{
	private $login = '';
	private $token = '';
	private $appId = '';
	/**
	 * 
	 */
	public function __construct($ydLogin,$authToken,$applicationId) 
	{
		$this->login  = $ydLogin; //login
		$this->token = $authToken; //authorize token
		$this->appId = $applicationId; //id - application
	}

	/**
	 * 
	 */
	function setMethod($name) 
	{
		$this->method = $name;
	}

	/**
	 * 
	 */
	function buildParam($arr) 
	{
		$this->param = $this->utf8($arr);
	}

	/**
	 * 
	 */
	function sendQuery()
	{
		$request = array(
		    'token'=> $this->token, 
		    'application_id'=> $this->appId,
		    'login'=> $this->login,
		    'method'=> $this->method,
		    'param'=> $this->param,
		    'locale'=> 'ru',
		);
		// convert to JSON
		$request = json_encode($request);
		$requestParams = array(
		    'http'=>array(
		    'header' => "Connection: close\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen($request)."\r\n",
			'method'=>"POST",
			'content'=>$request,
		    )
		); 
		$context = stream_context_create($requestParams); 
		// send request and get answer form server
		$result = file_get_contents('https://api.direct.yandex.ru/v4/json', 0, $context);
		return json_decode($result);
	}
	
	/**
	 * 
	 */
	private function utf8($struct) 
	{
	    foreach ($struct as $key => $value) 
	    {
	        if (is_array($value)) {
	            $struct[$key] = $this->utf8($value);
	        }
	        elseif (is_string($value)) {
	            $struct[$key] = utf8_encode($value);
	        }
	    }
	    return $struct;
	}
	
	
	/**
	 * Returns a list of campaigns with brief information about them.
	 */
	
	public function GetCampaignsList() {
		
		$this->setMethod('GetCampaignsList');
		$this->buildParam(array());
		$result = $this->sendQuery();
		return $result;
	}
	/**
	 * Creates a campaign with the specified parameters, or changes the parameters of an existing campaign.
	 * Set CampaignID = 0 if you want to create company, or exists ID for update
	 */
	public function CreateOrUpdateCampaign($params) {
		if (!is_array($params) || empty($params))
			 return false;
		$params['Login'] = $this->login;
		
		$this->setMethod('CreateOrUpdateCampaign');
		$this->buildParam($params);
		return $this->sendQuery();
	}
	
	/**
	 * 
	 */
	public function GetCampaignsListFilter() {
		//TODO: create realisation
		return false;
	}
	
	/**
	 * 
	 */
	public function DeleteCampaign() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function CreateOrUpdateBanners() {
		//TODO: create realisation
	}
	/**
	 * 
	 */
	public function GetBanners() {
		//TODO: create realisation
	}
	/**
	 * 
	 */
	public function GetBannerPhrases() {
		//TODO: create realisation
	}
	/**
	 * 
	 */
	public function GetBannerPhrasesFilter () {
		//TODO: create realisation
	}
	/**
	 * 
	 */
	public function DeleteBanners() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function ResumeCampaign() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function StopCampaign() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function ArchiveCampaign() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function UnArchiveCampaign() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function ModerateBanners() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function ResumeBanners() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function StopBanners() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function ArchiveBanners() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function UnArchiveBanners() {
		//TODO: create realisation
	}
	
	/**
	 * 
	 */
	public function SetAutoPrice() {
		//TODO: create realisation
	}
	/**
	 * 
	 */
	public function UpdatePrices() {
		//TODO: create realisation
	}
	
	/**
	 * Returns the campaign parameters.
	 */
	public function GetCampaignsParams($CampaignIDS) {
		$this->setMethod('GetCampaignsParams');
		$this->buildParam(array("CampaignIDS"=>$CampaignIDS));
		return $this->sendQuery();
	}
	
	/**
	 * Returns statistics for the specified campaigns for each day of the specified period.
	 * 	$CampaignIDS - array(<int>), $StartDate - 2011-05-14, $EndDate - 2011-05-19
	 */
	public function GetSummaryStat($CampaignIDS, $StartDate, $EndDate) {
		$this->setMethod('GetSummaryStat');
		$this->buildParam(array("CampaignIDS"=>$CampaignIDS, "StartDate"=>$StartDate, "EndDate"=>$EndDate));
		return $this->sendQuery();
	}
}	

?>