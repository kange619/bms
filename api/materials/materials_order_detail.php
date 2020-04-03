<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 주문 상세 정보를 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 주문 상세 정보를 반환한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.03.24 - 이정훈
 *  - 주문 상세 정보를 반환한다.
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
$result['order_detail'] = '';

$model_materals = $_aqua->new('materialsModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* order_idx : 주문번호 '.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,order_detail : {  '.PHP_EOL;    
    $result .= '	    ,materials_usage_idx : 자재키 	  '.PHP_EOL;    
    $result .= '	    ,material_kind : raw - 원자재 / sub - 부자재	  '.PHP_EOL;
    $result .= '	    ,company_name : 제품 납품업체	  '.PHP_EOL;
    $result .= '	    ,material_name : 제품명	  '.PHP_EOL;
    $result .= '	    ,standard_info : 규격	  '.PHP_EOL;
    $result .= '	    ,material_unit : 단위	  '.PHP_EOL;
    $result .= '	    ,country_of_origin : 원산지	  '.PHP_EOL;
    $result .= '	    ,material_unit_price : 단가	  '.PHP_EOL;
    $result .= '	    ,quantity : 주문수량  '.PHP_EOL;
    $result .= '	    ,order_date : 주문일시  '.PHP_EOL;
    $result .= '	    ,available_date_type : 사용기한 일자 유형 : MD - 제조일자 / ED - 유통기한	  '.PHP_EOL;
    $result .= '	    ,available_date : 사용기한  '.PHP_EOL;
    $result .= '	}  '.PHP_EOL;

    
	exit( $result );
} 

//
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( empty( $params['order_idx'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : order_idx';
	jsonExit( $result );
}

$where = " order_idx = '". $params['order_idx'] ."' ";

$query_result = $model_materals->getOrder( $where );    


$result['status'] = 'success';

if( $query_result['num_rows'] > 0 ) {
    $result['order_detail']['materials_usage_idx'] = $query_result['row']['materials_usage_idx'];        
    $result['order_detail']['material_code'] = $query_result['row']['material_code'];
    $result['order_detail']['company_name'] = $query_result['row']['company_name'];
    $result['order_detail']['material_kind'] = $query_result['row']['material_kind'];
    $result['order_detail']['material_name'] = $query_result['row']['material_name'];
    $result['order_detail']['standard_info'] = $query_result['row']['standard_info'];
    $result['order_detail']['material_unit'] = $query_result['row']['material_unit'];
    $result['order_detail']['country_of_origin'] = $query_result['row']['country_of_origin'];
    $result['order_detail']['material_unit_price'] = $query_result['row']['material_unit_price'];
    $result['order_detail']['quantity'] = $query_result['row']['quantity'];
    $result['order_detail']['order_date'] = $query_result['row']['order_date'];
    $result['order_detail']['available_date_type'] = $query_result['row']['available_date_type'];
    $result['order_detail']['available_date'] = $query_result['row']['available_date'];
} else {
    $result['order_detail'] = '';
}


jsonExit( $result );


?>