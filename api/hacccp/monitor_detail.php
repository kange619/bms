<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 저장고 모니터링 상세 정보 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 저장고 모니터링 상세 정보를 반환 한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 저장고 모니터링 상세 정보를 반환 한다.
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

$model = $_aqua->new('haccpModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* storage_idx : 저장고 번호 '.PHP_EOL;	
	$result .= '	 date : yyyy-mm-dd ( 공백시 오늘 일자 )'.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,monitor_info : {  '.PHP_EOL;
    $result .= '	    storage_idx : 저장고 번호  '.PHP_EOL;
    $result .= '	    ,storage_code : 저장고 코드	  '.PHP_EOL;    
    $result .= '	    ,storage_name : 저장고명	  '.PHP_EOL;    
    $result .= '	    ,min_temperature : 저장고 허용 최저온도	  '.PHP_EOL;    
    $result .= '	    ,max_temperature : 저장고 허용 최고온도	  '.PHP_EOL;    
    $result .= '	    ,temp_state : N - 정상 / W - 경고	  '.PHP_EOL;        
    $result .= '	    ,temperature : 최근온도	  '.PHP_EOL;
    $result .= '	    ,reg_date : 최근 측정시간 ( 2020-04-07 11:20:01 )	  '.PHP_EOL;   
    $result .= '	}  '.PHP_EOL;
    $result .= '	,monitor_log :[{  '.PHP_EOL;
    $result .= '	    temperature : 측정 온도  '.PHP_EOL;
    $result .= '	    ,reg_date : 측정시간 ( 2020-04-07 11:20:01 )	  '.PHP_EOL;   
    $result .= '	}]  '.PHP_EOL;

    exit( $result );

} 

//
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( empty( $params['storage_idx'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : storage_idx';
	jsonExit( $result );
}

$query_result = $model->getStorage( " AND storage_idx = '" . $params['storage_idx'] . "' " );

if( $query_result['num_rows'] > 0 ) {

    $result['status'] = 'success';
    $result['monitor_log'] = [];

    $result['monitor_info']['storage_idx'] = $query_result['row']['storage_idx'];        
    $result['monitor_info']['storage_code'] = $query_result['row']['storage_code'];        
    $result['monitor_info']['storage_name'] = $query_result['row']['storage_name'];
    $result['monitor_info']['min_temperature'] = $query_result['row']['min_temperature'];
    $result['monitor_info']['max_temperature'] = $query_result['row']['max_temperature'];
    $result['monitor_info']['temp_state'] = $query_result['row']['temp_state'];
    $result['monitor_info']['temperature'] = $query_result['row']['temperature'];
    $result['monitor_info']['reg_date'] = $query_result['row']['reg_date'];    

    if( isset( $params['date'] ) == false ) {
        $params['date'] = date('Y-m-d');
    } 

    # 저장소 데이터 요청        
    $list_result = $model->getStorageLogs([
        'query_where' => " AND ( storage_code = '" . $result['monitor_info']['storage_code'] . "' )  AND ( date_format(reg_date, '%Y-%m-%d') = '". $params['date'] ."' ) "
        ,'query_sort' => ' ORDER BY temp_log_idx ASC '
        ,'limit' => ' LIMIT 1500 '
    ]);

    if( $list_result['total_rs'] > 0 ) {
        foreach( $list_result['rows'] AS $idx=>$val ) {            
            $result['monitor_log'][$idx]['temperature'] = $val['temperature'];
            $result['monitor_log'][$idx]['reg_date'] = $val['reg_date'];    
        }
    } 
    

} else {
    $result['status'] = 'fail';
	$result['msg'] = '데이터 없음';
	jsonExit( $result );
}



jsonExit( $result );


?>