<?php

class materials extends baseController {

    private $model;
    private $paging;
    private $page_name;    
    private $file_manager;    

    function __construct() {
        
        #로그인 확인
        loginState();
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('materialsModel');         
        $this->file_manager = $this->new('fileUploadHandler');         
       
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
            , 'sch_process_state'
            , 'sch_use_flag'
            , 'sch_material_kind'
            , 'sch_material_std'
            , 'sch_task_type'
        ]);

        $this->page_name = 'product';

    }

    /**
     * 협력업체 목록을 생성한다.
     */
    public function company_list(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'company';
        $this->page_data['food_types'] = $this->getConfig()['food_types'];

        $query_where = " AND ( del_flag = 'N' ) AND ( company_idx = '". COMPANY_CODE ."' ) ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY material_company_idx DESC ';
        }


        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( company_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( registration_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( ceo_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( manager_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getCompanys([            
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
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }

    /**
     * 기업정보 작성 페이지를 구성한다.
     */
    public function company_write(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'company';
        $this->page_data['materials'] = json_encode([]); # 제품 단위 빈 값
        $this->page_data['added_food_types'] = [];
        $this->page_data['company_members'] = [];
        $this->page_data['material_specification_info'] = [];
        $this->page_data['material_specification_log'] = [];

        $this->page_data['raw_materials'] = $this->model->getMaterialStd(
            " company_idx='". COMPANY_CODE ."' AND material_kind='raw' AND use_flag='Y' AND del_flag='N' "
        )['rows'];

        $this->page_data['sub_materials'] = $this->model->getMaterialStd(
            " company_idx='". COMPANY_CODE ."' AND material_kind='sub' AND use_flag='Y' AND del_flag='N' "
        )['rows'];

        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
            $this->issetParams( $this->page_data, ['material_company_idx']);
            
            $this->page_data['page_work'] = '수정';

            # 기업정보를 요청한다.
            $query_result = $this->model->getCompany( " material_company_idx = '". $this->page_data['material_company_idx'] ."' " );

            if( $query_result['num_rows'] == 0 ){
                
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
                
            }

            $this->page_data = array_merge( $this->page_data, $query_result['row'] );

            if( $query_result['num_rows'] > 0 ){
                
                $this->page_data = array_merge( $this->page_data, $query_result['row'] );
                
            }

            # 업체의 납품 제품 내역을 요청한다.
            $query_result = $this->model->getMaterials(" as_material.material_company_idx = '". $this->page_data['material_company_idx'] ."' " );    
            
            if( $query_result['num_rows'] > 0 ){
                $this->page_data['materials'] = json_encode( $query_result['rows'] );;
            }

            # 사용 파일 정보            
            $file_result = $this->file_manager->dbGetFile("
                tb_key = '". $this->page_data['material_company_idx'] ."'
                AND where_used = 'material_specification'
                AND tb_name = 't_materials_usage'
            ");

            $this->page_data['material_specification_info'] = jsonReturn( $file_result['rows'] );

            # 사용하지 않는 파일정보
            $file_result = $this->file_manager->dbGetFile("
                tb_key = '". $this->page_data['material_company_idx'] ."'
                AND where_used = 'material_specification'
                AND tb_name = 't_materials_usage'
                AND del_flag = 'Y'
            ");

            $this->page_data['material_specification_log'] = $file_result['rows'];



        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'company';
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }

    /**
     * 기업정보 데이터를 처리한다.
     */
    public function company_proc(){

        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data );

        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'company_name'                                        
                ]);
                
                if( empty( $this->page_data['registration_no'] ) == false ) {
                    
                    # 기업 사업자등록 번호와 일치한 정보 확인
                    $query_result = $this->model->getCompany( " registration_no = '". $this->page_data['registration_no'] ."' AND company_idx = '". COMPANY_CODE ."'" );

                    if( $query_result['num_rows'] > 0 ){
                        
                        errorBack('이미 등록된 업체 입니다.');
                        
                    }    

                }
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 삽입
                $query_result = $this->model->insertCompany([
                    'company_idx' => COMPANY_CODE
                    ,'company_name' => $this->page_data['company_name']
                    ,'registration_no' => $this->page_data['registration_no']
                    ,'ceo_name' => $this->page_data['ceo_name']
                    ,'company_tel' => $this->page_data['company_tel']
                    ,'company_fax' => $this->page_data['company_fax']
                    ,'company_homepage' => $this->page_data['company_homepage']
                    ,'zip_code' => $this->page_data['zip_code']
                    ,'addr' => $this->page_data['addr']
                    ,'addr_detail' => $this->page_data['addr_detail']
                    ,'manager_name' => $this->page_data['manager_name']
                    ,'manager_phone_no' => $this->page_data['manager_phone_no']
                    ,'manager_email' => $this->page_data['manager_email']
                    ,'use_flag' => $this->page_data['use_flag']
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ]);
                
                # 기업정보 삽입 완료된 기본키를 가져온다.
                $new_company_idx = $query_result['return_data']['insert_id'];
                
                
                
                # 납품 자재 정보 처리
                $this->materialProc( $new_company_idx);

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS_SPECIFICATION;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials_usage'                        
                        ,'where_used' => 'material_specification'
                        ,'tb_key' => $new_company_idx
                    ]
                ];
                $this->file_manager->set_file_title = $this->page_data['file_title'];
                $this->file_manager->fileUpload();
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
               
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './company_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'edit' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'material_company_idx'                    
                    ,'company_name'                    
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 삽입
                $query_result = $this->model->updateCompany([
                    'company_name' => $this->page_data['company_name']
                    ,'registration_no' => $this->page_data['registration_no']
                    ,'ceo_name' => $this->page_data['ceo_name']
                    ,'company_tel' => $this->page_data['company_tel']
                    ,'company_fax' => $this->page_data['company_fax']
                    ,'company_homepage' => $this->page_data['company_homepage']
                    ,'zip_code' => $this->page_data['zip_code']
                    ,'addr' => $this->page_data['addr']
                    ,'addr_detail' => $this->page_data['addr_detail']
                    ,'manager_name' => $this->page_data['manager_name']
                    ,'manager_phone_no' => $this->page_data['manager_phone_no']
                    ,'manager_email' => $this->page_data['manager_email']
                    ,'use_flag' => $this->page_data['use_flag']
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ] ," material_company_idx = '" . $this->page_data['material_company_idx']. "'" );


                # 납품 자재 정보 처리
                $this->materialProc( $this->page_data['material_company_idx'] );
                

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS_SPECIFICATION;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials_usage'                        
                        ,'where_used' => 'material_specification'
                        ,'tb_key' => $this->page_data['material_company_idx']
                    ]
                ];
                $this->file_manager->set_file_title = $this->page_data['file_title'];
                $this->file_manager->fileUpload();

                if( $this->page_data['del_file_idx'] ){
                    $this->file_manager->dbDeleteHandler( " idx IN ( ". $this->page_data['del_file_idx'] ." ) " );
                }
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  


                # 트랜잭션 종료
               $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './company_write?material_company_idx='. $this->page_data['material_company_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'material_company_idx'                    
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 수정
                $query_result = $this->model->updateCompany([
                    'del_flag' => 'Y'
                ] ," material_company_idx = '" . $this->page_data['material_company_idx']. "'" );

                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '삭제되었습니다.', './company_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    }

    /**
     * 납품 자재 정보 데이터 처리
     */
    private function materialProc( $arg_material_company_idx ){

        if( gettype( $this->page_data['materials_usage_idx'] ) == 'array' ) {

            foreach( $this->page_data['materials_usage_idx'] AS $idx=>$val){

                if( $val == '' ){

                    $query_result = $this->model->insertMaterial([
                        'material_company_idx' => $arg_material_company_idx
                        ,'company_idx' => COMPANY_CODE
                        ,'material_idx' => $this->page_data['material_idx'][$idx]
                        ,'material_kind' => $this->page_data['material_kind'][$idx]
                        ,'material_name' => $this->page_data['material_name'][$idx]
                        ,'product_name' => $this->page_data['product_name'][$idx]
                        ,'standard_info' => $this->page_data['standard_info'][$idx]
                        ,'material_unit' => $this->page_data['material_unit'][$idx]
                        ,'country_of_origin' => $this->page_data['country_of_origin'][$idx]
                        ,'material_unit_price' => $this->page_data['material_unit_price'][$idx]
                        ,'reg_idx' => getAccountInfo()['idx']
                        ,'reg_ip' => $this->getIP()
                        ,'reg_date' => 'NOW()'
                    ]);

                } else {

                    # 업데이트
                    $query_result = $this->model->updateMaterial([
                        'material_idx' => $this->page_data['material_idx'][$idx]
                        ,'material_kind' => $this->page_data['material_kind'][$idx]
                        ,'material_name' => $this->page_data['material_name'][$idx]
                        ,'product_name' => $this->page_data['product_name'][$idx]
                        ,'standard_info' => $this->page_data['standard_info'][$idx]
                        ,'material_unit' => $this->page_data['material_unit'][$idx]
                        ,'country_of_origin' => $this->page_data['country_of_origin'][$idx]
                        ,'material_unit_price' => $this->page_data['material_unit_price'][$idx]
                        ,'edit_idx' => getAccountInfo()['idx']
                        ,'edit_date' => 'NOW()'
                        ,'edit_ip' => $this->getIP()
                    ]," materials_usage_idx = '" . $this->page_data['materials_usage_idx'][$idx] . "'" );

                }

            }
        }

        if( empty( $this->page_data['materials_usage_del_idx'] ) == false ){

            # company_idx 에 해당하는 기존 데이터 삭제처리
            $this->model->updateMaterial([
                'del_flag' => 'Y'
                ,'del_idx' => getAccountInfo()['idx']
                ,'del_date' => 'NOW()'
                ,'del_ip' => $this->getIP()
            ], " materials_usage_idx  IN (" . $this->page_data['materials_usage_del_idx']. ") "  );
            
        }
        

    }

    /**
     * 자재 주문 목록 화면 구성
     */
    public function order_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'order';
        $this->page_data['process_state_arr'] = [
            'O' => '주문'
            ,'W' => '입고'
            ,'C' => '취소'
        ];

        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' ) ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {            
            $query_sort = ' ORDER BY order_idx DESC, order_date DESC, receipt_date DESC ';
        }


        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( company_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( order_idx LIKE '%". $this->page_data['sch_keyword'] ."%' )                                     
                                    OR ( material_name LIKE '%". $this->page_data['sch_keyword'] ."%' )                                     
                                    OR ( manager_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        
        
        if($this->page_data['sch_process_state']) {
            $query_where .= " AND ( process_state = '".$this->page_data['sch_process_state']."' ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( order_date >= '".$this->page_data['sch_s_date']."' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( order_date <= '".$this->page_data['sch_e_date']."' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getOrders([            
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
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    } 

     
    /**
     * 주문 작성 페이지를 구성한다.
     */
    public function order_write(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'order';
        $this->page_data['materials'] = [];

        # 업체의 납품 제품 내역을 요청한다.
        $query_result = $this->model->getMaterials(" as_material.company_idx = '". COMPANY_CODE ."' AND ( as_company.use_flag='Y' ) ORDER BY material_kind ASC" );    
            
        if( $query_result['num_rows'] > 0 ){
            $this->page_data['materials'] = json_encode( $query_result['rows'] );;
        }
       
        $this->page_data['mode'] = 'ins';
        $this->page_data['page_work'] = '등록';


        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }
    
    /**
     * 주문 수정 페이지를 구성한다.
     */
    public function order_edit(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
        $this->issetParams( $this->page_data, [
            'order_idx' 
        ]);
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'order';

        # 주문 내역을 요청한다.
        $query_result = $this->model->getOrder(" order_idx = '". $this->page_data['order_idx'] ."' " );    
            
        if( $query_result['num_rows'] == 0 ){
                
            errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            
        }

        $this->page_data = array_merge( $this->page_data, $query_result['row'] );
       
        $this->page_data['mode'] = 'edit';
        $this->page_data['page_work'] = '수정';


        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_edit.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }

    
    /**
     * 주문정보 데이터를 처리한다.
     */
    public function order_proc(){

        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data ); exit;

        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_date'                                        
                    ,'material_name'                                        
                    ,'quantity'                                        
                ]);
               
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                
                foreach( $this->page_data['quantity'] AS $idx=>$val ){
                    
                    if( $idx == 0 ) {

                        $order_no = '';

                    } else {

                        $order_no = $get_insert_id;

                    }

                    $insert_data = [
                        'company_idx' => COMPANY_CODE
                        ,'order_group_no' => $order_no
                        ,'materials_usage_idx' => $this->page_data['materials_usage_idx'][ $idx ]
                        ,'material_idx' => $this->page_data['material_idx'][ $idx ]
                        ,'material_kind' => $this->page_data['material_kind'][ $idx ]
                        ,'material_name' => $this->page_data['material_name'][ $idx ]
                        ,'product_name' => $this->page_data['product_name'][ $idx ]
                        ,'material_unit' => $this->page_data['material_unit'][ $idx ]
                        ,'standard_info' => $this->page_data['standard_info'][ $idx ]
                        ,'country_of_origin' => $this->page_data['country_of_origin'][ $idx ]                        
                        ,'material_unit_price' => $this->page_data['material_unit_price'][ $idx ]                        
                        ,'quantity' => $this->page_data['quantity'][ $idx ]
                        ,'order_date' => $this->page_data['order_date']                        
                        ,'process_state' => 'O'
                        ,'reg_idx' => getAccountInfo()['idx']
                        ,'reg_date' => 'NOW()'
                        ,'reg_ip' => $this->getIP()
                    ];

                    if( empty( $this->page_data['receipt_date'] ) == false ) {
                        $insert_data['receipt_date'] = $this->page_data['receipt_date'];
                    }

                    # 주문 정보 삽입
                    $query_result = $this->model->insetOrder( $insert_data );
                    
                    if( $idx == 0 ) {                        
                        $get_insert_id =  $query_result['return_data']['insert_id'];
                    }
                    
                }

                $this->model->updateOrder([ 'order_group_no' => $get_insert_id ], " order_idx = '" . $get_insert_id. "'" );

                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './order_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'edit' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_idx'   
                    ,'quantity'                      
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                
                $update_data = [
                    'quantity' => $this->page_data['quantity']
                    ,'order_date' => $this->page_data['order_date']                                                               
                    ,'process_state' => $this->page_data['process_state']
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ];

                if( empty( $this->page_data['receipt_date'] ) == false ) {
                    $update_data['receipt_date'] = $this->page_data['receipt_date'];
                }

                # 주문정보 수정
                $query_result = $this->model->updateOrder( $update_data ," order_idx = '" . $this->page_data['order_idx']. "'" );

                # 트랜잭션 종료
               $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './order_edit?order_idx='. $this->page_data['order_idx'] . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'order_cancel' : {
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_idx'                                     
                ]);
                
                $query_result = $this->model->updateOrder( ['process_state' => 'C'] ," order_idx = '" . $this->page_data['order_idx']. "'" );
                
                movePage('replace', '저장되었습니다.', './order_list?page='. $this->page_data['page'] . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_idx'                                     
                ]);
                
                $query_result = $this->model->updateOrder( ['del_flag' => 'Y'] ," order_idx = '" . $this->page_data['order_idx']. "'" );
                
                movePage('replace', '삭제되었습니다.', './order_list?page='. $this->page_data['page'] . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }

            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    }

    
    /**
     * 자재 주문 목록 화면 구성
     */
    public function warehouse_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'warehouse';
        $this->page_data['process_state_arr'] = [
            'O' => '주문'
            ,'W' => '입고'
            ,'C' => '취소'
        ];

        $query_where = " AND ( del_flag='N' ) AND company_idx = '". COMPANY_CODE ."' AND process_state <> 'C' ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY order_idx DESC, order_date DESC, receipt_date DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( company_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( order_idx LIKE '%". $this->page_data['sch_keyword'] ."%' )                                     
                                    OR ( material_name LIKE '%". $this->page_data['sch_keyword'] ."%' )                                     
                                    OR ( manager_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        
        
        if($this->page_data['sch_process_state']) {
            $query_where .= " AND ( process_state = '".$this->page_data['sch_process_state']."' ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( receipt_date >= '".$this->page_data['sch_s_date']."' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( receipt_date <= '".$this->page_data['sch_e_date']."' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getOrders([            
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
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    } 


    /**
     * 입고승인요청 페이지를 구성한다.
     */
    public function warehouse_write(){  
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'warehouse';
        $this->page_data['materials'] = $this->model->getMaterials(" as_material.company_idx='". COMPANY_CODE ."' AND ( as_company.use_flag='Y' ) ")['rows'];
        $this->page_data['receiving_docs'] = []; 
       
        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
            $this->issetParams( $this->page_data, [
                'order_idx' 
            ]);
            
            $this->page_data['page_work'] = '수정';

            # 주문 내역을 요청한다.
            $query_result = $this->model->getOrder(" order_idx = '". $this->page_data['order_idx'] ."' " );    
                
            if( $query_result['num_rows'] == 0 ){
                    
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
                
            }

            $this->page_data = array_merge( $this->page_data, $query_result['row'] );


            # 파일 정보            
            $file_result = $this->file_manager->dbGetFile("
                tb_key = '". $this->page_data['order_idx'] ."'
                AND where_used = 'receiving_doc'
                AND tb_name = 't_materials_order'
            ");

            $this->page_data['receiving_docs'] = $file_result['rows'];
            

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';
            $this->page_data['order_date'] = date('Y-m-d');
            $this->page_data['receipt_date'] = date('Y-m-d');

        }

        $this->page_data['receiving_docs'] = jsonReturn( $this->page_data['receiving_docs'] );

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }


    /**
     * 주문정보 데이터를 처리한다.
     */
    public function warehouse_proc(){

        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data ); exit;


        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_date'                                        
                    ,'material_name'                                        
                    ,'quantity'                                        
                    ,'receipt_date'                                        
                ]);
               
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                
                $insert_data = [
                    'company_idx' => COMPANY_CODE                    
                    ,'materials_usage_idx' => $this->page_data['materials_usage_idx']
                    ,'material_idx' => $this->page_data['material_idx']
                    ,'material_kind' => $this->page_data['material_kind']
                    ,'material_name' => $this->page_data['material_name']
                    ,'product_name' => $this->page_data['product_name']
                    ,'material_unit' => $this->page_data['material_unit']
                    ,'standard_info' => $this->page_data['standard_info']
                    ,'country_of_origin' => $this->page_data['country_of_origin']
                    ,'material_unit_price' => $this->page_data['material_unit_price']
                    ,'quantity' => $this->page_data['quantity']
                    ,'order_date' => $this->page_data['order_date']                           
                    ,'available_date_type' => $this->page_data['available_date_type']                                        
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ];
                
                
                if( empty( $this->page_data['receipt_date'] ) == false ) {
                    $insert_data['receipt_date'] = $this->page_data['receipt_date'];
                }

                if( empty( $this->page_data['available_date'] ) == false ) {
                    $insert_data['available_date'] = $this->page_data['available_date'];
                }


                # 주문 정보 삽입
                $query_result = $this->model->insetOrder( $insert_data );
                
                $get_insert_id =  $query_result['return_data']['insert_id'];
                
                $this->model->updateOrder([ 'order_group_no' => $get_insert_id ], " order_idx = '" . $get_insert_id. "'" );

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS_ORDER;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials_order'                        
                        ,'where_used' => 'receiving_doc'
                        ,'tb_key' => $get_insert_id
                    ]
                ];
                $this->file_manager->set_file_title = $this->page_data['file_title'];
                $this->file_manager->fileUpload();
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                

                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                // movePage('replace', '저장되었습니다.', './warehouse_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                movePage('replace', '저장되었습니다.', './warehouse_write?mode=edit&order_idx='. $get_insert_id . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'edit' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_idx'   
                    ,'quantity'                      
                    ,'receipt_date'                      
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                
                $update_data = [
                    'quantity' => $this->page_data['quantity']
                    ,'materials_usage_idx' => $this->page_data['materials_usage_idx']
                    ,'material_idx' => $this->page_data['material_idx']
                    ,'material_kind' => $this->page_data['material_kind']
                    ,'material_name' => $this->page_data['material_name']                    
                    ,'product_name' => $this->page_data['product_name']                    
                    ,'order_date' => $this->page_data['order_date']                    
                    ,'available_date_type' => $this->page_data['available_date_type']                                    
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ];

                if( empty( $this->page_data['available_date'] ) == false ) {
                    $update_data['available_date'] = $this->page_data['available_date'];
                }

                if( empty( $this->page_data['receipt_date'] ) == false ) {
                    $update_data['receipt_date'] = $this->page_data['receipt_date'];
                }

                # 주문정보 수정
                $query_result = $this->model->updateOrder( $update_data ," order_idx = '" . $this->page_data['order_idx']. "'" );
                

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS_ORDER;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials_order'                        
                        ,'where_used' => 'receiving_doc'
                        ,'tb_key' => $this->page_data['order_idx']
                    ]
                ];
                $this->file_manager->set_file_title = $this->page_data['file_title'];
                $this->file_manager->fileUpload();

                if( $this->page_data['del_file_idx'] ){
                    $this->file_manager->dbDeleteHandler( " idx IN ( ". $this->page_data['del_file_idx'] ." ) " );
                }

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  

                

                # 트랜잭션 종료
               $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './warehouse_write?mode=edit&order_idx='. $this->page_data['order_idx'] . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'approval_request' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'order_date'                                        
                    ,'material_name'                                        
                    ,'quantity'                                        
                    ,'receipt_date'                                        
                    ,'material_idx'                                        
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                if( empty( $this->page_data['order_idx'] ) == true ) {

                    

                    $insert_data = [
                        'company_idx' => COMPANY_CODE                    
                        ,'materials_usage_idx' => $this->page_data['materials_usage_idx']
                        ,'material_idx' => $this->page_data['material_idx']
                        ,'material_kind' => $this->page_data['material_kind']
                        ,'material_name' => $this->page_data['material_name']
                        ,'product_name' => $this->page_data['product_name']
                        ,'material_unit' => $this->page_data['material_unit']
                        ,'standard_info' => $this->page_data['standard_info']
                        ,'country_of_origin' => $this->page_data['country_of_origin']
                        ,'material_unit_price' => $this->page_data['material_unit_price']
                        ,'quantity' => $this->page_data['quantity']
                        ,'order_date' => $this->page_data['order_date']                          
                        ,'available_date_type' => $this->page_data['available_date_type']                    
                        ,'available_date' => $this->page_data['available_date']  
                        ,'approval_state' => 'R'
                        ,'process_state' => 'W'
                        ,'reg_idx' => getAccountInfo()['idx']
                        ,'reg_date' => 'NOW()'
                        ,'reg_ip' => $this->getIP()
                    ];
    
                    
                    if( empty( $this->page_data['receipt_date'] ) == false ) {
                        $insert_data['receipt_date'] = $this->page_data['receipt_date'];
                    }

                    if( empty( $this->page_data['available_date'] ) == false ) {
                        $insert_data['available_date'] = $this->page_data['available_date'];
                    }
    
                    # 주문 정보 삽입
                    $query_result = $this->model->insetOrder( $insert_data );
                    
                    $get_insert_id =  $query_result['return_data']['insert_id'];
                    
                    $this->model->updateOrder([ 'order_group_no' => $get_insert_id ], " order_idx = '" . $get_insert_id. "'" );
                    
                    $this->page_data['order_idx'] = $get_insert_id;
                    
                } else {

                    # 트랜잭션 시작
                    $this->model->runTransaction();
                    
                    $update_data = [
                        'quantity' => $this->page_data['quantity']
                        ,'materials_usage_idx' => $this->page_data['materials_usage_idx']
                        ,'material_idx' => $this->page_data['material_idx']
                        ,'material_kind' => $this->page_data['material_kind']
                        ,'material_name' => $this->page_data['material_name']
                        ,'product_name' => $this->page_data['product_name']                    
                        ,'order_date' => $this->page_data['order_date']
                        ,'receipt_date' => $this->page_data['receipt_date']
                        ,'available_date_type' => $this->page_data['available_date_type']                    
                        ,'available_date' => $this->page_data['available_date']                    
                        ,'material_unit_price' => $this->page_data['material_unit_price']                    
                        ,'approval_state' => 'R'
                        ,'process_state' => 'W'
                        ,'edit_idx' => getAccountInfo()['idx']
                        ,'edit_date' => 'NOW()'
                        ,'edit_ip' => $this->getIP()
                    ];

                    # 주문정보 수정
                    $query_result = $this->model->updateOrder( $update_data ," order_idx = '" . $this->page_data['order_idx']. "'" );

                    
                    
                }
                
                # 같은 주문 존재 확인
                $query_result = $this->model->doubleCheckStock( " ( company_idx='". COMPANY_CODE ."' ) AND ( order_idx='". $this->page_data['order_idx'] ."' ) " );

                if( $query_result == 0 ) {

                    $insert_data = [
                        'company_idx' => COMPANY_CODE                    
                        ,'order_idx' => $this->page_data['order_idx']
                        ,'materials_usage_idx' => $this->page_data['materials_usage_idx']
                        ,'material_idx' => $this->page_data['material_idx']
                        ,'material_kind' => $this->page_data['material_kind']
                        ,'material_name' => $this->page_data['material_name']
                        ,'product_name' => $this->page_data['product_name']
                        ,'material_unit' => $this->page_data['material_unit']
                        ,'standard_info' => $this->page_data['standard_info']
                        ,'country_of_origin' => $this->page_data['country_of_origin']
                        ,'material_unit_price' => $this->page_data['material_unit_price']
                        ,'quantity' => $this->page_data['quantity']
                        ,'order_date' => $this->page_data['order_date']                    
                        ,'receipt_date' => $this->page_data['receipt_date']         
                        ,'available_date_type' => $this->page_data['available_date_type']                    
                        ,'available_date' => $this->page_data['available_date']                               
                        ,'task_type' => 'I'                    
                        ,'reg_idx' => getAccountInfo()['idx']
                        ,'reg_date' => 'NOW()'
                        ,'reg_ip' => $this->getIP()
                    ];
    
           
                    # 주문 정보 삽입
                    $query_result = $this->model->insertStock( $insert_data );

                }

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS_ORDER;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials_order'                        
                        ,'where_used' => 'receiving_doc'
                        ,'tb_key' => $this->page_data['order_idx']
                    ]
                ];
                $this->file_manager->set_file_title = $this->page_data['file_title'];
                $this->file_manager->fileUpload();

                if( $this->page_data['del_file_idx'] ){
                    $this->file_manager->dbDeleteHandler( " idx IN ( ". $this->page_data['del_file_idx'] ." ) " );
                }
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  

                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './warehouse_list?page='. $this->page_data['page'] . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    }

    /**
     * 원부자재 관리
     */
    public function materials_list(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'materials';

        //11/24/20 KANGE ADD.1 material_kind = 'sub' 조건 추가 (부자재)
        //$query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' )  ";
        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' ) AND (material_kind = 'sub') ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY use_flag ASC, material_idx DESC  ';
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        if($this->page_data['sch_material_kind']) {
            $query_where .= " AND ( material_kind = '".$this->page_data['sch_material_kind']."' ) ";
        }

        if($this->page_data['sch_use_flag']) {
            $query_where .= " AND ( use_flag = '".$this->page_data['sch_use_flag']."' ) ";
        }


//        if( $this->page_data['sch_keyword'] ) {
//            $query_where .= " AND (
//                                    ( material_name LIKE '%". $this->page_data['sch_keyword'] ."%' )
//
//                            ) ";
//        }
        //11/24/20 KANGE ADD.2 검색 조건 추가
        if($this->page_data['sch_keyword']){

            switch($this->page_data['searchType']){
                case 'All' : {
                    $query_where .= " AND (material_name LIKE '%". $this->page_data['sch_keyword'] ."%') ";
                    break;
                }
                case 'itemCode' : {
                    //11/24/20 KANGE itemCode 찾으면 그걸로 바꿔야함
                    $query_where .= " AND (material_idx LIKE '%". $this->page_data['sch_keyword'] ."%') ";
                    break;
                }
                case 'itemName' : {
                    $query_where .= " AND (material_name LIKE '%". $this->page_data['sch_keyword'] ."%') ";
                    break;
                }
            }
        }
        //11/24/20 KANGE ADD.2 검색 조건 추가


        # 리스트 정보요청
        $list_result = $this->model->getMaterialStds([            
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
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }
    
    /**
     * 원부자재 작성 화면 구성
     */
    public function materials_write(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'materials';
        
       
        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
            $this->issetParams( $this->page_data, [
                'material_idx' 
            ]);
            
            $this->page_data['page_work'] = '수정';

            # 자재 정보를 요청한다.
            $query_result = $this->model->getMaterialStd(" material_idx = '". $this->page_data['material_idx'] ."' " );    
                
            if( $query_result['num_rows'] == 0 ){
                    
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
                
            }

            $this->page_data = array_merge( $this->page_data, $query_result['row'] );

             # 파일 정보            
             $file_result = $this->file_manager->dbGetFile("
                tb_key = '". $this->page_data['material_idx'] ."'
                AND where_used = 'material_std_file'
                AND tb_name = 't_materials'
            ");

            $this->page_data['file_idx'] = $file_result['row']['idx'];
            $this->page_data['file_path'] = $file_result['row']['path'];
            $this->page_data['file_server_name'] = $file_result['row']['server_name'];
            $this->page_data['file_origin_name'] = $file_result['row']['origin_name'];
            

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }


        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }

    /**
     * 원부자재 데이터 처리
     */
    public function materials_proc(){
        # post 접근 체크
        postCheck();

        $page_name = 'materials';


        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'material_kind'
                    ,'material_name'                    
                ]);
    

                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 삽입
                $query_result = $this->model->insetMaterialStd([
                    'material_kind' => $this->page_data['material_kind']
                    ,'material_name' => $this->page_data['material_name']
                    ,'net_contents' => $this->page_data['net_contents']
                    ,'use_flag' => $this->page_data['use_flag']
                    ,'company_idx' => COMPANY_CODE
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ]);
                
                # 기업정보 삽입 완료된 기본키를 가져온다.
                $new_insert_idx = $query_result['return_data']['insert_id'];
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS;
                $this->file_manager->file_element = 'material_std_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials'                        
                        ,'where_used' => 'material_std_file'
                        ,'tb_key' => $new_insert_idx
                    ]
                ];
                $this->file_manager->fileUpload();
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  


                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './'. $page_name .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'edit' : {

               #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'material_idx'
                    ,'material_name'                   
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 삽입
                $query_result = $this->model->updateMaterialStd([
                    'material_kind' => $this->page_data['material_kind']
                    ,'material_name' => $this->page_data['material_name']
                    ,'net_contents' => $this->page_data['net_contents']
                    ,'use_flag' => $this->page_data['use_flag']                   
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ]," material_idx = '" . $this->page_data['material_idx']. "'" );
                                
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_MATERIALS;
                $this->file_manager->file_element = 'material_std_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_materials'                        
                        ,'where_used' => 'material_std_file'
                        ,'tb_key' => $this->page_data['material_idx']
                    ]
                    , 'delete' => " idx='". $this->page_data['file_idx'] ."' "
                ];
                $this->file_manager->fileUpload();
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  


                # 트랜잭션 종료
                $this->model->stopTransaction();


                movePage('replace', '저장되었습니다.', './'. $page_name .'_write?material_idx='. $this->page_data['material_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'material_idx'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 정보 수정
                $query_result = $this->model->updateMaterialStd(['del_flag'=>'Y']," material_idx = '" . $this->page_data['material_idx'] . "'" );
                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '삭제되었습니다.', './'. $page_name .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }

    }

    /**
     * 원부자재 재고 현황
     */
    public function stock_list(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'stock';
        
        // 쿼리에러가 나서 주석처리함 11/06/2020 kange
        /*
        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' )  ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY receipt_date DESC  ';
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( receipt_date >= '".$this->page_data['sch_s_date']."' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( receipt_date <= '".$this->page_data['sch_e_date']."' ) ";
        }

        if($this->page_data['sch_material_kind']) {
            $query_where .= " AND ( material_kind = '".$this->page_data['sch_material_kind']."' ) ";
        }

        if($this->page_data['sch_material_std']) {
            $query_where .= " AND ( material_idx = '".$this->page_data['sch_material_std']."' ) ";
        }

        if($this->page_data['sch_task_type']) {
            $query_where .= " AND ( task_type = '".$this->page_data['sch_task_type']."' ) ";
        }

        

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( material_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( order_idx LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( memo LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                   
                            ) ";
        }

        $this->page_data['task_type_arr'] = [
            'I' => '입고'
            ,'R' => '반품'
            ,'U' => '사용'
            ,'D' => '폐기'
            ,'S' => '입고지시 사용예약'
        ];
        
        # 원부자재별 재고 현황 요청
        $stock_result = $this->model->getMaterialStockState(); 

        $this->page_data['stock_state'] = $stock_result['rows'];
        
        # 리스트 정보요청
        $list_result = $this->model->getMaterialStocks([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging;         
        $this->page_data['total_quantity'] = $list_result['total_quantity'];             
        */


        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }

    /**
     * 재고 데이터 처리
     */
    public function stock_proc(){
        # post 접근 체크
        postCheck();

        $page_name = 'stock';


        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                break;
            }
            case 'edit' : {

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'stock_idx'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 정보 수정
                $query_result = $this->model->updateStock(['del_flag'=>'Y']," stock_idx = '" . $this->page_data['stock_idx'] . "'" );
                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '삭제되었습니다.', './'. $page_name .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    }

    /**
     * 원부자재 주문건 재고 값 json 반환
     */
    public function get_stocks_json(){
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['order_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : order_idx ';
			jsonExit( $result );				
        }

        $list_result = $this->model->getAvailableStocks( $this->page_data['order_idx'] );

        $result['status'] = 'success';
        $result['msg'] = '';
        $result['stock_quantity'] = number_format( $list_result );
        jsonExit( $result );
        
    }

    /**
     * 원부자재 주문건에 대한 작업처리 json 반환
     */
    public function task_stocks_json(){
       
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['order_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : order_idx ';
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

        $stock_quantity = $this->model->getAvailableStocks( $this->page_data['order_idx'] );

        if( $stock_quantity >= $this->page_data['use_quantity'] ) {
            # 정상 작업처리

            #주문정보
            $query_result = $this->model->getOrder(" order_idx = '". $this->page_data['order_idx'] ."' " );    
            
            if( $query_result['num_rows'] > 0 ) {

                $order_info = $query_result['row'];
                
                $insert_data = [
                    'company_idx' => COMPANY_CODE                    
                    ,'order_idx' => $order_info['order_idx']
                    ,'materials_usage_idx' => $order_info['materials_usage_idx']
                    ,'material_idx' => $order_info['material_idx']
                    ,'material_kind' => $order_info['material_kind']
                    ,'material_name' => $order_info['material_name']
                    ,'product_name' => $order_info['product_name']
                    ,'material_unit' => $order_info['material_unit']
                    ,'standard_info' => $order_info['standard_info']
                    ,'country_of_origin' => $order_info['country_of_origin']
                    ,'material_unit_price' => $order_info['material_unit_price']                    
                    ,'order_date' => $order_info['order_date']                    
                    ,'receipt_date' => $order_info['receipt_date']         
                    ,'available_date_type' => $order_info['available_date_type']                    
                    ,'available_date' => $order_info['available_date']                               
                    ,'task_type' => $this->page_data['task_type']               
                    ,'quantity' => $this->page_data['use_quantity']     
                    ,'memo' => $this->page_data['memo']     
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ];

    
                # 주문 정보 삽입
                $query_result = $this->model->insertStock( $insert_data );

                $result['status'] = 'success';
                $result['msg'] = '처리되었습니다.';
                jsonExit( $result );
                
            } else {

                $result['status'] = 'fail';
                $result['msg'] = '주문 정보가 존재 하지 않습니다.';
                jsonExit( $result );
                
            }

        } else {
            # 남은 수량이 입력된 값보다 작은 경우
            $result['status'] = 'fail';
			$result['msg'] = '남은 수량이 입력된 사용값보다 적어 작업이 불가능합니다.';
			jsonExit( $result );
        }
                
    }

/**
     * 가공원료 기준목록 
     * 11/10/20 kange add  
     */
    public function worked_materials_list(){

        $page_name = 'worked_materials';
     
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }        
    

    /**
     * 가공원료 기준 작성화면 
     * 11/10/20 kange add 
     */
    public function worked_materials_write(){
       
        $page_name = 'worked_materials';
            
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }    

    /**
     * 원료기준 페이지 
     * 11/24/20 KANGE ADD.3
     */
    public function raw_materials_list(){

        $page_name = 'raw_materials';
        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."' ) AND (material_kind = 'raw') ";

        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY use_flag ASC, material_idx DESC  ';
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

        if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        if($this->page_data['sch_material_kind']) {
            $query_where .= " AND ( material_kind = '".$this->page_data['sch_material_kind']."' ) ";
        }

        if($this->page_data['sch_use_flag']) {
            $query_where .= " AND ( use_flag = '".$this->page_data['sch_use_flag']."' ) ";
        }

        if($this->page_data['sch_keyword']){

            switch($this->page_data['searchType']){
                case 'All' : {
                    $query_where .= " AND (material_name LIKE '%". $this->page_data['sch_keyword'] ."%') ";
                    break;
                }
                case 'itemCode' : {
                    //11/24/20 KANGE itemCode 찾으면 그걸로 바꿔야함
                    $query_where .= " AND (material_idx LIKE '%". $this->page_data['sch_keyword'] ."%') ";
                    break;
                }
                case 'itemName' : {
                    $query_where .= " AND (material_name LIKE '%". $this->page_data['sch_keyword'] ."%') ";
                    break;
                }
            }
        }

        # 리스트 정보요청
        $list_result = $this->model->getMaterialStds([
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
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];
        $this->view( $this->page_data );

    }        
    

    /**
     * 원료기준 작성화면 
     * 11/10/20 kange add 
     */
    public function raw_materials_write(){        
       
        $page_name = 'raw_materials';
            
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }


    /**
     * 원/부자재 구매 페이지 
     * 11/13/20 kange add  
     */
    public function purch_materials_list(){

        $page_name = 'purch_materials';
     
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }        
    

    /**
     * 원/부자재 구매 작성화면 
     * 11/13/20 kange add 
     */
    public function purch_materials_write(){
       
        $page_name = 'purch_materials';
            
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }   
    
    public function purch_materials_detail(){
       
        $page_name = 'purch_materials';
            
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/materials/'. $page_name .'_detail.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }    


}

?>