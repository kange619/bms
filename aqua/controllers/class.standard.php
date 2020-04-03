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
 * 
 * ---------------------------------------------------
*/
class standard extends baseController {

    private $model;    
    private $paging;
    private $file_manager;    

    function __construct() {
        
        #로그인 확인
        loginState();
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('standardModel');         
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
            , 'sch_apply_s_date'            
            , 'sch_apply_e_date'            
            , 'sch_order_field'
            , 'sch_order_status'
        ]);

    }

    /**
     * 식품위생서류  목록 구현
     */
    public function sanitation_standard_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'sanitation_standard';
        $df_type = 'sanitation';
        $query_where = " AND ( del_flag='N' ) AND ( df_latest_status = 'Y' ) AND ( company_idx = '". COMPANY_CODE ."') AND ( df_type='". $df_type . "') ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY df_sort DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( df_title LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_contents LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_reason LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }


        # 리스트 정보요청
        $list_result = $this->model->getDocumentFiles([            
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
        $this->page_data['df_type'] = $df_type;
        $this->page_data['contents_path'] = '/standard/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }

    /**
     * HACCP 기준서 목록 구현
     */
    public function haccp_standard_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'haccp_standard';
        $df_type = 'haccp_standard';
        $query_where = " AND ( del_flag='N' ) AND ( df_latest_status = 'Y' ) AND ( company_idx = '". COMPANY_CODE ."') AND ( df_type='". $df_type . "') ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY df_sort DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( df_title LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_contents LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_reason LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        if($this->page_data['sch_apply_s_date']) {
            $query_where .= " AND ( df_apply_date >= '".$this->page_data['sch_apply_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_apply_e_date']) {
            $query_where .= " AND ( df_apply_date <= '".$this->page_data['sch_apply_e_date']." 23:59:59' ) ";
        }


        

        # 리스트 정보요청
        $list_result = $this->model->getDocumentFiles([            
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
        $this->page_data['df_type'] = $df_type;
        $this->page_data['contents_path'] = '/standard/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }

    /**
     * HACCP 기준서 개정 이력
     */
    public function haccp_update_record_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'haccp_update_record';
        $df_type = 'haccp_standard';
        $query_where = " AND ( del_flag='N' ) AND ( company_idx = '". COMPANY_CODE ."') AND ( df_type='". $df_type . "') ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY df_sort DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( df_title LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_contents LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_reason LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }

        if($this->page_data['sch_apply_s_date']) {
            $query_where .= " AND ( df_apply_date >= '".$this->page_data['sch_apply_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_apply_e_date']) {
            $query_where .= " AND ( df_apply_date <= '".$this->page_data['sch_apply_e_date']." 23:59:59' ) ";
        }

        # 리스트 정보요청
        $list_result = $this->model->getDocumentFiles([            
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
        $this->page_data['df_type'] = $df_type;
        $this->page_data['contents_path'] = '/standard/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }


    /**
     * HACCP 이행점검표   목록 구현
     */
    public function haccp_document_list() {

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $page_name = 'haccp_document';
        $df_type = 'haccp_document';
        $query_where = " AND ( del_flag='N' ) AND ( df_latest_status = 'Y' ) AND ( company_idx = '". COMPANY_CODE ."') AND ( df_type='". $df_type . "') ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY df_sort DESC ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( df_title LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_contents LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( df_reason LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND ( reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ) ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND ( reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ) ";
        }


        # 리스트 정보요청
        $list_result = $this->model->getDocumentFiles([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        
        $doc_result = $this->model->getDoc( " company_idx = '". COMPANY_CODE ."' AND ( del_flag='N' ) AND ( use_flag='Y' )" );
        $work_checklist = $this->model->getMesWorkChecklist();

        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging;       
        $this->page_data['work_checklist'] = $work_checklist;
        $this->page_data['doc_list'] = $doc_result['rows'];
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = $page_name;
        $this->page_data['df_type'] = $df_type;
        $this->page_data['contents_path'] = '/standard/'. $page_name .'_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );

    }


    public function standard_proc(){
        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data ); exit;

        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=`
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'df_title'                    
                    ,'df_type'                    
                ]);
                
                $result_max_sort = (int)$this->model->getMaxSort( $this->page_data['df_type'] );
                
                # 트랜잭션 시작
                $this->model->runTransaction();
                
                $insert_data = [
                    'df_type' => $this->page_data['df_type']
                    ,'company_idx' => COMPANY_CODE
                    ,'df_title' => $this->page_data['df_title']                        
                    ,'df_apply_date' => $this->page_data['df_apply_date']                        
                    ,'df_contents' => $this->page_data['df_contents']                        
                    ,'df_reason' => $this->page_data['df_reason']                        
                    ,'df_work_checklist' => $this->page_data['df_work_checklist']                                        
                    ,'df_work_checklist_doc' => $this->page_data['df_work_checklist_doc']                        
                    ,'df_work_schedule_weeks' => $this->page_data['df_work_schedule_weeks']                        
                    ,'df_sort' => ( $result_max_sort + 1 )
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ];

                # 정보 삽입
                $query_result = $this->model->insertDocumentFile( $insert_data );
                
                # 삽입 완료된 기본키를 가져온다.
                $new_idx = $query_result['return_data']['insert_id'];
                
                $query_result = $this->model->updateDocumentFile(['df_group'=> $new_idx ]," df_idx = '" . $new_idx . "'" );

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_DOCUMENT_STANDARD;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_document_files'                        
                        ,'where_used' => 'row_file'
                        ,'tb_key' => $new_idx
                    ]
                ];                
                $file_upload_result = $this->file_manager->fileUpload();
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                
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
                    'df_idx'
                    ,'df_title'
                    ,'df_type'
                    ,'df_group'
                ]);
                
                $result_max_sort = (int)$this->model->getMaxSort( $this->page_data['df_type'] );

                # 트랜잭션 시작
                $this->model->runTransaction();

                # 정보 수정
                $query_result = $this->model->updateDocumentFile(['df_latest_status'=>'N']," df_idx = '" . $this->page_data['df_idx'] . "'" );

                $insert_data = [
                    'df_type' => $this->page_data['df_type']
                    ,'company_idx' => COMPANY_CODE
                    ,'df_title' => $this->page_data['df_title']                        
                    ,'df_group' => $this->page_data['df_group']
                    ,'df_apply_date' => $this->page_data['df_apply_date']                        
                    ,'df_contents' => $this->page_data['df_contents']                        
                    ,'df_reason' => $this->page_data['df_reason']
                    ,'df_work_checklist' => $this->page_data['df_work_checklist']                                        
                    ,'df_work_checklist_doc' => $this->page_data['df_work_checklist_doc']                        
                    ,'df_work_schedule_weeks' => $this->page_data['df_work_schedule_weeks']                        
                    ,'df_sort' => $this->page_data['df_sort']                        
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ];

                # 정보 삽입
                $query_result = $this->model->insertDocumentFile( $insert_data );
                
                # 삽입 완료된 기본키를 가져온다.
                $new_idx = $query_result['return_data']['insert_id'];
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
                $this->file_manager->path = UPLOAD_DOCUMENT_STANDARD;
                $this->file_manager->file_element = 'doc_file';
                $this->file_manager->table_data = [
                    'insert'=> [
                        'tb_name' => 't_document_files'                        
                        ,'where_used' => 'row_file'
                        ,'tb_key' => $new_idx
                    ]
                    , 'delete' => " idx='". $this->page_data['file_idx'] ."' "
                ];                
                $file_upload_result = $this->file_manager->fileUpload();

                if( empty( $file_upload_result ) == true ) {
                    if( $this->page_data['file_idx'] ) {
                        $this->file_manager->fileCopy( UPLOAD_DOCUMENT_STANDARD, $this->page_data['file_idx'], $new_idx );
                    }
                }
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # // 파일 업로드
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

                # 트랜잭션 종료
                $this->model->stopTransaction();


                movePage('replace', '저장되었습니다.', './'. $this->page_data['page_name'] .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'df_idx'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 정보 수정
                $query_result = $this->model->updateDocumentFile(['del_flag'=>'Y']," df_idx = '" . $this->page_data['df_idx'] . "'" );
                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '삭제되었습니다.', './'. $this->page_data['page_name'] .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }

            case 'approve' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'df_idx'
                ]);
                
                # 트랜잭션 시작
                $this->model->runTransaction();

                # 정보 수정
                $query_result = $this->model->updateDocumentFile([
                    'df_approve_stauts' => 'D'
                    ,'approve_idx' => getAccountInfo()['idx'] 
                    ,'approve_date' => 'NOW()'
                ]," df_idx = '" . $this->page_data['df_idx'] . "'" );
                
                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '승인 되었습니다.', './'. $this->page_data['page_name'] .'_list?page='. $this->page_data['page'] . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }

            
            default : {
                errorBack('잘못된 접근입니다.');
            }
        }
    }


}

?>