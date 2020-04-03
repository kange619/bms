<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 주문 상태의 목록을 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 주문 상태의 목록을 반환한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.03.24 - 이정훈
 *  - 주문 상태의 목록을 반환한다.
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
$result['order_list'] = [];

$model_materals = $_aqua->new('materialsModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* company_no : 기업번호 '.PHP_EOL;
	$result .= '	material_kind : raw - 원자재 / sub - 부자재 / 공백 - 원/부자재 '.PHP_EOL;
	$result .= '	search_receipt_date : 입고일 ex)2020-03-24 / 공백 - 서버시간 기준 오늘일자'.PHP_EOL;
	$result .= '	process_state : 처리상태  O - 주문완료 / W - 입고완료 / C - 취소'.PHP_EOL;
	$result .= '	approval_state : 승인요청  W - 대기 / R - 요청 /  D - 승인완료 '.PHP_EOL;
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,order_list : [{  '.PHP_EOL;
    $result .= '	    order_idx : 주문번호  '.PHP_EOL;
    $result .= '	    ,materials_usage_idx : 자재키 	  '.PHP_EOL;    
    $result .= '	    ,material_kind : raw - 원자재 / sub - 부자재	  '.PHP_EOL;
    $result .= '	    ,material_name : 제품명	  '.PHP_EOL;
    $result .= '	    ,standard_info : 규격	  '.PHP_EOL;
    $result .= '	    ,material_unit : 단위	  '.PHP_EOL;
    $result .= '	    ,country_of_origin : 원산지	  '.PHP_EOL;
    $result .= '	    ,material_unit_price : 단가	  '.PHP_EOL;
    $result .= '	    ,process_state : 처리상태  O - 주문완료 / W - 입고완료 / C - 취소	  '.PHP_EOL;
    $result .= '	    ,approval_state : 승인요청  W - 대기 / R - 요청 /  D - 승인완료	  '.PHP_EOL;
    $result .= '	    ,order_date : 주문일시	  '.PHP_EOL;
    $result .= '	    ,receipt_date : 입고(예정)일자	  '.PHP_EOL;
    $result .= '	    ,quantity : 수량	  '.PHP_EOL;
    
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

$where = " ( del_flag='N' ) AND company_idx = '". $params['company_no'] ."' ";
$order = " ORDER BY order_idx DESC, order_date DESC, receipt_date DESC ";

if( $params['material_kind'] ) {
    $where .= " AND material_kind = '". $params['material_kind'] ."' ";
}

if( $params['process_state'] ) {
    $where .= " AND process_state = '". $params['process_state'] ."' ";
}

if( $params['approval_state'] ) {
    $where .= " AND approval_state = '". $params['approval_state'] ."' ";
}

if( $params['search_receipt_date'] ) {
    $where .= " AND receipt_date = '". $params['search_receipt_date'] ."' ";
} else {
    $where .= " AND receipt_date = '". date('Y-m-d') ."' ";
}

$query_result = $model_materals->getOrder( $where . $order );    


$result['status'] = 'success';
$result['order_list'] = [];

if( $query_result['num_rows'] > 0 ) {
    foreach( $query_result['rows'] AS $idx=>$val ) {
        $result['order_list'][$idx]['order_idx'] = $val['order_idx'];        
        $result['order_list'][$idx]['materials_usage_idx'] = $val['materials_usage_idx'];        
        $result['order_list'][$idx]['material_code'] = $val['material_code'];
        $result['order_list'][$idx]['material_kind'] = $val['material_kind'];
        $result['order_list'][$idx]['material_name'] = $val['material_name'];
        $result['order_list'][$idx]['standard_info'] = $val['standard_info'];
        $result['order_list'][$idx]['material_unit'] = $val['material_unit'];
        $result['order_list'][$idx]['country_of_origin'] = $val['country_of_origin'];
        $result['order_list'][$idx]['material_unit_price'] = $val['material_unit_price'];
        $result['order_list'][$idx]['process_state'] = $val['process_state'];
        $result['order_list'][$idx]['approval_state'] = $val['approval_state'];
        $result['order_list'][$idx]['order_date'] = $val['order_date'];
        $result['order_list'][$idx]['receipt_date'] = $val['receipt_date'];
        $result['order_list'][$idx]['quantity'] = $val['quantity'];
    }
}


jsonExit( $result );


?>