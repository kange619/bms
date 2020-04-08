<?php

class product extends baseController {

    private $model;
    private $model_material;
    private $paging;
    private $page_name;    

    function __construct() {
        
        #로그인 확인
        loginState();
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('productModel');         
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
            , 'sch_order_field'
            , 'sch_order_status'
        ]);

        $this->page_name = 'product';

    }

    /**
     * 제품 목록을 생성한다.
     */
    public function product_list(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data['food_types'] = $this->getConfig()['food_types'];

        $query_where = " AND del_flag='N' AND company_idx = '". COMPANY_CODE ."' ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY product_idx DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( product_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( item_report_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getProducts([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $this->page_name;
        $this->page_data['contents_path'] = '/product/'. $this->page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }

    public function product_write() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data['product_units'] = json_encode([]); # 제품 단위 빈 값
        $this->page_data['food_types'] = $this->getConfig()['food_types'];

        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
            $this->issetParams( $this->page_data, ['product_idx']);
            
            $this->page_data['page_work'] = '수정';
            
            # 제품 정보
            $query_result = $this->model->getProduct( " product_idx = '". $this->page_data['product_idx'] ."' " );            

            if( count( $query_result['row'] ) > 0  ) {
                $this->page_data = array_merge( $this->page_data, $query_result['row'] );
            } else {
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            }

            $unit_info_result = $this->model->getProductUnitInfo( " del_flag='N' AND product_idx = '". $this->page_data['product_idx'] ."' " );

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
        $this->page_data['page_name'] = $this->page_name;        
        $this->page_data['contents_path'] = '/product/'. $this->page_name .'_write.php';
        
        
        $this->view( $this->page_data );
        
    }

    /**
     * 기업정보 데이터를 처리한다.
     */
    public function product_proc(){

        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data );

        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'product_name'
                    ,'item_report_no'
                    ,'product_expiration_date'
                ]);
    
                if( empty( $this->page_data['product_registration_no'] ) == true ) {
                    # 신규 코드 생성
                    $this->page_data['product_registration_no'] = $this->makeNewCode( PRODUCT_CODE, $this->model->createProductCode( PRODUCT_CODE ), 3 );
                } 

                # 트랜잭션 시작
                $this->model->runTransaction();
                
                $insert_data = [
                    'product_name' => $this->page_data['product_name']
                    ,'company_idx' => COMPANY_CODE
                    ,'food_code' => $this->page_data['food_code']
                    ,'item_report_no' => $this->page_data['item_report_no']
                    ,'product_registration_no' => $this->page_data['product_registration_no']
                    ,'product_expiration_date' => $this->page_data['product_expiration_date']
                    ,'storage_method' => $this->page_data['storage_method']
                    ,'product_packing_method' => $this->page_data['product_packing_method']
                    ,'haccp_certify' => $this->page_data['haccp_certify']                    
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ];

                if( empty( $this->page_data['haccp_certify_start_date'] ) == false ) {
                    $insert_data['haccp_certify_start_date'] = $this->page_data['haccp_certify_start_date'];
                }

                if( empty( $this->page_data['haccp_certify_end_date'] ) == false ) {
                    $insert_data['haccp_certify_end_date'] = $this->page_data['haccp_certify_end_date'];
                }

                # 기업 정보 삽입
                $query_result = $this->model->insertProduct( $insert_data );
                
                # 삽입 완료된 기본키를 가져온다.
                $new_product_idx = $query_result['return_data']['insert_id'];
  
                # 제품 단위 정보처리
                $this->productUnitInfoProc( $new_product_idx );
                

                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './'. $this->page_name .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'edit' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'product_idx'
                    ,'product_name'
                    ,'item_report_no'
                    ,'product_expiration_date'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                $update_data = [
                    'product_name' => $this->page_data['product_name']                    
                    ,'item_report_no' => $this->page_data['item_report_no']                    
                    ,'product_expiration_date' => $this->page_data['product_expiration_date']
                    ,'storage_method' => $this->page_data['storage_method']
                    ,'product_packing_method' => $this->page_data['product_packing_method']
                    ,'haccp_certify' => $this->page_data['haccp_certify']                   
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ];

                if( empty( $this->page_data['haccp_certify_start_date'] ) == false ) {
                    $update_data['haccp_certify_start_date'] = $this->page_data['haccp_certify_start_date'];
                }

                if( empty( $this->page_data['haccp_certify_end_date'] ) == false ) {
                    $update_data['haccp_certify_end_date'] = $this->page_data['haccp_certify_end_date'];
                }

                # 기업 정보 수정
                $query_result = $this->model->updateProduct( $update_data," product_idx = '" . $this->page_data['product_idx'] . "'" );
                      
               
               # 제품 단위 정보처리
               $this->productUnitInfoProc( $this->page_data['product_idx'] );

                # 트랜잭션 종료
                $this->model->stopTransaction();


                movePage('replace', '저장되었습니다.', './'. $this->page_name .'_write?product_idx='. $this->page_data['product_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'product_idx'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 수정
                $query_result = $this->model->updateProduct(['del_flag'=>'Y']," product_idx = '" . $this->page_data['product_idx'] . "'" );
                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '삭제되었습니다.', './'. $this->page_name .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    }

    /**
     * 식품유형 정보를 처리한다.
     */
    private function productUnitInfoProc( $arg_product_idx ){

        // echoBr( $this->page_data['product_unit_idx'] ); 
        // echoBr( $this->page_data['product_unit'] ); 
        // echoBr( $this->page_data['product_unit_type'] ); exit;
        if( gettype( $this->page_data['product_unit_idx'] ) == 'array' ) {
            
            foreach( $this->page_data['product_unit_idx'] AS $idx=>$val){

                if( $val == '' ){

                    # 삽입
                    $query_result = $this->model->insertProductUnit([
                        'company_idx' => COMPANY_CODE
                        ,'product_idx' => $arg_product_idx
                        ,'product_unit' => $this->page_data['product_unit'][$idx]
                        ,'product_unit_type' => $this->page_data['product_unit_type'][$idx]
                        ,'packaging_unit_quantity' => $this->page_data['packaging_unit_quantity'][$idx]
                        ,'product_unit_name' => $this->page_data['product_unit_name'][$idx]
                        ,'use_flag' => $this->page_data['use_flag'][$idx]
                        ,'reg_idx' => getAccountInfo()['idx']
                        ,'reg_date' => 'NOW()'
                        ,'reg_ip' => $this->getIP()
                    ]);

                } else {
                    # 업데이트
                    $query_result = $this->model->updateProductUnit([
                        'product_unit' => $this->page_data['product_unit'][$idx]
                        ,'product_unit_type' => $this->page_data['product_unit_type'][$idx]
                        ,'packaging_unit_quantity' => $this->page_data['packaging_unit_quantity'][$idx]
                        ,'product_unit_name' => $this->page_data['product_unit_name'][$idx]
                        ,'use_flag' => $this->page_data['use_flag'][$idx]
                        ,'edit_idx' => getAccountInfo()['idx']
                        ,'edit_date' => 'NOW()'
                        ,'edit_ip' => $this->getIP()
                    ]," product_unit_idx = '" . $this->page_data['product_unit_idx'][$idx] . "'" );
                }
            }
        }

        if( empty( $this->page_data['product_unit_del_idx'] ) == false ){

            # company_idx 에 해당하는 기존 데이터 삭제처리
            $this->model->updateProductUnit([
                'del_flag' => 'Y'
                ,'del_idx' => getAccountInfo()['idx']
                ,'del_date' => 'NOW()'
                ,'del_ip' => $this->getIP()
            ], " product_unit_idx  IN (" . $this->page_data['product_unit_del_idx']. ") "  );
            
        }


        // exit;

    }

    /**
     * 배합비율 목록 생성
     */
    public function mixing_ratios(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'mixing_ratios';
        $this->page_data['food_types'] = $this->getConfig()['food_types'];

        $query_where = " AND del_flag='N' AND company_idx = '". COMPANY_CODE ."' ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];


        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY product_idx DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( product_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( product_registration_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getProducts([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/product/'. $page_name .'.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }

    /**
     * 비율정보 등록 화면 생성
     */
    public function mixing_ratios_edit() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'mixing_ratios';
        $this->page_data['mixing_ratio'] = json_encode([]); # 제품 단위 빈 값
        $this->page_data['food_types'] = $this->getConfig()['food_types'];
        
        $this->page_data['materials'] = $this->model_material->getMaterialStd(
            " company_idx='". COMPANY_CODE ."' AND material_kind='raw' AND use_flag='Y' AND del_flag='N' "
        )['rows'];

        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
            $this->issetParams( $this->page_data, ['product_idx']);
            
            $this->page_data['page_work'] = '수정';
            
            # 제품 정보
            $query_result = $this->model->getProduct( " product_idx = '". $this->page_data['product_idx'] ."' " );            

            if( count( $query_result['row'] ) > 0  ) {
                $this->page_data = array_merge( $this->page_data, $query_result['row'] );

                
            } else {
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            }

            $mixing_ratio_result = $this->model->getMixingRatio( " del_flag='N' AND product_idx = '". $this->page_data['product_idx'] ."' " );

            if( count( $mixing_ratio_result['row'] ) > 0  ) {
                $this->page_data['mixing_ratio'] = json_encode( $mixing_ratio_result['row'] );
            } 

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;        
        $this->page_data['contents_path'] = '/product/'. $page_name .'_edit.php';
        
        
        $this->view( $this->page_data );
        
    }

    public function mixing_ratios_proc(){
        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data ); exit;
       
        $page_name = 'mixing_ratios';


        switch( $this->page_data['mode'] ){

            case 'edit' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'product_idx'
                ]);
                
                $this->mixingRatioProc( 
                    $this->page_data['product_idx']
                    , $this->page_data['material_idx'] 
                    , $this->page_data['material_ratio'] 
                    , $this->page_data['material_code'] 
                    , $this->page_data['material_name'] 
                    , $this->page_data['material_company_name'] 
                );

                movePage('replace', '저장되었습니다.', './'. $page_name .'_edit?product_idx='. $this->page_data['product_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                
                break;
            }
            case 'del' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'product_idx'
                ]);

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
        
        

    }

    /**
     * 식품유형 정보를 처리한다.
     */
    private function mixingRatioProc(  
        $arg_product_idx
        , $material_idx
        , $arg_material_ratio
        , $arg_material_code
        , $arg_material_name        
        , $arg_material_company_name
    ){
        # company_idx 에 해당하는 기존 데이터 삭제처리
        $this->model->updateMixingRatio([
            'del_flag' => 'Y'
        ], " product_idx  = '" . $arg_product_idx. "'"  );

        # 신규 insert 처리
        return $this->model->insertMixingRatio(  
            $arg_product_idx
            , $material_idx
            , $arg_material_ratio
            , $arg_material_code
            , $arg_material_name        
            , $arg_material_company_name 
            , COMPANY_CODE 
        );

    }


    /**
     * 제품 목록을 json 형태로 반환한다.
     */
    public function product_list_json(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['food_code'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : food_code ';
			jsonExit( $result );				
        }

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        

        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' ) AND ( food_code = '".$this->page_data['food_code']."' ) ";        
        $limit = " LIMIT 100";
        $query_sort = ' ORDER BY product_name ASC ';       
        
        # 리스트 정보요청
        $list_result = $this->model->getProducts([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        $result['status'] = 'success';
        $result['msg'] = '';
        $result['list'] = $list_result['rows'];
        jsonExit( $result );
        
    }

    /**
     * 제품에 해당하는 단위 포장 정보를 json 형태로 반환한다.
     */
    public function get_poduct_unit_info_json(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['product_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : product_idx ';
			jsonExit( $result );				
        }

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $unit_info_result = $this->model->getProductUnitInfo( " ( del_flag='N') AND ( use_flag='Y' ) AND ( product_idx = '". $this->page_data['product_idx'] ."' ) " );
        
        if( count( $unit_info_result['row'] ) > 0  ) {
            $result['product_units'] = $unit_info_result['rows'];
        } else {
            
            $result['product_units'] = [];
        }

        $result['status'] = 'success';
        $result['msg'] = '';
        jsonExit( $result );
        
    }

    /**
     * 제품에 해당하는 배합비율 정보를 json 형태로 반환한다.
     */
    public function get_poduct_mixingratio_json(){        

        
        $return_data = [];
        // $this->page_data['product_idx'] = '100000006';
        // $this->page_data['quantity'] = 2000;

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['product_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : product_idx ';
			jsonExit( $result );				
        }

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $mixing_ratio_result = $this->model->getMixingRatio( " del_flag='N' AND product_idx = '". $this->page_data['product_idx'] ."' " );
        
        if( count( $mixing_ratio_result['rows'] ) > 0  ) {
            
            foreach( $mixing_ratio_result['rows'] AS $idx=>$item ) {
                
                // echoBr( $item );

                $return_data[$idx]['mixing_idx'] = $item['mixing_idx'];
                $return_data[$idx]['material_ratio'] = $item['material_ratio'];
                $return_data[$idx]['product_idx'] = $item['product_idx'];
                $return_data[$idx]['company_idx'] = $item['company_idx'];
                $return_data[$idx]['material_idx'] = $item['material_idx'];
                $return_data[$idx]['material_name'] = $item['material_name'];
                
                if( empty( $this->page_data['quantity'] ) == false ) {
                    $return_data[$idx]['ratio_quantity'] = $this->page_data['quantity'] / 100 * $item['material_ratio'];
                }

                $req_result = $this->model_material->getQuantityByReceivingDate( " AND ( material_kind='raw' ) AND ( material_idx ='" . $item['material_idx'] ."') " );

                $range_date = '';
                $range_date_sum = 0;

                if( $req_result['num_rows'] > 0 ) {
                    
                    $return_data[$idx]['receiving_dates'] = $req_result['rows'];
                    

                    if( empty( $this->page_data['quantity'] ) == false ) {
                                                
                        foreach( $req_result['rows'] AS $deceiving_date_idx=>$deceiving_date_item ) {

                            if( $return_data[$idx]['ratio_quantity'] > $range_date_sum ) {
                                
                                if( $deceiving_date_idx == 0 ) {
                                    // $return_data[$idx]['range_date'] .=  $deceiving_date_item['receipt_date'] . '(' . $deceiving_date_item['total_quantity'] . ')';    
                                    $return_data[$idx]['range_date'] .=  $deceiving_date_item['receipt_date'];
                                } else {                                    
                                    // $return_data[$idx]['range_date'] .=  ','. $deceiving_date_item['receipt_date']. '(' . $deceiving_date_item['total_quantity'] . ')';    
                                    $return_data[$idx]['range_date'] .=  ','. $deceiving_date_item['receipt_date'];
                                }

                                $return_data[$idx]['range_date_arr'][] = $deceiving_date_item['receipt_date'] . '(' . $deceiving_date_item['stock_quantity'] . ')';    
                                
                                
                                $range_date_sum += $deceiving_date_item['stock_quantity'];

                            }
                            
                        }

                        $return_data[$idx]['total_stock_quantity'] = $range_date_sum;
                    
                    }

                }
                
            }

            // echoBr( $return_data ); 
            
            $result['mixing_ratio'] = $return_data;


        } else {
            
            $result['mixing_ratio'] = [];
        }

        $result['status'] = 'success';
        $result['msg'] = '';
        jsonExit( $result );
        
    }

    /**
     * 자재 월별 재고 수량을 json 형태로 반환 한다.
     */
    public function get_material_quantity_by_receiving_date_json(){
        
        $return_data = [];
       
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['material_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : material_idx ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['material_kind'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : material_kind ';
			jsonExit( $result );				
        }

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $req_result = $this->model_material->getQuantityByReceivingDate( " AND ( material_kind='". $this->page_data['material_kind'] ."' ) AND ( material_idx ='" . $this->page_data['material_idx'] ."') " );

        $result['receiving_dates'] = [];
        if( $req_result['num_rows'] > 0 ) {
            
            $result['receiving_dates'] = $req_result['rows'];
            // $return_data[$idx]['range_date'] = '';
            // $return_data[$idx]['range_date_arr'] = [];
            // $result['receiving_dates'] = $return_data;
        }
     

        $result['status'] = 'success';
        $result['msg'] = '';
        
        jsonExit( $result );
        
    }

    /**
     * 제품 재고 값 json 반환
     */
    public function get_stocks_json(){
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['stock_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : stock_idx ';
			jsonExit( $result );				
        }

        $list_result = $this->model->getAvailableStocks( $this->page_data['stock_idx'] );

        $result['status'] = 'success';
        $result['msg'] = '';
        $result['stock_quantity'] = number_format( $list_result );
        jsonExit( $result );
        
    }

    /**
     * 제품 작업처리 json 반환
     */
    public function task_stocks_json(){
       
        $result = [];
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['stock_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : stock_idx ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['task_type'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : task_type ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['use_quantity'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : use_quantity ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['memo'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : memo ';
			jsonExit( $result );				
        }

        $stock_quantity = $this->model->getAvailableStocks( $this->page_data['stock_idx'] );

        if( $stock_quantity >= $this->page_data['use_quantity'] ) {
            # 정상 작업처리

            #주문정보
            $query_result = $this->model->getProductStock(" AND stock_idx = '". $this->page_data['stock_idx'] ."' " );    
            
            if( $query_result['num_rows'] > 0 ) {

                $stock_info = $query_result['row'];
                
                # 생산 제품 재고등록
                $query_result = $this->model->insertStock([
                    'company_idx' => COMPANY_CODE
                    ,'production_idx' => $stock_info['production_idx']
                    ,'product_idx' => $stock_info['product_idx']                    
                    ,'product_unit_idx' => $stock_info['product_unit_idx']
                    ,'product_name' => $stock_info['product_name']
                    ,'product_unit' => $stock_info['product_unit']
                    ,'product_unit_type' => $stock_info['product_unit_type']
                    ,'packaging_unit_quantity' => $stock_info['packaging_unit_quantity']
                    ,'product_quantity' => $this->page_data['use_quantity']     
                    ,'memo' => $this->page_data['memo']
                    ,'task_type' => $this->page_data['task_type']
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ]);

                $result['status'] = 'success';
                $result['msg'] = '처리되었습니다.';
                jsonExit( $result );
                
            } else {

                $result['status'] = 'fail';
                $result['msg'] = '입고 정보가 존재 하지 않습니다.';
                jsonExit( $result );
                
            }

        } else {
            # 남은 수량이 입력된 값보다 작은 경우
            $result['status'] = 'fail';
			$result['msg'] = '남은 수량이 입력된 사용값보다 적어 작업이 불가능합니다.';
			jsonExit( $result );
        }

        
        
    }



}

?>