<?php

class doc extends baseController {

    private $model;
    private $paging;
    private $qrcode;
    

    function __construct() {
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('docModel');
        $this->qrcode = $this->new('QRcodeHandler');        
       
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
        ]);
    }

    
    /**
     * 일반 전자문서 목록 생성
     */
    public function doc_state(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->page_data['doc_list'] = $this->getConfig()['doc_state'][ $this->page_data['left_code'] ];

        switch( $this->page_data['left_code'] ){
            case 'ccp' : {
                $this->page_data['task_title'] = 'CCP 문서승인 관리';
                break;
            }
            case 'haccp' : {
                $this->page_data['task_title'] = 'HACCP 문서승인 관리';
                break;
            }
            default : {
                $this->page_data['task_title'] = '일반 문서승인 관리';
            }
        }

        $this->page_data['use_top'] = true;
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['contents_path'] = '/doc/doc_state.php';

        $this->view( $this->page_data );        
    }

    /**
     * 일반 전자문서 목록 생성
     */
    public function doc_list(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        
        $this->issetParams( $this->page_data, ['doc_usage_idx']);

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=        
        $this->page_data['page_name'] = 'doc';         
        $this->page_data['doc_list'] = $this->getConfig()['doc_state'][ $this->page_data['left_code'] ];

        $this->page_data['approval_state_arr'] = [
            'W' => '작성중'
            ,'R' => '승인요청'
            ,'D' => '완료'
        ];

        foreach( $this->page_data['doc_list'] AS $idx=>$val ) {
            if( $this->page_data['doc_usage_idx'] == $val['key'] ) {
                $this->page_data['task_title'] = $val['title'];
                break;
            }
        }

        $query_where = " AND ( del_flag='N' ) AND ( doc_usage_idx = '". $this->page_data['doc_usage_idx'] ."' ) ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {            
            $query_sort = ' ORDER BY doc_approval_idx DESC ';
        }


        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( writer_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( reviewer_name LIKE '%". $this->page_data['sch_keyword'] ."%' )                                     
                                    OR ( approver_name LIKE '%". $this->page_data['sch_keyword'] ."%' )                                     
                            ) ";
        }
        
        if($this->page_data['sch_approval_state']) {
            $query_where .= " AND ( approval_state = '".$this->page_data['sch_approval_state']."' ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( request_date >= '".$this->page_data['sch_s_date']."' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( request_date <= '".$this->page_data['sch_e_date']."' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getApprovalDocuments([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        $this->page_data['list'] = $list_result['rows'];        
        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['contents_path'] = '/doc/doc_list.php';

        $this->view( $this->page_data );        
    }

    /**
     * 문서 양식을 반환 한다.
     */
    public function getDocForm() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['doc_usage_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : doc_usage_idx ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['task_type'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : task_type ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['task_table_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : task_table_idx ';
			jsonExit( $result );				
        }

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $result['document_form'] = [];
        $result['document_usage_info'] = [];

        $form_result = $this->model->getDocumentForm( " AND ( doc_usage_idx = '". $this->page_data['doc_usage_idx'] ."' ) " );
        
        if( count( $form_result['row'] ) > 0  ) {

            foreach( $form_result['row'] AS $key=>$val ) {

                if( ( $key == 'doc_table_style_data' ) || ( $key == 'doc_data' ) ) {
                    $val = htmlspecialchars_decode( $val );
                } 

                $result['document_form'][ $key ] = $val;
            }
            
            // $result['document_form'] = $form_result['row'];

            

        }

        $doc_result = $this->model->getApprovalDocument( " 
            AND ( doc_usage_idx = '". $this->page_data['doc_usage_idx'] ."' ) 
            AND ( task_type = '". $this->page_data['task_type'] ."' ) 
            AND ( task_table_idx = '". $this->page_data['task_table_idx'] ."' ) 
        " );
        
        if( $doc_result['num_rows'] > 0  ) {
            
            foreach( $form_result['row'] AS $key=>$val ) {

                if( ( $key == 'doc_table_style_data' ) || ( $key == 'doc_data' ) ) {
                    $val = htmlspecialchars_decode( $val );
                } 

                $result['document_usage_info'][ $key ] = $val;
            }
            
        }

        $result['status'] = 'success';
        $result['msg'] = '';
        $result['writer_name'] = getAccountInfo()['name'];
      
        jsonExit( $result );


    }

    /**
     * 문서 승인 테이블 데이터 처리
     */
    public function docApprovalDocProc(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     
        if( empty( $this->page_data['doc_usage_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : doc_usage_idx ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['task_type'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : task_type ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['task_table_idx'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : task_table_idx ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['doc_data'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : doc_data ';
			jsonExit( $result );				
        }

        if( empty( $this->page_data['doc_table_style_data'] ) ) {
			$result['status'] = 'fail';
			$result['msg'] = '필수값 누락 : doc_table_style_data ';
			jsonExit( $result );				
        }

        switch( $this->page_data['mode'] ) {

            case 'save' : {
                // doc_approval_idx

                if( isset( $this->page_data['doc_approval_idx'] ) == true ) {
                    # update
                } else {
                    # insert

                    # 트랜잭션 시작
                    $this->model->runTransaction();
                    // echoBr( $this->page_data );

                    # QrCode 생성
                    // $this->page_data['doc_data'] = htmlspecialchars_decode( $this->page_data['doc_data'] );

                    // $doc_data = json_decode( $this->page_data['doc_data'], true );

                    // __reporter_qr__

                    // jsonExit( $this->page_data['doc_data'] );
                    // htmlspecialchars_decode
                    
                    # 승인문서 등록
                    $query_result = $this->model->insertApprovalDoc([
                        'company_idx' => COMPANY_CODE
                        ,'doc_usage_idx' => $this->page_data['doc_usage_idx']
                        ,'task_type' => $this->page_data['task_type']
                        ,'task_table_idx' => $this->page_data['task_table_idx']
                        ,'item_code' => $this->page_data['item_code']
                        ,'doc_table_style_data' => $this->page_data['doc_table_style_data']
                        ,'doc_data' => $this->page_data['doc_data']
                        ,'writer_idx' => getAccountInfo()['idx']         
                        ,'reg_date' => 'NOW()'
                        ,'reg_ip' => $this->getIP()
                    ]);

                    $new_doc_approval_idx = $query_result['return_data']['insert_id'];

                    # QRcode 데이터베이스에 적재
                    $this->qrcode->createQRcode([
                        'purpose' => 'mesa'
                        ,'qrcode_val' => '//sandle.dreamofway.com/doc/qr_result?key=' . $new_doc_approval_idx
                        ,'file_name' => $new_doc_approval_idx.'_reporter_'.getAccountInfo()['idx']
                        ,'tb_name' => 't_document_approval'             
                        ,'tb_key' => $new_doc_approval_idx
                    ]);
                    

                    # 트랜잭션 종료
                    $this->model->stopTransaction();
                    
                }

                break;
            }
        
        }

        $result['status'] = 'success';
        jsonExit( $result );
        

    }

   
}

?>