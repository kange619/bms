<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 저장고 모니터링 목록을 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 저장고 모니터링별 현황을 반환 한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 저장고 모니터링별 현황을 반환 한다.
 * 
 * ---------------------------------------------------
*/
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 헤더 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
checkHeaders();

#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# SET Values
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
$result = [];

$result['status'] = "success";
$result['msg'] = '';
$result['monitor_list'] = [];

$model = $_aqua->new('haccpModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* company_no : 기업번호 '.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,monitor_list : [{  '.PHP_EOL;
    $result .= '	    storage_idx : 저장고 번호  '.PHP_EOL;
    $result .= '	    ,storage_code : 저장고 코드	  '.PHP_EOL;    
    $result .= '	    ,storage_name : 저장고명	  '.PHP_EOL;    
    $result .= '	    ,min_temperature : 저장고 허용 최저온도	  '.PHP_EOL;    
    $result .= '	    ,max_temperature : 저장고 허용 최고온도	  '.PHP_EOL;    
    $result .= '	    ,temp_state : N - 정상 / W - 경고	  '.PHP_EOL;        
    $result .= '	    ,temperature : 최근온도	  '.PHP_EOL;
    $result .= '	    ,reg_date : 최근 측정시간 ( 2020-04-07 11:20:01 )	  '.PHP_EOL;   
    $result .= '	}]  '.PHP_EOL;

    exit( $result );

} 

//
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( empty( $params['company_no'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : company_no';
	jsonExit( $result );
}

$query_result = $model->getStoragesRecencyLog( $params['company_no'] );

$result['status'] = 'success';
$result['monitor_list'] = [];


foreach( $query_result AS $idx=>$val ) {
    $result['monitor_list'][$idx]['storage_idx'] = $val['storage_idx'];        
    $result['monitor_list'][$idx]['storage_code'] = $val['storage_code'];        
    $result['monitor_list'][$idx]['storage_name'] = $val['storage_name'];
    $result['monitor_list'][$idx]['min_temperature'] = $val['min_temperature'];
    $result['monitor_list'][$idx]['max_temperature'] = $val['max_temperature'];
    $result['monitor_list'][$idx]['temp_state'] = $val['temp_state'];
    $result['monitor_list'][$idx]['temperature'] = $val['temperature'];
    $result['monitor_list'][$idx]['reg_date'] = $val['reg_date'];    
}



jsonExit( $result );


?>