<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 출하관리 > 수주 상세데이터 반환 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 수주 상세데이터
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 수주 상세데이터
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
$result['order_info'] = [];

$model = $_aqua->new('clientModel');
$model_product = $_aqua->new('productModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
	$result .= '	* order_no : 수주번호 '.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	,msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	,order_info : {  '.PHP_EOL;
    $result .= '	    ,order_no : 수주번호	  '.PHP_EOL;    
    $result .= '	    ,company_name : 고객사명	  '.PHP_EOL;    
    $result .= '	    ,branch_name : 지점명	  '.PHP_EOL;    
    $result .= '	    ,product_name : 제품명	  '.PHP_EOL;    
    $result .= '	    ,product_unit : 용량/중량	  '.PHP_EOL;    
    $result .= '	    ,product_unit_type : g/kg/ml/L	  '.PHP_EOL;    
    $result .= '	    ,packaging_unit_quantity : 포장단위수량	  '.PHP_EOL;    
    $result .= '	    ,quantity : 수주수량	  '.PHP_EOL;    
    $result .= '	    ,order_date : 수주일	  '.PHP_EOL;    
    $result .= '	    ,shipment_date : 출하일	  '.PHP_EOL;    
    $result .= '	}	  '.PHP_EOL;    
    $result .= '	,expiration_dates : [{  '.PHP_EOL;
    $result .= '	    ,expiration_date : 유통기한	  '.PHP_EOL;            
    $result .= '	    ,stock_quantity : 재고수량	  '.PHP_EOL;            
    $result .= '	}]  '.PHP_EOL;        


    exit( $result );

} 

//
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( empty( $params['order_no'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : order_no';
	jsonExit( $result );
}

# 수주정보를 요청한다.
$query_result = $model->getReceiveOrder( " order_idx = '". $params['order_no'] ."' " );

// echoBr( $query_result );

if( $query_result['num_rows'] == 0 ){
    
    $result['status'] = 'fail';
	$result['msg'] = '해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.';
    jsonExit( $result );
    
} else {

    $result['status'] = 'success';
    $result['expiration_dates'] = [];

    $result['order_info']['order_no'] = $query_result['row']['order_idx'];
    $result['order_info']['company_name'] = $query_result['row']['company_name'];
    $result['order_info']['branch_name'] = $query_result['row']['branch_name'];
    $result['order_info']['product_name'] = $query_result['row']['product_name'];
    $result['order_info']['product_unit'] = $query_result['row']['product_unit'];
    $result['order_info']['product_unit_type'] = $query_result['row']['product_unit_type'];
    $result['order_info']['packaging_unit_quantity'] = $query_result['row']['packaging_unit_quantity'];
    $result['order_info']['quantity'] = $query_result['row']['quantity'];
    $result['order_info']['order_date'] = $query_result['row']['order_date'];
    $result['order_info']['shipment_date'] = $query_result['row']['delivery_date'];

    $quantity = (int)$query_result['row']['quantity'];

    # 주문건에 해당하는 제품의 유통기한 별 재고 요청
    $result_expiration_date = $model_product->getAvailableStockByExpirationDate( $query_result['row']['product_unit_idx'] );     
    
    if( $result_expiration_date['num_rows'] > 0 ) {

        $client_obj = $_aqua->new('client');
        // $prediction_info = client::predictionUseStock([
        //     'quantity' => $quantity
        //     ,'expiration_date_arr' => $result_expiration_date['rows']
        // ]); 
        
        $result['expiration_dates'] = $client_obj->predictionUseStock([
            'quantity' => $quantity
            ,'expiration_date_arr' => $result_expiration_date['rows']
        ])['prediction_day_arr'];

     
    } 

    jsonExit( $result );    

}




?>