<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 수주 출하처리 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 수주 출하처리
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 *  
 * [v1.0.0] 2020.04.07 - 이정훈
 *  - 수주 출하처리
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
$model_product = $_aqua->new('productModel');
$model_auth = $_aqua->new('authModel');         


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;	
    $result .= '	* order_no : 수주번호 '.PHP_EOL;	
    $result .= '	* member_no : 회원번호'.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	,msg : 처리 결과 간략글  '.PHP_EOL;

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

if( empty( $params['member_no'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : member_no';
	jsonExit( $result );
}

# 회원 로그인 처리
$login_state = $model_auth->loginApp( $params['member_no'] );

# 수주정보를 요청한다.
$query_result = $model->getReceiveOrder( " order_idx = '". $params['order_no'] ."' " );

if( $query_result['num_rows'] == 0 ){
    
    $result['status'] = 'fail';
	$result['msg'] = '해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.';
    jsonExit( $result );
    
} else {

    $result['status'] = 'success';
    
    $client_obj = $_aqua->new('client');

// echoBr( $query_result['row']['product_stock_idxs'] );

# 주문건에 해당하는 제품의 유통기한 별 재고 요청
    $result_expiration_date = $model_product->getAvailableStockByExpirationDate( $query_result['row']['product_unit_idx'] );     
    
    // echoBr( $result_expiration_date );

    if( $result_expiration_date['num_rows'] > 0 ) {
        # 재고 여유

        $quantity = (int)$query_result['row']['quantity'];

        $prediction_info = $client_obj->predictionUseStock([
            'quantity' => $quantity
            ,'expiration_date_arr' => $result_expiration_date['rows']
        ]);

        
        $product_stock_used_info = $client_obj->productUseProc( $query_result['row']['order_idx'], explode(',', $prediction_info['prediction_stock_idxs']), $quantity );
        
        // echoBr( $product_stock_used_info );

        # 트랜잭션 시작
        $model->runTransaction();

        # 수주정보 수정
        $query_result = $model->updateClientReceiveOrder([                         
            'product_stock_used_info' => jsonReturn( $product_stock_used_info )
            ,'approval_state' => 'R'
            ,'process_state' => 'D'
            ,'edit_idx' => getAccountInfo()['idx']
            ,'edit_date' => 'NOW()'
            ,'edit_ip' => $_aqua->getIP()
        ] ," order_idx = '" . $params['order_no'] . "'" );

        # 트랜잭션 종료
        $model->stopTransaction();


    } else {
        # 재고 없음

        $result['status'] = 'fail';
        $result['msg'] = '제품의 재고가 소진되어 출하를 진행할 수 없습니다.';
        jsonExit( $result );
        
    }


    jsonExit( $result );    

}


?>