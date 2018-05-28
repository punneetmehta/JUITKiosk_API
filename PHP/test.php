<?PHP
	include 'class.JUITKiosk.php';
	$JUITKiosk = new JUITKiosk();
	$JUITKiosk->setLoginDetails("WebKioskUsername","WebKioskPassword");

	print_r($JUITKiosk->getAttendance());
	echo PHP_EOL;
	print_r($JUITKiosk->getDetailAttendance("SUBJECTCODE","DetailAttDATA"));
	echo PHP_EOL;
	print_r($JUITKiosk->getRegisteredSubjects());
	echo PHP_EOL;
	print_r($JUITKiosk->getSubjectsFaculty());
	echo PHP_EOL;
	print_r($JUITKiosk->getSGPACGPA());
	echo PHP_EOL;
	print_r($JUITKiosk->getSemList());
	echo PHP_EOL;
	print_r($JUITKiosk->getSemGrades("SEMCODE"));
	echo PHP_EOL;	