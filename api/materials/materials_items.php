<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 주문 가능한 원부자재 항목 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 주문 가능한 원부자재 항목을 반환한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.03.24 - 이정훈
 *  - 주문 가능한 원부자재 항목 반환
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
$result['materials'] = [];

$model_materals = $_aqua->new('materialsModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* company_no : 기업번호 '.PHP_EOL;
	$result .= '	material_kind : raw - 원자재 / sub - 부자재 / 공백 - 원/부자재'.PHP_EOL;
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,materials : [{  '.PHP_EOL;
    $result .= '	    materials_usage_idx : 자재키  '.PHP_EOL;
    $result .= '	    ,material_company_idx : 자재 납품 회사 기본키	  '.PHP_EOL;
    $result .= '	    ,material_idx : 자재코드	  '.PHP_EOL;
    $result .= '	    ,material_kind : raw - 원자재 / sub - 부자재	  '.PHP_EOL;
    $result .= '	    ,material_name : 제품명	  '.PHP_EOL;
    $result .= '	    ,standard_info : 규격	  '.PHP_EOL;
    $result .= '	    ,material_unit : 단위	  '.PHP_EOL;
    $result .= '	    ,country_of_origin : 원산지	  '.PHP_EOL;
    $result .= '	    ,material_unit_price : 단가	  '.PHP_EOL;
    $result .= '	    ,company_name : 회사명	  '.PHP_EOL;
    $result .= '	}]  '.PHP_EOL;

    
	exit( $result );
} 


#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( empty( $params['company_no'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : company_no';
	jsonExit( $result );
}

$where = " ( as_company.use_flag='Y' ) AND as_material.company_idx = '". $params['company_no'] ."' ";
$order = " ORDER BY material_kind ASC, material_name ASC ";


if( $params['material_kind'] ) {
    $where .= " AND as_material.material_kind = '". $params['material_kind'] ."' ";
}


$query_result = $model_materals->getMaterials( $where . $order );    

$result['status'] = 'success';
$result['materials'] = [];

if( $query_result['num_rows'] > 0 ) {
    foreach( $query_result['rows'] AS $idx=>$val ) {
        $result['materials'][$idx]['materials_usage_idx'] = $val['materials_usage_idx'];
        $result['materials'][$idx]['material_company_idx'] = $val['material_company_idx'];
        $result['materials'][$idx]['material_idx'] = $val['material_idx'];
        $result['materials'][$idx]['material_kind'] = $val['material_kind'];
        $result['materials'][$idx]['material_name'] = $val['material_name'];
        $result['materials'][$idx]['standard_info'] = $val['standard_info'];
        $result['materials'][$idx]['material_unit'] = $val['material_unit'];
        $result['materials'][$idx]['country_of_origin'] = $val['country_of_origin'];
        $result['materials'][$idx]['material_unit_price'] = $val['material_unit_price'];
        $result['materials'][$idx]['company_name'] = $val['company_name'];
    }
}


jsonExit( $result );


?>