<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 출하관리 > 지점의 수주 목록을 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 날짜에 해당되는 지점의 수주 목록을
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 날짜에 해당되는 지점의 수주 목록을
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

$model = $_aqua->new('clientModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* branch_no : 지점번호 '.PHP_EOL;	
	$result .= '	 date : yyyy-mm-dd ( 공백시 오늘 일자 )'.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,order_list : [{  '.PHP_EOL;
    $result .= '	    order_no : 수주번호  '.PHP_EOL;
    $result .= '	    ,product_name : 제품명	  '.PHP_EOL;    
    $result .= '	    ,product_unit : 용량/중량	  '.PHP_EOL;    
    $result .= '	    ,product_unit_type : g/kg/ml/L	  '.PHP_EOL;    
    $result .= '	    ,packaging_unit_quantity : 포장단위수량	  '.PHP_EOL;    
    $result .= '	    ,quantity : 수주량	  '.PHP_EOL;    
    $result .= '	    ,shipment_date : 출하일	  '.PHP_EOL;    
    $result .= '	}]  '.PHP_EOL;

    exit( $result );

} 

//
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( isset( $params['branch_no'] ) == false ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : branch_no';
	jsonExit( $result );
}

if( isset( $params['date'] ) == false ) {
    $params['date'] = date('Y-m-d');
} 

$result['status'] = 'success';
$result['order_list'] = [];

# 지점 정보와 날짜에 일치하는 수주 정보를 요청한다.
$query_result = $model->getReceiveOrder("
    ( addr_idx = '". $params['branch_no'] ."' )
    AND ( delivery_date = '". $params['date'] ."' )
    AND ( process_state = 'O' )
");

// echoBr( $query_result );

if( $query_result['num_rows'] > 0  ) {
    foreach( $query_result['rows'] AS $idx=>$val ) {
        $result['order_list'][$idx]['order_no'] = $val['order_idx'];        
        $result['order_list'][$idx]['product_name'] = $val['product_name'];        
        $result['order_list'][$idx]['product_unit'] = $val['product_unit'];    
        $result['order_list'][$idx]['product_unit_type'] = $val['product_unit_type'];    
        $result['order_list'][$idx]['packaging_unit_quantity'] = $val['packaging_unit_quantity'];    
        $result['order_list'][$idx]['quantity'] = $val['quantity'];    
        $result['order_list'][$idx]['shipment_date'] = $val['delivery_date'];    
    }
}


jsonExit( $result );


?>