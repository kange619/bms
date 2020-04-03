<?php
/**
 * ---------------------------------------------------
 * AQUA Framework 생산관리 v1.0.0
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 * 
 * [v1.0.0] 2020.03.28 - 이정훈 
 *  - production_list() 개발
 *  - production_write() 개발
 *  - get_expiration_date_json() 개발
 *  - get_new_produce_no_json() 개발
 * 
 * ---------------------------------------------------
*/
class production extends baseController {

    private $model;    
    private $model_material;    
    private $paging;
    
    function __construct() {
        
        #로그인 확인
        loginState();
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('productionModel');         
        $this->model_product = $this->new('productModel');         
        $this->model_material = $this->new('materialsModel');         
       
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # GET parameters
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data = $this->paging->getParameters();
       
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET params
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data['params'] = $this->paging->setParams([
            'top_code'
            , 'left_code'
            , 'list_rows'
            , 'sch_type'            
            , 'sch_keyword'
            , 'sch_s_date'
            , 'sch_e_date'
            , 'sch_schedule_s_date'
            , 'sch_schedule_e_date'
            , 'sch_order_field'
            , 'sch_order_status'
            , 'sch_production_status'
        ]);

    }

    /**
     * 생산지시 목록 구현
     */
    public function production_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data['production_status_arr'] = [
            'S'=>'예정'
            ,'I'=>'진행중'
            ,'D'=>'완료'
        ];
        $page_name = 'production';
        $query_where = " AND del_flag='N' AND company_idx = '". COMPANY_CODE ."' ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY production_idx DESC ';
        }

        if( $this->page_data['sch_production_status'] ) {
            $query_where .= " AND ( production_status = '".$this->page_data['sch_production_status']."' ) ";
        }
        

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( product_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( produce_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( member_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }


        if($this->page_data['sch_schedule_s_date']) {
            $query_where .= " AND ( schedule_date >= '".$this->page_data['sch_schedule_s_date']."' ) ";
        }

		if($this->page_data['sch_schedule_e_date']) {
            $query_where .= " AND ( schedule_date <= '".$this->page_data['sch_schedule_e_date']."' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getProductionOrders([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);
        
        if( $list_result['total_rs'] > 0 ) {
            $this->page_data['total_schedule_quantity'] = $list_result['rows'][0]['total_schedule_quantity'];
            $this->page_data['total_pouch_quantity'] = $list_result['rows'][0]['total_pouch_quantity'];
            $this->page_data['total_box_quantity'] = $list_result['rows'][0]['total_box_quantity'];
        } else {
            $this->page_data['total_schedule_quantity'] = 0;
            $this->page_data['total_pouch_quantity'] = 0;
            $this->page_data['total_box_quantity'] = 0;
        }
        
        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/production/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];     
           
        $this->view( $this->page_data );

    }

    /**
     * 생산지시 작성페이지 구현
     */
    public function production_write() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'production';

        # 식품 유형
        $this->page_data['food_types'] = $this->getConfig()['food_types'];

        $this->page_data['materials'] = $this->model_material->getMaterialStd(
            " company_idx='". COMPANY_CODE ."' AND material_kind='raw' AND use_flag='Y' AND del_flag='N' "
        )['rows'];

        $this->page_data['sub_materials'] = $this->model_material->getMaterialStd(
            " company_idx='". COMPANY_CODE ."' AND material_kind='sub' AND use_flag='Y' AND del_flag='N' "
        )['rows'];

        $this->page_data['use_material_info'] = '{}';

        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
            $this->issetParams( $this->page_data, ['production_idx']);
            
            $this->page_data['page_work'] = '수정';
            
            # 지시 정보
            $query_result = $this->model->getProductionOrder( " AND production_idx = '". $this->page_data['production_idx'] ."' " );            

            if( count( $query_result['row'] ) > 0  ) {
                $this->page_data = array_merge( $this->page_data, $query_result['row'] );
            } else {
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            }

            $unit_info_result = $this->model_product->getProductUnitInfo( " del_flag='N' AND product_idx = '". $this->page_data['product_idx'] ."' " );

            if( count( $unit_info_result['row'] ) > 0  ) {
                $this->page_data['product_units'] = json_encode( $unit_info_result['row'] );
            } 

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;        
        $this->page_data['contents_path'] = '/production/'. $page_name .'_write.php';
        
        
        $this->view( $this->page_data );
        
    }

    /**
     * 생산 지시 데이터 처리
     */
    public function production_proc() {
        
        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data );
        //  exit;

        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'food_code'                                        
                    ,'product_idx'                                        
                    ,'product_unit_idx'                                        
                    ,'timing'                                        
                    ,'schedule_date'                                        
                    ,'produce_no'                                        
                    ,'expiration_date'                                        
                    ,'schedule_quantity'
                ]);

              
                # 트랜잭션 시작
                $this->model->runTransaction();
                $this->model_material->runTransaction();

                $raw_material_info = $this->rawMaterialUseSchduleStocks();
                $sub_material_info = $this->subMaterialUseSchduleStocks(); 
                    
                // echoBr( $raw_material_info );
                // echoBr( $sub_material_info );
                // exit;
                

                # 지시 정보 입력
                $query_result = $this->model->insertProduction([
                    'company_idx' => COMPANY_CODE
                    ,'food_code' => $this->page_data['food_code']
                    ,'product_idx' => $this->page_data['product_idx']
                    ,'timing' => $this->page_data['timing']
                    ,'product_unit_idx' => $this->page_data['product_unit_idx']
                    ,'schedule_date' => $this->page_data['schedule_date']
                    ,'produce_no' => $this->page_data['produce_no']
                    ,'expiration_date' => $this->page_data['expiration_date']
                    ,'expiration_days' => $this->page_data['expiration_days']
                    ,'schedule_quantity' => $this->page_data['schedule_quantity']
                    ,'pouch_quantity' => $this->page_data['pouch_quantity']
                    ,'box_quantity' => $this->page_data['box_quantity']                    
                    ,'raw_material_info' => jsonReturn( $raw_material_info )
                    ,'sub_material_info' => jsonReturn( $sub_material_info )
                    ,'production_status' => 'S'
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ]);
                
                # 삽입 완료된 기본키를 가져온다.
                // $new_idx = $query_result['return_data']['insert_id'];
                
                
                if( ( count( $raw_material_info ) > 0  ) || ( count( $sub_material_info ) > 0 )  ) {
                    $this->model_material->stopTransaction();
                }
                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './'. $this->page_data['page_name'] .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'edit' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'production_idx'                                        
                    ,'food_code'                                        
                    ,'product_idx'                                        
                    ,'product_unit_idx'                                        
                    ,'timing'                                        
                    ,'schedule_date'                                        
                    ,'produce_no'                                        
                    ,'expiration_date'                                        
                    ,'schedule_quantity'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                $this->model_material->runTransaction();
                $result_del_raw = true;
                $result_del_sub = true;
                

                $update_data = [
                    'food_code' => $this->page_data['food_code']
                    ,'product_idx' => $this->page_data['product_idx']
                    ,'timing' => $this->page_data['timing']
                    ,'product_unit_idx' => $this->page_data['product_unit_idx']
                    ,'schedule_date' => $this->page_data['schedule_date']
                    ,'produce_no' => $this->page_data['produce_no']
                    ,'expiration_date' => $this->page_data['expiration_date']
                    ,'expiration_days' => $this->page_data['expiration_days']
                    ,'schedule_quantity' => $this->page_data['schedule_quantity']
                    ,'pouch_quantity' => $this->page_data['pouch_quantity']
                    ,'box_quantity' => $this->page_data['box_quantity']                                  
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ];

                $raw_material_info = $this->rawMaterialUseSchduleStocks();
                $sub_material_info = $this->subMaterialUseSchduleStocks(); 
                
                if( count( $raw_material_info ) > 0 ) {
                    # 기존 원자재 예약 정보 삭제 
                    $result_del_raw = $this->delMaterialUseSchduleStocks( $this->page_data['production_idx'], 'raw' );

                    $update_data['raw_material_info'] = jsonReturn( $raw_material_info );
                    
                }

                if( count( $sub_material_info ) > 0 ) {
                    # 기존 부자재 예약 정보 삭제 
                    $result_del_sub = $this->delMaterialUseSchduleStocks( $this->page_data['production_idx'], 'sub' );

                    $update_data['sub_material_info'] = jsonReturn( $sub_material_info );
                }

                
                # 생산지시 정보 수정
                $query_result = $this->model->updateProduction( $update_data ," production_idx = '" . $this->page_data['production_idx']. "'" );

                // echoBr( $raw_material_info );
                // echoBr( $sub_material_info );
                // echoBr( $update_data );
                // exit;

                if( ( $query_result['state'] == true ) && ( $result_del_raw == true ) && ( $result_del_sub == true ) ) {
                    # 트랜잭션 종료
                    $this->model->stopTransaction();
                    $this->model_material->stopTransaction();

                    movePage('replace', '저장되었습니다.', './'. $this->page_data['page_name'] .'_write?production_idx='. $this->page_data['production_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                } else {
                    errorBack('데이터 처리에 실패하였습니다.');
                }

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'production_idx'                    
                ]);
                
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                $this->model_material->runTransaction();

                $result_del = $this->delMaterialUseSchduleStocks( $this->page_data['production_idx'], 'all' );
                
                # 생산지시 삭제 수정
                $query_result = $this->model->updateProduction([
                    'del_flag' => 'Y'
                    ,'del_idx' => getAccountInfo()['idx']
                    ,'del_date' => 'NOW()'
                    ,'del_ip' => $this->getIP()
                ] ," production_idx = '" . $this->page_data['production_idx']. "'" );
                
                if( ( $query_result['state'] == true ) && ( $result_del == true ) ) {

                    # 트랜잭션 종료
                    $this->model->stopTransaction();                    
                    $this->model_material->stopTransaction();

                    movePage('replace', '저장되었습니다.', './'. $this->page_data['page_name'] .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                    
                } else {
                    errorBack('데이터 처리에 실패하였습니다.');
                }
                

                break;
            }
            case 'done' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'production_idx'                    
                ]);
                
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                $this->model_material->runTransaction();

                # 생산지시 정보 요청 
                $production_data = $this->model->getProductionOrder( " AND production_idx = '". $this->page_data['production_idx'] ."' " )['row'];    

                # 생산지시에 포함된 원부자재 사용업데이트 처리
                $result_mt_use = $this->updateMaterialUseSchduleStocks( $this->page_data['production_idx'] );
                
                # 생산지시 완료처리
                $query_result_update_production = $this->model->updateProduction([
                    'production_status' => 'D'
                ] ," production_idx = '" . $this->page_data['production_idx']. "'" );
                
                // echoBr( $production_data ); exit;
                
                # 생산 제품 재고등록
                $query_result_insert_product_stock = $this->model->insertProductStock([
                    'company_idx' => COMPANY_CODE
                    ,'production_idx' => $this->page_data['production_idx']
                    ,'product_idx' => $production_data['product_idx']                    
                    ,'product_unit_idx' => $production_data['product_unit_idx']
                    ,'product_name' => $production_data['product_name']
                    ,'product_unit' => $production_data['product_unit']
                    ,'product_unit_type' => $production_data['product_unit_type']
                    ,'packaging_unit_quantity' => $production_data['packaging_unit_quantity']
                    ,'product_quantity' => $production_data['pouch_quantity']                    
                    ,'memo' => '제조번호 [ ' . $production_data['produce_no'] . ' ] 로부터 생산됨. '
                    ,'task_type' => 'I'
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ]);

                if( ( $query_result_insert_product_stock['state'] == true ) && ( $query_result_update_production['state'] == true ) && ( $result_mt_use == true ) ) {

                    # 트랜잭션 종료
                    $this->model->stopTransaction();                    
                    $this->model_material->stopTransaction();

                    movePage('replace', '저장되었습니다.', './'. $this->page_data['page_name'] .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                    
                } else {
                    errorBack('데이터 처리에 실패하였습니다.');
                }
                

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    
    }

    /**
     * 생산 지시에 사용 선택된 원자재를 확인/사용처리 후 결과를 반환 한다.
     */
    public function rawMaterialUseSchduleStocks(){

        $use_material_info['raw_material_info'] = [];

        if( isset( $this->page_data['material_idx'] ) == true ) {
            # material_idx 반복하면서 자재 수량 체크
            foreach( $this->page_data['material_idx'] AS $idx=>$item ) {

                $use_material_info['raw_material_info']['material_idx'] = $this->page_data['material_idx'];
                $use_material_info['raw_material_info']['material_name'] = $this->page_data['material_name'];                
                $use_material_info['raw_material_info']['range_date'] = $this->page_data['range_date'];
                $use_material_info['raw_material_info']['receiving_dates'] = $this->page_data['receiving_dates'];
                $use_material_info['raw_material_info']['material_ratio'] = $this->page_data['material_ratio'];
                $use_material_info['raw_material_info']['quantity'] = $this->page_data['quantity'];
                
                // echoBr( $this->page_data['material_idx'][$idx] );

                $req_result = $this->model_material->getQuantityByReceivingDate( " AND ( material_kind='raw' ) AND ( material_idx ='" . $this->page_data['material_idx'][$idx] ."') " );

                if( $req_result['num_rows'] > 0 ) {
                    
                    $schedule_use_quantity_std = $this->page_data['quantity'][$idx];
                    // $schedule_use_quantity_std = 4800;

                    // echoBr( ' 총 사용 수량 : ' . $schedule_use_quantity_std );
                    // echoBr( 'start -- schedule_use_quantity : ' . $schedule_use_quantity );

                    foreach(  $req_result['rows'] AS $stock_idx=>$stock_item ) {

                        // echoBr( $stock_item['material_idx'] .' | '. $stock_item['receipt_date'] .' | '. $stock_item['stock_quantity'] );
                        // echoBr( $stock_item['receipt_date'] );
                        // echoBr( $stock_item['stock_quantity'] );
                        
                        # 사용 전체 값이 0보다 큰 경우
                        if( $schedule_use_quantity_std > 0 ) {
                            
                            # 현재 날짜의 재고 수량을 기준 값에서 뺀다.
                            $schedule_use_quantity_std = $schedule_use_quantity_std - $stock_item['stock_quantity'];
                            
                            # 기준 값이 0보다 작으면
                            if( $schedule_use_quantity_std < 0 ) {

                                # 기준 값이 0보다 작으면 현재 날짜의 재고 수가 많다는 것이기 때문에 - 된 값을 재고 수량에서 뺀다.

                                // echoBr( '사용 예약수 : ' . ( $stock_item['stock_quantity'] - ( $schedule_use_quantity_std * -1) )  );

                                $schedule_use_quantity = ( $stock_item['stock_quantity'] - ( $schedule_use_quantity_std * -1) );

                            } else {

                                # 아직 기준 값이 다 소진 되지 않았기 때문에 현재 날짜의 재고를 모두 사용 예약 처리 한다. 
                                // echoBr( '사용 예약수 : ' . $stock_item['stock_quantity'] );

                                $schedule_use_quantity = $stock_item['stock_quantity'];


                            }
                            
                            # 현재 입고날짜( receipt_date )와 자재 기본키( material_idx )로 주문 기록을 조회한다.

                            
                            // echoBr( '사용 예약 수량 : ' .$schedule_use_quantity );

                            $material_order_result = $this->model_material->getOrder(
                                " ( receipt_date='". $stock_item['receipt_date'] ."' ) AND ( material_idx = '". $stock_item['material_idx'] ."' ) "
                            );
                            
                            if( $material_order_result['num_rows'] > 0 ) {
                                
                                foreach(  $material_order_result['rows'] AS $orders_idx=>$orders_item ){
                                
                                    // echoBr( '남은 수 : ' . $schedule_use_quantity );
                                    
                                    if( $schedule_use_quantity == 0 ) {
                                        break;
                                    }

                                    $available_stocks_quantity = $this->model_material->getAvailableStocks( $orders_item['order_idx'] );
                                    
                                    if( $available_stocks_quantity > 0 ) {

                                        if( $available_stocks_quantity >= $schedule_use_quantity ) {
                                            // echoBr( '사용 예약 업데이트 : ' . $orders_item['order_idx'] . ' > ' . $schedule_use_quantity );
                                            
                                            $insert_data_quantity = $schedule_use_quantity;
                                            $schedule_use_quantity = $schedule_use_quantity - $schedule_use_quantity;
                                        } else {
                                            // echoBr( '남은 수량 사용 예약 업데이트 : ' . $orders_item['order_idx'] . ' > ' . $available_stocks_quantity );
                                            
                                            $insert_data_quantity = $available_stocks_quantity;

                                            # 남은 수량에서 예약 업데이트 한 만큼 제한다.
                                            $schedule_use_quantity = $schedule_use_quantity - $available_stocks_quantity;
                                            
                                        }

                                        $insert_data = [
                                            'company_idx' => COMPANY_CODE                    
                                            ,'order_idx' => $orders_item['order_idx']
                                            ,'materials_usage_idx' => $orders_item['materials_usage_idx']
                                            ,'material_idx' => $orders_item['material_idx']
                                            ,'material_kind' => $orders_item['material_kind']
                                            ,'material_name' => $orders_item['material_name']
                                            ,'product_name' => $orders_item['product_name']
                                            ,'material_unit' => $orders_item['material_unit']
                                            ,'standard_info' => $orders_item['standard_info']
                                            ,'country_of_origin' => $orders_item['country_of_origin']
                                            ,'material_unit_price' => $orders_item['material_unit_price']                    
                                            ,'order_date' => $orders_item['order_date']                    
                                            ,'receipt_date' => $orders_item['receipt_date']         
                                            ,'available_date_type' => $orders_item['available_date_type']                    
                                            ,'available_date' => $orders_item['available_date']                               
                                            ,'task_type' => 'S'
                                            ,'quantity' => $insert_data_quantity  
                                            ,'memo' => '생산지시 사용 예약'    
                                            ,'reg_idx' => getAccountInfo()['idx']
                                            ,'reg_date' => 'NOW()'
                                            ,'reg_ip' => $this->getIP()
                                        ];
                        
                            
                                        # 사용예약 정보 삽입
                                        $query_result = $this->model_material->insertStock( $insert_data );

                                        $use_material_info['raw_material_info']['receipt_date'][$idx][] = $orders_item['receipt_date'];
                                        $use_material_info['raw_material_info']['use_order_idxs'][$idx][] = $orders_item['order_idx'];
                                        $use_material_info['raw_material_info']['use_order_quantity'][$idx][] = $insert_data_quantity;
                                        $use_material_info['raw_material_info']['material_stock_idxs'][$idx][] = $query_result['return_data']['insert_id'];
                                    }

                                }
                            

                            } else {
                                errorBack('원자재 [' . $this->page_data['material_name'][$idx]. '] 의 수량 부족으로 진행이 불가능합니다.' );
                            }
                        }

                    }

                    // echoBr( 'end --- schedule_use_quantity : ' . $schedule_use_quantity );
                    
                    
                } else {
                    errorBack('원자재 [' . $this->page_data['material_name'][$idx]. '] 의 수량 부족으로 진행이 불가능합니다.' );
                }
            }
        } 

        return $use_material_info['raw_material_info'];

    }

    /**
     * 생산 지시에 사용 선택된 부자재를 확인/사용처리 후 결과를 반환 한다.
     */
    public function subMaterialUseSchduleStocks(){

        $use_material_info['sub_material_info'] = [];

        if( isset( $this->page_data['sub_material_idx'] ) == true ) {

            # sub_material_idx 반복하면서 자재 수량 체크
            foreach( $this->page_data['sub_material_idx'] AS $idx=>$item ) {

                $use_material_info['sub_material_info']['material_idx'] = $this->page_data['sub_material_idx'];
                $use_material_info['sub_material_info']['material_name'] = $this->page_data['sub_material_name'];
                $use_material_info['sub_material_info']['quantity'] = $this->page_data['sub_quantity'];
                
                // echoBr( $this->page_data['material_idx'][$idx] );

                $req_result = $this->model_material->getQuantityByReceivingDate( " AND ( material_kind='sub' ) AND ( material_idx ='" . $this->page_data['sub_material_idx'][$idx] ."') " );

                if( $req_result['num_rows'] > 0 ) {
                    
                    $schedule_use_quantity_std = $this->page_data['sub_quantity'][$idx];
                    // $schedule_use_quantity_std = 4800;

                    // echoBr( ' 부자재 총 사용 수량 : ' . $schedule_use_quantity_std );
                    // echoBr( 'start -- schedule_use_quantity : ' . $schedule_use_quantity );

                    foreach(  $req_result['rows'] AS $stock_idx=>$stock_item ){

                        echoBr( $stock_item['material_idx'] .' | '. $stock_item['receipt_date'] .' | '. $stock_item['stock_quantity'] );
                        // echoBr( $stock_item['receipt_date'] );
                        // echoBr( $stock_item['stock_quantity'] );
                        
                        # 사용 전체 값이 0보다 큰 경우
                        if( $schedule_use_quantity_std > 0 ) {
                            
                            # 현재 날짜의 재고 수량을 기준 값에서 뺀다.
                            $schedule_use_quantity_std = $schedule_use_quantity_std - $stock_item['stock_quantity'];
                            
                            # 기준 값이 0보다 작으면
                            if( $schedule_use_quantity_std < 0 ) {

                                # 기준 값이 0보다 작으면 현재 날짜의 재고 수가 많다는 것이기 때문에 - 된 값을 재고 수량에서 뺀다.

                                // echoBr( '사용 예약수 : ' . ( $stock_item['stock_quantity'] - ( $schedule_use_quantity_std * -1) )  );

                                $schedule_use_quantity = ( $stock_item['stock_quantity'] - ( $schedule_use_quantity_std * -1) );

                            } else {

                                # 아직 기준 값이 다 소진 되지 않았기 때문에 현재 날짜의 재고를 모두 사용 예약 처리 한다. 
                                // echoBr( '사용 예약수 : ' . $stock_item['stock_quantity'] );

                                $schedule_use_quantity = $stock_item['stock_quantity'];


                            }
                            
                            # 현재 입고날짜( receipt_date )와 자재 기본키( material_idx )로 주문 기록을 조회한다.

                            
                            // echoBr( '부자재 사용 예약 수량 : ' .$schedule_use_quantity );

                            $material_order_result = $this->model_material->getOrder(
                                " ( receipt_date='". $stock_item['receipt_date'] ."' ) AND ( material_idx = '". $stock_item['material_idx'] ."' ) "
                            );
                            
                            if( $material_order_result['num_rows'] > 0 ) {
                                
                                foreach(  $material_order_result['rows'] AS $orders_idx=>$orders_item ){
                                
                                    // echoBr( '남은 수 : ' . $schedule_use_quantity );
                                    if( $schedule_use_quantity == 0 ) {
                                        break;
                                    }

                                    $available_stocks_quantity = $this->model_material->getAvailableStocks( $orders_item['order_idx'] );
                                    
                                    if( $available_stocks_quantity > 0 ) {

                                        if( $available_stocks_quantity >= $schedule_use_quantity ) {
                                            // echoBr( '사용 예약 업데이트 : ' . $orders_item['order_idx'] . ' > ' . $schedule_use_quantity );
                                            
                                            $insert_data_quantity = $schedule_use_quantity;
                                            $schedule_use_quantity = $schedule_use_quantity - $schedule_use_quantity;
                                        } else {
                                            // echoBr( '남은 수량 사용 예약 업데이트 : ' . $orders_item['order_idx'] . ' > ' . $available_stocks_quantity );
                                            
                                            $insert_data_quantity = $available_stocks_quantity;

                                            # 남은 수량에서 예약 업데이트 한 만큼 제한다.
                                            $schedule_use_quantity = $schedule_use_quantity - $available_stocks_quantity;
                                            
                                        }

                                        $insert_data = [
                                            'company_idx' => COMPANY_CODE                    
                                            ,'order_idx' => $orders_item['order_idx']
                                            ,'materials_usage_idx' => $orders_item['materials_usage_idx']
                                            ,'material_idx' => $orders_item['material_idx']
                                            ,'material_kind' => $orders_item['material_kind']
                                            ,'material_name' => $orders_item['material_name']
                                            ,'product_name' => $orders_item['product_name']
                                            ,'material_unit' => $orders_item['material_unit']
                                            ,'standard_info' => $orders_item['standard_info']
                                            ,'country_of_origin' => $orders_item['country_of_origin']
                                            ,'material_unit_price' => $orders_item['material_unit_price']                    
                                            ,'order_date' => $orders_item['order_date']                    
                                            ,'receipt_date' => $orders_item['receipt_date']         
                                            ,'available_date_type' => $orders_item['available_date_type']                    
                                            ,'available_date' => $orders_item['available_date']                               
                                            ,'task_type' => 'S'
                                            ,'quantity' => $insert_data_quantity  
                                            ,'memo' => '생산지시 사용 예약'    
                                            ,'reg_idx' => getAccountInfo()['idx']
                                            ,'reg_date' => 'NOW()'
                                            ,'reg_ip' => $this->getIP()
                                        ];
                        
                            
                                        # 사용예약 정보 삽입
                                        $query_result = $this->model_material->insertStock( $insert_data );

                                        $use_material_info['sub_material_info']['receipt_date'][$idx][] = $orders_item['receipt_date'];
                                        $use_material_info['sub_material_info']['use_order_idxs'][$idx][] = $orders_item['order_idx'];
                                        $use_material_info['sub_material_info']['use_order_quantity'][$idx][] = $insert_data_quantity;                                        
                                        $use_material_info['sub_material_info']['material_stock_idxs'][$idx][] = $query_result['return_data']['insert_id'];
                                    }
                                }
                            

                            } else {
                                errorBack('부자재 [' . $this->page_data['sub_material_name'][$idx]. '] 의 수량 부족으로 진행이 불가능합니다.' );
                            }
                        }

                    }

                    // echoBr( 'end --- schedule_use_quantity : ' . $schedule_use_quantity );
                    
                    
                } else {
                    errorBack('부자재 [' . $this->page_data['sub_material_name'][$idx]. '] 의 수량 부족으로 진행이 불가능합니다.' );
                }            
            }
        }


        return $use_material_info['sub_material_info'];
    }

    /**
     * 생산 지시에 사용대기로 잡힌 재고 수량을 삭제처리 한다.
     */
    public function delMaterialUseSchduleStocks( $arg_production_idx, $arg_task_type ){   

        $result = false;

        if( empty( $arg_production_idx ) == true ) {
            exit( $this->errorResultForm( 'production->delMaterialUseSchduleStocks()', 'production_idx 키가 존재하지 않습니다.' ) );
        }

        # 생산지시 예정으로 잡혀있던 원부자재 삭제처리                
        $query_result = $this->model->getProductionOrder( " AND production_idx = '". $arg_production_idx ."' " );    
            // echoBr( $query_result['num_rows'] );
        if( $query_result['num_rows'] > 0 ) {
            
            $raw_material_info = json_decode( $query_result['row']['raw_material_info'], true );
            $sub_material_info = json_decode( $query_result['row']['sub_material_info'], true );
            
            // echoBr( $use_material_info );

            $raw_material_info = $raw_material_info['material_stock_idxs'];
            $sub_material_info = $sub_material_info['material_stock_idxs'];
            
            // echoBr( $raw_material_info);
            // echoBr( $sub_material_info);

            $material_order_idxs = '';

            switch( $arg_task_type ) {
                case 'all' : {

                    
                    foreach( $raw_material_info AS $idx=>$val ){

                        if( $material_order_idxs == '' ) {
                            
                            $material_order_idxs .= join( ',', $val );                    
                        } else {
                            
                            $material_order_idxs .= ',' . join( ',', $val );
                        }

                    }

                    foreach( $sub_material_info AS $idx=>$val ){
                        if( $material_order_idxs == '' ) {
                            $material_order_idxs .= join( ',', $val );                    
                        } else {
                            $material_order_idxs .= ',' . join( ',', $val );
                        }
                        
                    }
                    
                    break;
                }
                case 'raw' : {

                    foreach( $raw_material_info AS $idx=>$val ){

                        if( $material_order_idxs == '' ) {
                            
                            $material_order_idxs .= join( ',', $val );                    
                        } else {
                            
                            $material_order_idxs .= ',' . join( ',', $val );
                        }

                    }

                    break;
                }
                case 'sub' : {

                    foreach( $sub_material_info AS $idx=>$val ){
                        if( $material_order_idxs == '' ) {
                            $material_order_idxs .= join( ',', $val );                    
                        } else {
                            $material_order_idxs .= ',' . join( ',', $val );
                        }
                        
                    }

                    break;
                }
                default : {
                    exit( $this->errorResultForm( 'production->delMaterialUseSchduleStocks()',  '허용되지 않은 작업 유형 - ' . $arg_task_type ) );
                }
            }
            
            // $material_order_idxs = join( ',', $raw_material_info );
            // $material_order_idxs .= ',' . join( ',', $sub_material_info );
            

            // echoBr( $material_order_idxs ); exit;

            # 원부자재 사용예약 정보 삭제처리
            $query_result = $this->model_material->updateStock([
                'del_flag'=>'Y'
                ,'del_idx' => getAccountInfo()['idx']
                ,'del_date' => 'NOW()'
                ,'del_ip' => $this->getIP()
            ]," stock_idx IN (" . $material_order_idxs . ")" );

            $result = true;
        }

        return $result;
        
    }
    
    /**
     * 생산 지시에 사용대기로 잡힌 재고 수량을 사용처리 한다.
     */
    public function updateMaterialUseSchduleStocks( $arg_production_idx ){   

        $result = false;

        if( empty( $arg_production_idx ) == true ) {
            exit( $this->errorResultForm( 'production->updateMaterialUseSchduleStocks()', 'production_idx 키가 존재하지 않습니다.' ) );
        }

        # 생산지시 예정으로 잡혀있던 원부자재 데이터 요청
        $query_result = $this->model->getProductionOrder( " AND production_idx = '". $arg_production_idx ."' " );    
            // echoBr( $query_result['num_rows'] );
        if( $query_result['num_rows'] > 0 ) {
            
            $raw_material_info = json_decode( $query_result['row']['raw_material_info'], true );
            $sub_material_info = json_decode( $query_result['row']['sub_material_info'], true );
            
            if( count( $raw_material_info ) == 0 ) {
                errorBack('원자재 사용정보 없이 완료처리가 불가능합니다 \n원자재 사용정보를 입력해주세요.');
            }

            if( count( $sub_material_info ) == 0 ) {
                errorBack('부자재 사용정보 없이 완료처리가 불가능합니다 \n부자재 사용정보를 입력해주세요.');
            }

            // echoBr( $raw_material_info ); 
            // echoBr( $sub_material_info ); exit;

            $raw_material_info = $raw_material_info['material_stock_idxs'];
            $sub_material_info = $sub_material_info['material_stock_idxs'];
            
            // echoBr( $raw_material_info);
            // echoBr( $sub_material_info);

            $material_order_idxs = '';

            foreach( $raw_material_info AS $idx=>$val ){

                if( $material_order_idxs == '' ) {
                    
                    $material_order_idxs .= join( ',', $val );                    
                } else {
                    
                    $material_order_idxs .= ',' . join( ',', $val );
                }

            }

            foreach( $sub_material_info AS $idx=>$val ){
                if( $material_order_idxs == '' ) {
                    $material_order_idxs .= join( ',', $val );                    
                } else {
                    $material_order_idxs .= ',' . join( ',', $val );
                }
                
            }
            
            // $material_order_idxs = join( ',', $raw_material_info );
            // $material_order_idxs .= ',' . join( ',', $sub_material_info );
            

            // echoBr( '제조번호 [ ' . $arg_production_idx . ' ] 에 사용됨 '  ); exit;

            # 원부자재 사용예약 정보 사용처리            
            $query_material_result = $this->model_material->updateStock([
                'task_type'=>'U'
                ,'employ_production_idx'=>$arg_production_idx
                ,'memo' => '제조번호 [ ' . $query_result['row']['produce_no'] . ' ] 에 사용됨 '                
            ]," stock_idx IN (" . $material_order_idxs . ")" );

            $result = true;
        }

        return $result;
        
    }

    /**
     * 제품에 해당하는 단위 포장 정보를 json 형태로 반환한다.
     */
    public function get_expiration_date_json(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['product_expiration_date'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : product_expiration_date ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['std_date'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : std_date ';
			jsonExit( $result );				
        }

        $this->page_data['product_expiration_date'] = ( (int)$this->page_data['product_expiration_date'] ) + 1;
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=        

        $expiration_date = strtotime( $this->page_data['std_date'].'+'. $this->page_data['product_expiration_date'] . ' days');         

        $result['status'] = 'success';
        $result['msg'] = '';
        $result['expiration_date'] = date( 'Y-m-d', $expiration_date );
        jsonExit( $result );

       
        
    }

    
    /**
     * 신규 제조번호를 json 형태로 반환 한다.
     */
    public function get_new_produce_no_json(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['code'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : code ';
			jsonExit( $result );				
        }

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $new_produce_no_result = $this->makeNewCode( $this->page_data['code'], $this->model->getNewProduceNo( $this->page_data['code'] ), 2 ) ;
       
        $result['status'] = 'success';
        $result['msg'] = '';
        $result['new_no'] = $new_produce_no_result;
        jsonExit( $result );
        
    }

    /**
     * 생산이력관리 목록을 구성한다.
     */
    public function production_record_list() {
         #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data['production_status_arr'] = [
            'S'=>'예정'
            ,'I'=>'진행중'
            ,'D'=>'완료'
        ];
        $page_name = 'production_record';
        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' ) AND ( production_status='D' ) ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY production_idx DESC ';
        }

        if( $this->page_data['sch_production_status'] ) {
            $query_where .= " AND ( production_status = '".$this->page_data['sch_production_status']."' ) ";
        }
        

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( product_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( produce_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( member_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }


        if($this->page_data['sch_schedule_s_date']) {
            $query_where .= " AND ( schedule_date >= '".$this->page_data['sch_schedule_s_date']."' ) ";
        }

		if($this->page_data['sch_schedule_e_date']) {
            $query_where .= " AND ( schedule_date <= '".$this->page_data['sch_schedule_e_date']."' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getProductionOrders([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        if( $list_result['total_rs'] > 0 ) {
            $this->page_data['total_schedule_quantity'] = $list_result['rows'][0]['total_schedule_quantity'];
            $this->page_data['total_pouch_quantity'] = $list_result['rows'][0]['total_pouch_quantity'];
            $this->page_data['total_box_quantity'] = $list_result['rows'][0]['total_box_quantity'];
        } else {
            $this->page_data['total_schedule_quantity'] = 0;
            $this->page_data['total_pouch_quantity'] = 0;
            $this->page_data['total_box_quantity'] = 0;
        }

        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/production/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );
    }   

    /**
     * 생산이력관리 상세 화면을 구성한다.
     */
    public function production_record_view() {
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'production_record';

        # 식품 유형
        $this->page_data['food_types'] = $this->getConfig()['food_types'];
        $this->page_data['timing_text'] = [
            'am'=>'오전'
            ,'pm'=>'오후'
            ,'all'=>'종일'
        ];

        // $this->page_data['materials'] = $this->model_material->getMaterialStd(
        //     " company_idx='". COMPANY_CODE ."' AND material_kind='raw' AND use_flag='Y' AND del_flag='N' "
        // )['rows'];

        // $this->page_data['sub_materials'] = $this->model_material->getMaterialStd(
        //     " company_idx='". COMPANY_CODE ."' AND material_kind='sub' AND use_flag='Y' AND del_flag='N' "
        // )['rows'];

        // $this->page_data['use_material_info'] = '{}';

         #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
        $this->issetParams( $this->page_data, ['production_idx']);
        
        $this->page_data['page_work'] = '수정';
        $this->page_data['mode'] = 'edit';
        
        # 지시 정보
        $query_result = $this->model->getProductionOrder( " AND production_idx = '". $this->page_data['production_idx'] ."' " );            

        if( count( $query_result['row'] ) > 0  ) {
            $this->page_data = array_merge( $this->page_data, $query_result['row'] );
        } else {
            errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
        }

        $unit_info_result = $this->model_product->getProductUnitInfo( " del_flag='N' AND product_idx = '". $this->page_data['product_idx'] ."' " );

        if( count( $unit_info_result['row'] ) > 0  ) {
            $this->page_data['product_units'] = json_encode( $unit_info_result['row'] );
        } 

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;        
        $this->page_data['contents_path'] = '/production/'. $page_name .'_view.php';
        
        
        // echoBr(  $this->page_data); exit;

        $this->view( $this->page_data );
    }   
    

}

?>