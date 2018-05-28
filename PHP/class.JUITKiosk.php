<?PHP

class JUITKiosk {
	private $apiKey = ""; // For Geting API Key, drop me a Mail at juit@puneet.cc
	
	private $baseAPI = "https://12s51emmid.execute-api.ap-south-1.amazonaws.com/v1/";
	private $KIOSKuid;
	private $KIOSKpwd;
	private $KIOSKsession = "";
	
	/* Constructors */
	public function JUITKiosk(){ 
		if(empty($this->apiKey)){
			die("Please Configure API Key First");
		}
	}
	
	/* Login */
	public function setLoginDetails($username,$password){
		$this->KIOSKuid = $username;
		$this->KIOSKpwd = urlencode($password);
		if($this->doLogin()==false){ 
			die("Invalid Login Details");
		}
	}
	
	private function doLogin(){
		$url = $this->baseAPI."JUITKiosk_Login?uid=".$this->KIOSKuid."&pwd=".$this->KIOSKpwd;
		$response = json_decode($this->getResponse($url),1);
		if($response["loginResult"]==1){
			$this->setKioskSession($response["loginCookies"]);
			return true;
		} else {
			return false;
		}
	}
	
	private function setKioskSession($session){ $this->KIOSKsession = $session; }
	private function getKioskSession(){ return $this->KIOSKsession; }
	
	/* getUserDetails() */
	public function getUserDetails(){
		$url = $this->baseAPI."JUITKiosk_UserDetails?session=".$this->getKioskSession();
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}
	
	/* getAttendance() */
	public function getAttendance(){
		$url = $this->baseAPI."JUITKiosk_Attendance?session=".$this->getKioskSession();
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}	

	/* getDetailAttendance() */
	public function getDetailAttendance($subjectCode,$detailAttendanceDATA){
		$url = $this->baseAPI."JUITKiosk_DetailAttendance?session=".$this->getKioskSession()."&code=".$subjectCode."&data=".urlencode($detailAttendanceDATA);
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}	
	
	/* getRegisteredSubjects() */
	public function getRegisteredSubjects(){
		$url = $this->baseAPI."JUITKiosk_Academic_RegisteredSubjects?session=".$this->getKioskSession();
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}

	/* getSubjectsFaculty() */
	public function getSubjectsFaculty(){
		$url = $this->baseAPI."JUITKiosk_Academics_SubjectFaculty?session=".$this->getKioskSession();
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}
	
	/* getSGPACGPA() */
	public function getSGPACGPA(){
		$url = $this->baseAPI."JUITKiosk_ExamInfo_SGPA_CGPA?session=".$this->getKioskSession();
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}

	/* getSemList() */
	public function getSemList(){
		$url = $this->baseAPI."JUITKiosk_ExamInfo_GetSemesters?session=".$this->getKioskSession();
		$response = json_decode($this->getResponse($url),1);
		return $response;
	}
	
	/* getSemGrades() */
	public function getSemGrades($sem){
		$url = $this->baseAPI."JUITKiosk_ExamInfo_GetGradesBySem?session=".$this->getKioskSession()."&sem=".$sem;
		$response = json_decode($this->getResponse($url),1);
		return $response;		
	}
	
	public function getResponse($url){
		$headers = array('x-api-key:'.$this->apiKey);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	 
		$result = curl_exec($ch);
		return $result;
	}
	
}

?>