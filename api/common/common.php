<?php include_once($_SERVER['DOCUMENT_ROOT']."/index.php"); ?>
<?php

$paging = $_aqua->new('pageHelper');
$params = $paging->getParameters();

if( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
	$result['status'] = 'fail';
	$result['msg'] = '허용되지 않는 접근방식';
	jsonExit( $result );
}

if( apache_request_headers()['access_id'] !== 'masicgong' ) {
	$result['status'] = 'fail';
	$result['msg'] = '권한 없음  - Lv01';
	jsonExit( $result );
}

/**
 * header 값 체크
 */
function checkHeaders(){

	$auth_id = apache_request_headers()['masicgong_auth_id'];
	$auth_token = apache_request_headers()['masicgong_auth_token'];

	if( empty( $auth_id ) == true ){
		$result['status'] = 'fail';
		$result['msg'] = '권한 없음 - Lv02';
		jsonExit( $result );
	}

	if( empty( $auth_token ) == true ){
		$result['status'] = 'fail';
		$result['msg'] = '권한 없음 - Lv03';
		jsonExit( $result );
	}

	# 전달 받은 auth_id 와 auth_token 으로 서비스 조회를 수행한다.
	$return_reqeust = requestApi([
        'request_api' => 'check_auth.php'
        ,'request_data' => [
            'auth_id' => $auth_id
            ,'auth_token' => $auth_token
        ]
	]);
	
	if( $return_reqeust['status'] !== 'success' ) {

		$result['status'] = 'error';
		$result['msg'] = '서버통신 에러 - 토큰의 권한 확인에 실패하였습니다.';
		jsonExit( $result );	

	}


}

/**
 * 마식공 서버에 api 요청
 */
function requestApi( $arg_data ){

	$request = [
		CURLOPT_URL => 'http:'. MASICGONG_DOMAIN . '/api/app/'.$arg_data['request_api']
		,CURLOPT_POST => true
		,CURLOPT_RETURNTRANSFER => true
		,CURLOPT_CONNECTTIMEOUT => 10
		,CURLOPT_TIMEOUT => 10
		,CURLOPT_HTTPHEADER => [
				'Pragma: no-cache'
			, 'Accept: */*'
			, 'Content-Type: application/json'
			, 'Content-Length: ' . strlen( jsonReturn( $arg_data['request_data'] ) )
			, 'masicgong_auth_id : ' . $arg_data['masicgong_auth_id']
			, 'masicgong_auth_token : ' . $arg_data['masicgong_auth_token']
		]
		,CURLOPT_POSTFIELDS => jsonReturn( $arg_data['request_data'] )
	];

	$request_ping = curl_init(); 
	
	curl_setopt_array($request_ping, $request); 
	$request_result = curl_exec($request_ping);

	if( curl_getinfo( $request_ping )['http_code'] == 200 ) {
		$result_data['status'] = 'success';
		$result_data['data'] = json_decode( $request_result , true ); 
	} else {
		$result_data['status'] = 'error';
	}

	curl_close($request_ping);

	return $result_data;
}

/**
 * 필수값 체크용
 */
function issetParams( $arg_params, $arg_check_info ){
	foreach( $arg_check_info AS $check_item ) {            
		if( empty( $arg_params[ $check_item ] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : ' . $check_item;
			jsonExit( $result );	
			break;
		}
	}
}

?>