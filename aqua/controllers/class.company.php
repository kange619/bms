<?php

class company extends baseController {

    private $model;
    private $page_data;
    private $paging;            
    private $page_name;
    
    function __construct() {

        #로그인 확인
        loginState();
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # model instance
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $this->paging = $this->new('pageHelper');
        $this->model = $this->new('companyModel');        

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
            , 'sch_service'
            , 'sch_keyword'
            , 'sch_s_date'
            , 'sch_e_date'
            , 'sch_use_flag'
            , 'sch_order_field'
            , 'sch_order_status'
        ]);

    }

    /**
     * 기업정보 작성 페이지를 구성한다.
     */
    public function company_info(){
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        
        
        $this->page_data['food_types'] = $this->getConfig()['food_types'];
        $this->page_data['company_members'] = [];                

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
        
        $this->page_data['page_work'] = '수정';
        # 기업정보를 요청한다.
        $query_result = $this->model->getCompany( " company_idx = '". COMPANY_CODE ."' " );

        if( $query_result['num_rows'] == 0 ){
            
            errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            
        }

        $this->page_data = array_merge( $this->page_data, $query_result['row'] );

        # 기업회원 파트너 정보를 요청한다.
        $query_result = $this->model->getCompanyMember( 
            " company_idx = '". COMPANY_CODE ."' AND partner = 'Y' "
        );

        if( $query_result['num_rows'] > 0 ){
            
            $this->page_data = array_merge( $this->page_data, $query_result['row'] );
            
        }

        # 기업회원 파트너 정보를 요청한다.
        $query_result = $this->model->getCompanyMember( 
            " company_idx = '". COMPANY_CODE ."' AND partner = 'N' "
        );

        if( $query_result['num_rows'] > 0 ){
            $this->page_data['company_members'] = $query_result['rows'];
        } 
        

        # 제조식품 유형 정보를 요청한다.
        $query_result = $this->model->getFoodUsage( COMPANY_CODE );    
        
        if( $query_result['num_rows'] > 0 ){
            $this->page_data['added_food_types'] = $query_result['rows'];
        }

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'company';
        $this->page_data['contents_path'] = '/company/company_write.php';
        $this->page_data['list'] = $list_result['rows'];
        
        $this->view( $this->page_data );

    }

    /**
     * 기업정보 데이터를 처리한다.
     */
    public function company_proc(){

        # post 접근 체크
        postCheck();       

        // echoBr( $this->page_data ); exit;

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # 필수값 체크
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
        $this->issetParams( $this->page_data, [                    
            'company_name'
            ,'registration_no'
            ,'ceo_name'
            ,'company_tel'
        ]);       
        
        # 트랜잭션 시작
        $this->model->runTransaction();

        # 기업 정보 삽입
        $query_result = $this->model->updateCompanyInfo([
            'company_name' => $this->page_data['company_name']
            ,'registration_no' => $this->page_data['registration_no']
            ,'ceo_name' => $this->page_data['ceo_name']
            ,'company_tel' => $this->page_data['company_tel']
            ,'company_fax' => $this->page_data['company_fax']
            ,'company_homepage' => $this->page_data['company_homepage']
            ,'zip_code' => $this->page_data['zip_code']
            ,'addr' => $this->page_data['addr']
            ,'addr_detail' => $this->page_data['addr_detail']                    
        ] ," company_idx = '" . COMPANY_CODE. "'" );



        if( empty( $this->page_data['edit_partner_idx'] ) == false ) {

            # 기존 기업회원 파트너 자격 제거 
            $query_result = $this->model->updateCompanyMember([
                'partner' => 'N'
            ] ," company_member_idx = '" . $this->page_data['current_partner_idx']. "'" );
            
            # edit_partner_idx 에 해당하는 기업회원 파트너 자격
            $query_result = $this->model->updateCompanyMember([
                'partner' => 'Y'
            ] ," company_member_idx = '" . $this->page_data['edit_partner_idx']. "'" );
            
        }

        # 트랜잭션 종료
        $this->model->stopTransaction();

        movePage('replace', '저장되었습니다.', './company_info?top_code=' . $this->page_data['top_code'] . '&left_code=' .$this->page_data['left_code']  );

        
    }

    /**
     * 식품유형 정보를 처리한다.
     */
    private function foodTypeUsageProc( $arg_company_idx, $arg_data ){
        # company_idx 에 해당하는 기존 데이터 삭제처리
        $this->model->updateFoodUsage([
            'del_flag' => 'Y'
        ], " company_idx = '" . $arg_company_idx. "'"  );

        # 신규 insert 처리
        return $this->model->insertFoodUsage( $arg_company_idx, $arg_data );

    }

    /**
     * 회원 목록 페이지를 생성한다.
     */
    public function member_list(){

        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $query_where = " AND del_flag='N' AND company_idx = '". COMPANY_CODE ."' ";
        
        $limit = " LIMIT ".(($this->page_data['page']-1)*$this->page_data['list_rows']).", ".$this->page_data['list_rows'];

        if( $this->page_data['sch_order_field'] ){
            $query_sort = ' ORDER BY '. $this->page_data['sch_order_field'] .' '.$this->page_data['sch_order_status'].' ';
        } else {
            $query_sort = ' ORDER BY use_flag ASC, company_member_idx DESC  ';
        }

        if( $this->page_data['sch_keyword'] ) {
            $query_where .= " AND ( 
                                    ( company_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( registration_no LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( ceo_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                                    OR ( member_name LIKE '%". $this->page_data['sch_keyword'] ."%' ) 
                            ) ";
        }

        if($this->page_data['sch_s_date']) {
            $query_where .= " AND reg_date >= '".$this->page_data['sch_s_date']." 00:00:00' ";
        }

		if($this->page_data['sch_e_date']) {
            $query_where .= " AND reg_date <= '".$this->page_data['sch_e_date']." 23:59:59' ";
        }

        if($this->page_data['sch_use_flag']) {
            $query_where .= " AND use_flag = '".$this->page_data['sch_use_flag']."' ";
        }

        

        # 리스트 정보요청
        $list_result = $this->model->getCompanyMembers([            
            'query_where' => $query_where
            ,'query_sort' => $query_sort
            ,'limit' => $limit
        ]);

        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging; 
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'member';
        $this->page_data['contents_path'] = '/company/member_list.php';
        $this->page_data['list'] = $list_result['rows'];        
        $this->view( $this->page_data );
        
    }

    /**
     * 회원 정보 등록/수정 페이지를 생성한다.
     */
    public function member_write(){
        
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        # SET Values
        #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
        $query_result = [];
       

        if( $this->page_data['mode'] == 'edit') {

            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
            # 필수값 체크
            #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=            
            $this->issetParams( $this->page_data, ['company_member_idx']);
            
            $this->page_data['page_work'] = '수정';
            
            # 회원 정보
            $security_result = $this->model->getCompanyMember( " company_member_idx = '". $this->page_data['company_member_idx'] ."' " );

            if( count( $security_result['row'] ) > 0  ) {
                $this->page_data = array_merge( $this->page_data, $security_result['row'] );
            } else {
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            }

            # 회사 정보 
            $company_result = $this->model->getCompanys([
                'query_where' => " AND company_idx='". COMPANY_CODE ."' "
            ]);

            if( count( $company_result['rows'][0] ) > 0  ) {
                $this->page_data = array_merge( $this->page_data, $company_result['rows'][0] );
            }
            

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }

        $this->page_data['service_items'] = $this->getConfig()['view']['menu_info']['top_menu'];
        $this->page_data['mes_process'] = $this->getConfig()['mes_process'];
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'member';        
        $this->page_data['contents_path'] = '/company/member_write.php';
        
        
        $this->view( $this->page_data );

    }

    /**
     * 회원 정보 데이터를 처리한다.
     */
    public function member_proc(){

        # post 접근 체크
        postCheck();

        // echoBr( $this->page_data ); exit;

        $this->page_name = 'member';

        switch( $this->page_data['mode'] ) {

            case 'ins' : {
                
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [                                  
                    'phone_no'
                    ,'password'
                    ,'member_name'
                ]);
                
                # 회원 비밀번호 일치 확인
                if( $this->page_data['password'] !== $this->page_data['re_password'] ) {
                    errorBack('비밀번호 값과 재입력 값이 일치하지 않습니다.');
                }

                # 회원 아이디 중복 확인 
                $member_result = $this->model->getCompanyMember(" 
                    company_idx='". COMPANY_CODE ."' 
                    AND phone_no='". $this->page_data['phone_no'] ."'
                ");

                if( $member_result['num_rows'] > 0) {
                    errorBack('중복된 핸드폰 번호입니다.');
                }
                
                # approval_auth 문자열로 변환
                if( count( $this->page_data['approval_auth'] ) > 0 ){
                    $this->page_data['approval_auth'] = join(',', $this->page_data['approval_auth'] );
                }

                # work_auth 문자열로 변환
                if( count( $this->page_data['work_auth'] ) > 0 ){
                    $this->page_data['work_auth'] = join(',', $this->page_data['work_auth'] );
                }

                # menu_auth 문자열로 변환
                if( count( $this->page_data['menu_auth'] ) > 0 ){
                    $this->page_data['menu_auth'] = join(',', $this->page_data['menu_auth'] );
                }


                # 트랜잭션 시작
                $this->model->runTransaction();


                $query_result = $this->model->insertCompanyMember([
                    'company_idx ' => COMPANY_CODE                    
                    ,'member_name' => $this->page_data['member_name']
                    ,'phone_no' => $this->page_data['phone_no']
                    ,'email' => $this->page_data['email']
                    ,'approval_auth' => $this->page_data['approval_auth']
                    ,'work_auth' => $this->page_data['work_auth']
                    ,'menu_auth' => $this->page_data['menu_auth']
                    ,'use_flag' => $this->page_data['use_flag']
                    ,'password' => hash_conv( $this->page_data['password'] )
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'reg_date' => 'NOW()'
                    ,'reg_ip' => $this->getIP()
                ]);
                
               
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
                    'company_member_idx'                    
                    ,'phone_no'                    
                    ,'member_name'
                ]);
                
                # approval_auth 문자열로 변환
                if( count( $this->page_data['approval_auth'] ) > 0 ){
                    $this->page_data['approval_auth'] = join(',', $this->page_data['approval_auth'] );
                }

                # work_auth 문자열로 변환
                if( count( $this->page_data['work_auth'] ) > 0 ){
                    $this->page_data['work_auth'] = join(',', $this->page_data['work_auth'] );
                }
                
                # menu_auth 문자열로 변환
                if( count( $this->page_data['menu_auth'] ) > 0 ){
                    $this->page_data['menu_auth'] = join(',', $this->page_data['menu_auth'] );
                }

                # 트랜잭션 시작
                $this->model->runTransaction();

                $update_data = [                              
                    'member_name' => $this->page_data['member_name']
                    ,'phone_no' => $this->page_data['phone_no']
                    ,'email' => $this->page_data['email']
                    ,'approval_auth' => $this->page_data['approval_auth']
                    ,'work_auth' => $this->page_data['work_auth']
                    ,'menu_auth' => $this->page_data['menu_auth']                    
                    ,'use_flag' => $this->page_data['use_flag']                    
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'edit_ip' => $this->getIP()
                ];

                if( empty( $this->page_data['password'] ) == false ) {
                    
                    # 회원 비밀번호 일치 확인
                    if( $this->page_data['password'] !== $this->page_data['re_password'] ) {
                        errorBack('비밀번호 값과 재입력 값이 일치하지 않습니다.');
                    }
                    
                    $update_data['password'] = hash_conv( $this->page_data['password'] );
                }

                $this->model->updateCompanyMember( $update_data ," company_member_idx = '" . $this->page_data['company_member_idx']. "'" );
               
               
                # 트랜잭션 종료
                $this->model->stopTransaction();


                movePage('replace', '저장되었습니다.', './'. $this->page_name .'_write?company_member_idx='. $this->page_data['company_member_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' : {

                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=                
                $this->issetParams( $this->page_data, [
                    'company_member_idx' 
                ]);

                # 트랜잭션 시작
                $this->model->runTransaction();

                $this->model->updateCompanyMember( ['del_flag'=>'Y'] ," company_member_idx = '" . $this->page_data['company_member_idx']. "'" );

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
     * 생산 담당자 등록 페이지를 생성한다.
     */
    public function production_member_list(){

        # 리스트 정보요청
        $list_result = $this->model->setProductionMember();
        
        $this->paging->total_rs = $list_result['total_rs'];        
        $this->page_data['paging'] = $this->paging;
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'production_member';
        $this->page_data['contents_path'] = '/company/production_member_list.php';
        $this->page_data['list'] = $list_result['rows'];                      

        //echoBr($list_result);

        //echoPre($this->page_data);
        //exit;

        $this->view( $this->page_data );                
    } 

    /**
     * 생산 담당자 수정 페이지를 생성한다
     * 11/16/20 kange Add 
     */
    public function production_member_write(){

        //Set Value Add
        $query_result = [];

        if( $this->page_data['mode'] == 'edit') {
        
            $this->issetParams( $this->page_data, ['production_member_idx']);
            $this->page_data['page_work'] = '수정';
            
            # 회원 정보
            $security_result = $this->model->getProductionMember( " production_member_idx = '". $this->page_data['production_member_idx'] ."' " );

            if( count( $security_result['row'] ) > 0  ) {
                $this->page_data = array_merge( $this->page_data, $security_result['row'] );
            } else {
                errorBack('해당 게시물이 삭제되었거나 정상적인 접근 방법이 아닙니다.');
            }

        } else {

            $this->page_data['mode'] = 'ins';
            $this->page_data['page_work'] = '등록';

        }

        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'production_member';
        $this->page_data['contents_path'] = '/company/production_member_write.php';
        $this->view( $this->page_data );        
    }

    /**
     * 생산담당자 데이터를 처리한다.
     * 11/16/20 kange Add
     */
    public function production_member_proc(){

        #post 접근 체크
        postCheck();

        $this->page_name = 'production_member';

        switch($this->page_data['mode']){
            case 'ins' :
            {

                //echoPre($this->page_data);
                //exit;

                // # 트랜잭션 시작
                $this->model->runTransaction();

                # 회원 비밀번호 일치 확인
                if( $this->page_data['password'] !== $this->page_data['re_password'] ) {
                    errorBack('비밀번호 값과 재입력 값이 일치하지 않습니다.');
                }

                $query_result = [
                    'name' => $this->page_data['name']
                    ,'phone_no' => $this->page_data['phone_no']
                    ,'password' => hash_conv( $this->page_data['password'] )
                    ,'work_position' => 1
                    ,'work_detail' => 1
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'health_certi_date' => $this->page_data['health_certi_date']
                    ,'reg_date' => 'NOW()'
                    ,'use_flag' => 'Y'
                    ,'del_flag' => 'N'
                ];

                $this->model->insertProductionMember($query_result);

                # 트랜잭션 종료
                $this->model->stopTransaction();

                movePage('replace', '저장되었습니다.', './production_member_list?top_code=' . $this->page_data['top_code'] . '&left_code=' .$this->page_data['left_code']  );

                break;
            }
            case 'edit' :
            {

                //echoPre($this->page_data);
                //exit;

                # 트랜잭션 시작
                $this->model->runTransaction();

                $update_data = [
                    'name' => $this->page_data['name']
                    ,'phone_no' => $this->page_data['phone_no']
                    ,'password' => hash_conv( $this->page_data['password'] )
                    ,'work_position' => $this->page_data['work_position']
                    ,'work_detail' => $this->page_data['work_detail']
                    ,'reg_idx' => getAccountInfo()['idx']
                    ,'edit_idx' => getAccountInfo()['idx']
                    ,'edit_date' => 'NOW()'
                    ,'health_certi_date' => $this->page_data['health_certi_date']
                    ,'reg_date' => 'NOW()'
                    ,'use_flag' => 'Y'
                    ,'del_flag' => 'N'
                ];

                //echoPre($this->page_data);
                //exit;

//                if( empty( $this->page_data['password'] ) == false ) {
//
//                    # 회원 비밀번호 일치 확인
//                    if( $this->page_data['password'] !== $this->page_data['re_password'] ) {
//                        errorBack('비밀번호 값과 재입력 값이 일치하지 않습니다.');
//                    }
//
//                    $update_data['password'] = hash_conv( $this->page_data['password'] );
//                }


                $this->model->updateProductionMember( $update_data ," production_member_idx = '" . $this->page_data['production_member_idx']. "'" );


                # 트랜잭션 종료
                $this->model->stopTransaction();


                movePage('replace', '저장되었습니다.', './'. $this->page_name .'_write?production_member_idx='. $this->page_data['production_member_idx']. '&mode=edit' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );
                //movePage('replace', '저장되었습니다.', './'. $this->page_name .'_list?page=1' . htmlspecialchars_decode( $this->page_data['ref_params'] ) );

                break;
            }
            case 'del' :
            {
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                # 필수값 체크
                #+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
                $this->issetParams( $this->page_data, [
                    'production_member_idx'
                ]);

                # 트랜잭션 시작
                $this->model->runTransaction();

                $this->model->updateProductionMember( ['del_flag'=>'Y'] ," production_member_idx = '" . $this->page_data['production_member_idx']. "'" );

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

    /*
    * 납품기업업체 목록을 생성한다 
    */ 
    public function vendor_list(){        
                
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'vendor';
        $this->page_data['contents_path'] = '/materials/vendor_list.php';        
        $this->view( $this->page_data );

    }

    /**
     * 기업정보 작성 페이지를 구성한다.
     */
    public function vendor_write(){
        
        $this->page_data['use_top'] = true;        
        $this->page_data['use_left'] = true;
        $this->page_data['use_footer'] = true;        
        $this->page_data['page_name'] = 'vendor';
        $this->page_data['contents_path'] = '/materials/vendor_write.php';        
        $this->view( $this->page_data );

    }

}

?>