<?php

class client extends baseController {

    private $model;    
    private $paging;
    private $page_name;    

    function __construct() {
        
        #로그인 확인
        loginState();
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('clientModel');         
        $this->model_product = $this->new('productModel');         
        
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

    }

    /**
     * 협력업체 목록을 생성한다.
     */
    public function client_list(){        

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'client';
        

        $query_where = " AND ( del_flag = 'N' ) AND ( company_idx = '". COMPANY_CODE ."' ) ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY client_idx DESC ';
        }


        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( company_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( registration_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( ceo_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( manager_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( manager_phone_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( manager_email LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getClients([            
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
        $this->page_data['contents_path'] = '/client/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }


     
    /**
     * 고객사 작성 페이지를 구성한다.
     */
    public function client_write(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'client';
        
        $this->page_data['company_addrs'] = json_encode( [] );

        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
            $this->issetParams( $this->page_data, ['client_idx']);
            
            $this->page_data['page_work'] = '수정';

            # 기업정보를 요청한다.
            $query_result = $this->model->getClient( " client_idx = '". $this->page_data['client_idx'] ."' " );

            if( $query_result['num_rows'] == 0 ){
                
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
                
            }

            $this->page_data = array_merge( $this->page_data, $query_result['row'] );

            if( $query_result['num_rows'] > 0 ){
                
                $this->page_data = array_merge( $this->page_data, $query_result['row'] );
                
            }

            # 업체의 배송지 주소를 요청한다.
            $query_result = $this->model->getClientComapnyAddr(" client_idx = '". $this->page_data['client_idx'] ."' AND del_flag='N' " );    
            
            if( $query_result['num_rows'] > 0 ){
                $this->page_data['company_addrs'] = json_encode( $query_result['rows'] );
            } 

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/client/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }

    /**
     * 고객기업 정보 데이터를 처리한다.
     */
    public function client_proc(){

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
                    $query_result = $this->model->getClient( " registration_no = '". $this->page_data['registration_no'] ."' AND company_idx = '". COMPANY_CODE ."'" );

                    if( $query_result['num_rows'] > 0 ){
                        
                        errorBack('이미 등록된 업체 입니다.');
                        
                    }    

                }
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 삽입
                $query_result = $this->model->insertClient([
                    'company_idx' => COMPANY_CODE
                    ,'company_name' => $this->page_data['company_name']
                    ,'registration_no' => $this->page_data['registration_no']
                    ,'ceo_name' => $this->page_data['ceo_name']
                    ,'company_tel' => $this->page_data['company_tel']
                    ,'company_fax' => $this->page_data['company_fax']
                    ,'company_homepage' => $this->page_data['company_homepage']
                    ,'client_zip_code' => $this->page_data['client_zip_code']
                    ,'client_addr' => $this->page_data['client_addr']
                    ,'client_addr_detail' => $this->page_data['client_addr_detail']
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
                $this->companyAddrProc( 
                    $new_company_idx
                    , $this->page_data['addr_name'] 
                    , $this->page_data['zipcode'] 
                    , $this->page_data['addr'] 
                    , $this->page_data['addr_detail']                   
                );

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
                    'client_idx'                    
                    ,'company_name'                    
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 삽입
                $query_result = $this->model->updateClient([
                    'company_name' => $this->page_data['company_name']
                    ,'registration_no' => $this->page_data['registration_no']
                    ,'ceo_name' => $this->page_data['ceo_name']
                    ,'company_tel' => $this->page_data['company_tel']
                    ,'company_fax' => $this->page_data['company_fax']
                    ,'company_homepage' => $this->page_data['company_homepage']
                    ,'client_zip_code' => $this->page_data['client_zip_code']
                    ,'client_addr' => $this->page_data['client_addr']
                    ,'client_addr_detail' => $this->page_data['client_addr_detail']
                    ,'manager_name' => $this->page_data['manager_name']
                    ,'manager_phone_no' => $this->page_data['manager_phone_no']
                    ,'manager_email' => $this->page_data['manager_email']
                    ,'use_flag' => $this->page_data['use_flag']
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ] ," client_idx = '" . $this->page_data['client_idx']. "'" );


                # 납품 자재 정보 처리
                $this->companyAddrProc( 
                    $this->page_data['client_idx']
                    , $this->page_data['addr_name'] 
                    , $this->page_data['zipcode'] 
                    , $this->page_data['addr'] 
                    , $this->page_data['addr_detail']  
                );

                # 트랜잭션 종료
               $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './'. $this->page_data['page_name'] .'_write?client_idx='. $this->page_data['client_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'client_idx'                    
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 기업 정보 수정
                $query_result = $this->model->updateClient([
                    'del_flag' => 'Y'
                ] ," client_idx = '" . $this->page_data['client_idx']. "'" );

                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '삭제되었습니다.', './'. $this->page_data['page_name'] .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

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
    private function companyAddrProc(  
        $arg_client_idx
        , $arg_addr_name
        , $zipcode
        , $addr
        , $addr_detail        
    ){


        # arg_client_idx 에 해당하는 기존 데이터 삭제처리
        $this->model->updateClientCompanyAddr([
            'del_flag' => 'Y'
        ], " client_idx  = '" . $arg_client_idx. "'"  );

        # 신규 insert 처리
        return $this->model->insertcompanyAddrs(  
            $arg_client_idx
            , $arg_addr_name
            , $zipcode
            , $addr
            , $addr_detail   
            , COMPANY_CODE 
        );

    }

    /**
     * 수주관리 목록 
     */
    public function receive_an_order_list(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'receive_an_order';
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
            $query_sort = ' ORDER BY order_idx DESC, order_date DESC, delivery_date DESC ';
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
        $list_result = $this->model->getReceiveOrders([            
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
        $this->page_data['contents_path'] = '/client/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );


    }
    
    /**
     * 수주 등록화면 구성
     */
    public function receive_an_order_write(){
    

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'receive_an_order';
        $this->page_data['products'] = [];

        # 생산 제품별 재고 수량을 가져온다.
        $query_result = $this->model_product->getProdcuctStockState();    
        
        // echobr( $query_result ); exit;
        
        if( $query_result['num_rows'] > 0 ){
            $this->page_data['products'] = json_encode( $query_result['rows'] );;
        }

        # 고객사 정보를 요청한다.
        $this->page_data['clients'] = $this->model->getClient( " ( company_idx = '". COMPANY_CODE ."' ) AND ( use_flag='Y' ) AND ( del_flag='N' ) " )['rows'];    
         
        # 고객사 별 배송지를 요청한다.
        $query_result = $this->model->getClientComapnyAddr( " ( company_idx = '". COMPANY_CODE ."' ) AND ( del_flag='N' ) " );    
        

        if( $query_result['num_rows'] > 0 ) {

            $client_addrs = [];
            $client_addrs[0]['addr_idx'] = 0;
            $client_addrs[0]['addr_name'] = '본점';

            foreach( $query_result['rows'] AS $idx=>$item ) {
            
            
                if( gettype($client_addrs[ $item['client_idx'] ]) == 'NULL' ) {
                    $client_addrs[ $item['client_idx'] ] = [];
                }
                
                array_push( $client_addrs[ $item['client_idx'] ], $item);
                
            }
            

        } else {
            $client_addrs['addr_idx'] = 0;
            $client_addrs['addr_name'] = '본점';
        }

        $this->page_data['client_addrs'] = $client_addrs;

        $this->page_data['mode'] = 'ins';
        $this->page_data['page_work'] = '등록';


        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['contents_path'] = '/client/'. $page_name .'_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

        
    }

}

?>