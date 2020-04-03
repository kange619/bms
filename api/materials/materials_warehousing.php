<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 원부자재 주문/입고 처리 v1.0.1
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.1]
 * - 원부자재 주문/입고 처리를 한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 * 
 * [v1.0.0] 2020.03.24 - 이정훈
 *  - 원부자재 주문/입고 처리
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
$result['new_order_idx'] = '';

$model_materals = $_aqua->new('materialsModel');

if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;
	$result .= '	* mode : order - 신규 / warehousing - 입고처리 ( 신규/수정 )'.PHP_EOL;
	$result .= '	* member_no : 회원번호 '.PHP_EOL;
	$result .= '	* company_no : 회원기업번호 '.PHP_EOL;	
	$result .= '	* materials_usage_idx : 자재키 	  '.PHP_EOL;    
    $result .= '	* material_idx : 자재기본키	  '.PHP_EOL;
    $result .= '	* material_kind : raw - 원자재 / sub - 부자재	  '.PHP_EOL;
    $result .= '	* material_name : 제품명	  '.PHP_EOL;
    $result .= '	* standard_info : 규격	  '.PHP_EOL;
    $result .= '	* material_unit : 단위	  '.PHP_EOL;
    $result .= '	* country_of_origin : 원산지	  '.PHP_EOL;
    $result .= '	* material_unit_price : 단가	  '.PHP_EOL;
    $result .= '	* quantity : 주문수량  '.PHP_EOL;
    $result .= '	  order_idx : 주문번호 (입고처리 수정시 필수)'.PHP_EOL;
    $result .= '	  order_date : 주문일시  '.PHP_EOL;
    $result .= '	  receipt_date : 입고일시 (warehousing 모드 처리시 필수)  '.PHP_EOL;
    $result .= '	  available_date_type : 사용기한 일자 유형 : MD - 제조일자 / ED - 유통기한	(warehousing 모드 처리시 필수)   '.PHP_EOL;
    $result .= '	  available_date : 사용기한  (warehousing 모드 처리시 필수)  '.PHP_EOL;
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	new_order_idx : 신규인 경우'.PHP_EOL;
    
	exit( $result );
} 

switch( $params['mode'] ) {
    case 'order' : {

        issetParams( $params, [
            'materials_usage_idx'                                     
            ,'company_no'                                     
            ,'material_kind'                               
            ,'material_name'                                     
            ,'standard_info'                                     
            ,'material_unit'                                     
            ,'country_of_origin'                                     
            ,'material_unit_price'                                     
            ,'quantity'                                            
        ]);
        
        
        if( empty( $params['order_date'] ) == true ) {
            $params['order_date'] = date('Y-m-d');
        }
    
        $model_materals = $_aqua->new('materialsModel');
    
        # 트랜잭션 시작
        $model_materals->runTransaction();
    
        $insert_data = [
            'company_idx' => $params['company_no']
            ,'materials_usage_idx' => $params['materials_usage_idx']
            ,'material_idx' => $params['material_idx']
            ,'material_kind' => $params['material_kind']
            ,'material_name' => $params['material_name']
            ,'material_unit' => $params['material_unit']
            ,'standard_info' => $params['standard_info']
            ,'country_of_origin' => $params['country_of_origin']
            ,'material_unit_price' => $params['material_unit_price']
            ,'quantity' => $params['quantity']
            ,'order_date' => $params['order_date']                          
            ,'available_date_type' => $params['available_date_type']                            
            ,'process_state' => 'O'
            ,'reg_idx' => $params['member_no'] 
            ,'reg_date' => 'NOW()'
            ,'reg_ip' => $_aqua->getIP()
        ];
    
        if( empty( $params['receipt_date'] ) == false ) {
            $insert_data['receipt_date'] = $params['receipt_date'];
        }
    
        if( empty( $params['available_date'] ) == false ) {
            $insert_data['available_date'] = $params['available_date'];
        }
    
        # 주문 정보 삽입
        $query_result = $model_materals->insetOrder( $insert_data );
                
        $get_insert_id =  $query_result['return_data']['insert_id'];
        
        $model_materals->updateOrder([ 'order_group_no' => $get_insert_id ], " order_idx = '" . $get_insert_id. "'" );
    
        # 트랜잭션 종료
        $model_materals->stopTransaction();
    
        $result['status'] = 'success';        
        $result['new_order_idx'] = $get_insert_id;        
        jsonExit( $result );

        break;
    }
    case 'warehousing' : {

        issetParams( $params, [        
            'company_no'                                                                     
            ,'materials_usage_idx'                                     
            ,'material_kind'                                    
            ,'material_name'                                     
            ,'standard_info'           
            ,'material_unit'                                     
            ,'country_of_origin'                                     
            ,'material_unit_price'                                     
            ,'quantity'                                     
            ,'order_date'                                     
            ,'receipt_date'                                     
            ,'available_date_type'                                     
            ,'available_date'                                     
        ]);

        
        if( empty( $params['order_idx'] ) == true ) {
            # 삽입
            if( empty( $params['order_date'] ) == true ) {
                $params['order_date'] = date('Y-m-d');
            }
        
            $model_materals = $_aqua->new('materialsModel');
        
            # 트랜잭션 시작
            $model_materals->runTransaction();
        
            $insert_data = [
                'company_idx' => $params['company_no']
                ,'materials_usage_idx' => $params['materials_usage_idx']
                ,'material_kind' => $params['material_kind']
                ,'material_name' => $params['material_name']
                ,'material_unit' => $params['material_unit']
                ,'standard_info' => $params['standard_info']
                ,'country_of_origin' => $params['country_of_origin']
                ,'material_unit_price' => $params['material_unit_price']
                ,'quantity' => $params['quantity']
                ,'order_date' => $params['order_date']                          
                ,'available_date_type' => $params['available_date_type']
                ,'process_state' => 'W'                            
                ,'approval_state' => 'R'                            
                ,'reg_idx' => $params['member_no'] 
                ,'reg_date' => 'NOW()'
                ,'reg_ip' => $_aqua->getIP()
            ];
        
            if( empty( $params['receipt_date'] ) == false ) {
                $insert_data['receipt_date'] = $params['receipt_date'];
            }
        
            if( empty( $params['available_date'] ) == false ) {
                $insert_data['available_date'] = $params['available_date'];
            }
        
            # 주문 정보 삽입
            $query_result = $model_materals->insetOrder( $insert_data );
                    
            $get_insert_id =  $query_result['return_data']['insert_id'];
            
            $model_materals->updateOrder([ 'order_group_no' => $get_insert_id ], " order_idx = '" . $get_insert_id. "'" );
            
            # 같은 주문 존재 확인
            $query_result = $model_materals->doubleCheckStock( " ( company_idx='". COMPANY_CODE ."' ) AND ( order_idx='". $get_insert_id ."' ) " );

            if( $query_result == 0 ) {

                $insert_data = [
                    'company_idx' => $params['company_no']                    
                    ,'order_idx' => $get_insert_id
                    ,'materials_usage_idx' => $params['materials_usage_idx']
                    ,'material_idx' => $params['material_idx']
                    ,'material_kind' => $params['material_kind']
                    ,'material_name' => $params['material_name']
                    ,'product_name' => $params['product_name']
                    ,'material_unit' => $params['material_unit']
                    ,'standard_info' => $params['standard_info']
                    ,'country_of_origin' => $params['country_of_origin']
                    ,'material_unit_price' => $params['material_unit_price']
                    ,'quantity' => $params['quantity']
                    ,'order_date' => $params['order_date']                    
                    ,'receipt_date' => $params['receipt_date']         
                    ,'available_date_type' => $params['available_date_type']                    
                    ,'available_date' => $params['available_date']                               
                    ,'task_type' => 'I'                    
                    ,'reg_idx' => $params['member_no']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $_aqua->getIP()
                ];

                
                # 주문 정보 삽입
                $query_result = $model_materals->insertStock( $insert_data );
            }

            # 트랜잭션 종료
            $model_materals->stopTransaction();
        
            $result['status'] = 'success';
            $result['new_order_idx'] = $get_insert_id;        
            jsonExit( $result );
            
        } else {
            # 갱신

            issetParams( $params, [        
                'order_idx'                           
            ]);


            # 트랜잭션 시작
            $model_materals->runTransaction();

            $update_data = [
                'company_idx' => $params['company_no']
                ,'materials_usage_idx' => $params['materials_usage_idx']
                ,'material_idx' => $params['material_idx']
                ,'material_kind' => $params['material_kind']
                ,'material_name' => $params['material_name']
                ,'material_unit' => $params['material_unit']
                ,'standard_info' => $params['standard_info']
                ,'country_of_origin' => $params['country_of_origin']
                ,'material_unit_price' => $params['material_unit_price']
                ,'quantity' => $params['quantity']
                ,'order_date' => $params['order_date']                          
                ,'available_date_type' => $params['available_date_type']                            
                ,'available_date' => $params['available_date']                            
                ,'process_state' => 'W'                            
                ,'approval_state' => 'R'    
                ,'edit_idx' => $params['member_no'] 
                ,'edit_date' => 'NOW()'
                ,'edit_ip' => $_aqua->getIP()
            ];


            # 주문 정보 수정
            $query_result = $model_materals->updateOrder( $update_data , " order_idx = '" . $params['order_idx']. "'" );
            

            # 같은 주문 존재 확인
            $query_result = $model_materals->doubleCheckStock( " ( company_idx='". COMPANY_CODE ."' ) AND ( order_idx='". $params['order_idx'] ."' ) " );

            if( $query_result == 0 ) {

                $insert_data = [
                    'company_idx' => $params['company_no']                    
                    ,'order_idx' => $params['order_idx']
                    ,'materials_usage_idx' => $params['materials_usage_idx']
                    ,'material_idx' => $params['material_idx']
                    ,'material_kind' => $params['material_kind']
                    ,'material_name' => $params['material_name']
                    ,'product_name' => $params['product_name']
                    ,'material_unit' => $params['material_unit']
                    ,'standard_info' => $params['standard_info']
                    ,'country_of_origin' => $params['country_of_origin']
                    ,'material_unit_price' => $params['material_unit_price']
                    ,'quantity' => $params['quantity']
                    ,'order_date' => $params['order_date']                    
                    ,'receipt_date' => $params['receipt_date']         
                    ,'available_date_type' => $params['available_date_type']                    
                    ,'available_date' => $params['available_date']                               
                    ,'task_type' => 'I'                    
                    ,'reg_idx' => $params['member_no'] 
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $_aqua->getIP()
                ];

            
                # 주문 정보 삽입
                $query_result = $model_materals->insertStock( $insert_data );
            }
            
            # 트랜잭션 종료
            $model_materals->stopTransaction();

            $result['status'] = 'success';        
            jsonExit( $result );
        }
    
        break;
    }
    default : {
        $result['status'] = 'fail';
        $result['msg'] = '지정되지 않은 mode 입니다. mode 값을 확인 해주세요.';
        jsonExit( $result );
    }
}



?>