<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 출하관리 > 수주 지점별 목록을 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 날짜에 해당되는 수주 지점별 목록을 반환 
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 날짜에 해당되는 수주 지점별 목록을 반환
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
$result['branch_list'] = [];

$model = $_aqua->new('clientModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* company_no : 기업번호 '.PHP_EOL;	
	$result .= '	 date : yyyy-mm-dd ( 공백시 오늘 일자 )'.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,branch_list : [{  '.PHP_EOL;
    $result .= '	    branch_no : 지점번호  '.PHP_EOL;
    $result .= '	    ,company_name : 고객사명	  '.PHP_EOL;    
    $result .= '	    ,branch_name : 지점명	  '.PHP_EOL;    
    $result .= '	    ,shipment_date : 출하일	  '.PHP_EOL;    
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

if( isset( $params['date'] ) == false ) {
    $params['date'] = date('Y-m-d');
} 

$result['status'] = 'success';
$result['branch_list'] = [];

$query_result = $model->getReceveOrderbyBranch( $params['company_no'], $params['date'] );


if( $query_result['num_rows'] > 0  ) {
    foreach( $query_result['rows'] AS $idx=>$val ) {
        $result['branch_list'][$idx]['branch_no'] = $val['addr_idx'];        
        $result['branch_list'][$idx]['company_name'] = $val['company_name'];        
        $result['branch_list'][$idx]['branch_name'] = $val['branch_name'];    
        $result['branch_list'][$idx]['shipment_date'] = $val['delivery_date'];    
    }
}


jsonExit( $result );


?>