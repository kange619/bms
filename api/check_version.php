<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API check version v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 앱 버전 정보를 확인한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 * 
 * [v1.0.0] 2020.03.23 - 이정훈
 *  - 앱 버전 정보 확인
 * 
 * ---------------------------------------------------
*/

#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# SET Values
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
$result = [];

if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;
	$result .= '	* os : 접속 OS : AOS / IOS '.PHP_EOL;
	$result .= '	* app_id : AOS : package name / IOS : bundle id '.PHP_EOL;
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;
	$result .= '	version : 버전  '.PHP_EOL;
	$result .= '	msg : 처리 결과 간략글  '.PHP_EOL;

	exit( $result );
} 

#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
switch( $params['os'] ) {
	case 'AOS' : {

	}
	case 'IOS' : {

		break;
	}
	default : {
		$result['status'] = 'fail';
		$result['msg'] = '잘못된 os정보';
		jsonExit( $result );
	}
}

if( empty( $params['app_id'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : app_id';
	jsonExit( $result );
}

$return_reqeust = requestApi([
	'request_api' => 'check_version.php'
	,'request_data' => [
		'os' => $params['os']
		,'app_id' => $params['app_id']
	]
]);

if( $return_reqeust['status'] == 'success' ) {
	$result['status'] = 'success';
	$result['version'] = $return_reqeust['data']['version'];
	jsonExit( $result );
} else {
	$result['status'] = 'error';
	$result['msg'] = '서버 통신 에러!';
	jsonExit( $result );
}








?>
