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
 * - 생산 지시 목록을 반환 한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 생산 지시 목록을 반환 한다.
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
$result['production_list'] = [];

$model = $_aqua->new('productionModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* company_no : 기업번호 '.PHP_EOL;	
	$result .= '	search_schedule_date : 생산일 ex)2020-03-24 / 공백 - 서버시간 기준 오늘일자'.PHP_EOL;
	$result .= '	production_status : 처리상태  S - 예정 / I - 진행중 / D - 완료'.PHP_EOL;
	$result .= '	approval_state : 승인요청  W - 대기 / R - 요청 /  D - 승인완료 '.PHP_EOL;
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,production_list : [{  '.PHP_EOL;
    $result .= '	    production_idx : 생산지시 번호  '.PHP_EOL;
    $result .= '	    ,produce_no : 제조번호	  '.PHP_EOL;    
    $result .= '	    ,product_name : 제품명	  '.PHP_EOL;
    $result .= '	    ,product_unit : 제품단위	  '.PHP_EOL;
    $result .= '	    ,product_unit_type : 제품 단위용량	  '.PHP_EOL;
    $result .= '	    ,packaging_unit_quantity : 제품 포장 단위수  '.PHP_EOL;
    $result .= '	    ,schedule_date : 생산일자  '.PHP_EOL;
    $result .= '	    ,schedule_quantity : 생산량  '.PHP_EOL;
    $result .= '	    ,pouch_quantity : 파우치생산량	  '.PHP_EOL;
    $result .= '	    ,box_quantity : 박스생산량	  '.PHP_EOL;
    $result .= '	    ,orderer_name : 지시자 명	  '.PHP_EOL;
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

$where = " AND ( del_flag='N' ) AND company_idx = '". $params['company_no'] ."' ";
$order = " ORDER BY production_idx DESC ";

if( $params['production_status'] ) {
    $where .= " AND production_status = '". $params['production_status'] ."' ";
}

if( $params['approval_state'] ) {
    $where .= " AND approval_state = '". $params['approval_state'] ."' ";
}

if( $params['search_schedule_date'] ) {
    $where .= " AND schedule_date = '". $params['search_schedule_date'] ."' ";
} else {
    $where .= " AND schedule_date = '". date('Y-m-d') ."' ";
}

$query_result = $model->getProductionOrder( $where . $order );    


$result['status'] = 'success';
$result['production_list'] = [];

if( $query_result['num_rows'] > 0 ) {
    foreach( $query_result['rows'] AS $idx=>$val ) {
        $result['production_list'][$idx]['production_idx'] = $val['production_idx'];        
        $result['production_list'][$idx]['produce_no'] = $val['produce_no'];        
        $result['production_list'][$idx]['product_name'] = $val['product_name'];
        $result['production_list'][$idx]['product_unit'] = $val['product_unit'];
        $result['production_list'][$idx]['product_unit_type'] = $val['product_unit_type'];
        $result['production_list'][$idx]['packaging_unit_quantity'] = $val['packaging_unit_quantity'];
        $result['production_list'][$idx]['schedule_date'] = $val['schedule_date'];
        $result['production_list'][$idx]['schedule_quantity'] = $val['schedule_quantity'];
        $result['production_list'][$idx]['pouch_quantity'] = $val['pouch_quantity'];
        $result['production_list'][$idx]['box_quantity'] = $val['box_quantity'];
        $result['production_list'][$idx]['orderer_name'] = $val['member_name'];
      

    }
}


jsonExit( $result );


?>