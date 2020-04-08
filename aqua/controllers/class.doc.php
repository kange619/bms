<?php

class doc extends baseController {

    private $model;
    private $paging;

    function __construct() {
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('docModel');
       
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
            $query_sort = ' ORDER BY idx DESC ';
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

   
}

?>