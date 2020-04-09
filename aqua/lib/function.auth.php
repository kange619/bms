<?php
    
    /**
     * 로그인 세션 초기화 확인
     */
    function loginState(){

        if( isset( $_SESSION[ 'account_info' ] ) == false && ( empty( apache_request_headers()['access_id'] ) == true ) ){

            $rtn_page = urlencode( $_SERVER['REQUEST_URI'] );

            movePage('replace', '', '/auth/login?rtn_page='. $rtn_page );

        }
    }

    /**
     * 로그인 정보 저장
     */
    function setAccountSession( $arg_info_data ){

        $_SESSION[ 'account_info' ] = $arg_info_data;

    }

    /**
     * 로그인 정보 반환 
     */
    function getAccountInfo(){
        return $_SESSION[ 'account_info' ];
    }

    /**
     * 로그아웃
     */
    function logoutProc(){
        session_destroy();
    }

    /**
     * post 요청 확인
     */
    function postCheck(){

        if( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
            errorBack('잘못된 접근입니다.');
        }

    }

    /**
     * 암호와 스트링 변환
     */
    function hash_conv($value) {
		return hash('sha256', $value);
    }
    
    /**
     * 작업 권한 확인
     */
    function checkWorkAuth( $arg_work ){
        if( strpos( getAccountInfo()['work_auth'], $arg_work ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 작업 승인 권한 확인
     */
    function checkApprovalAuth( $arg_work ){        
        if( ( strpos( getAccountInfo()['work_auth'], $arg_work ) ) && ( ( getAccountInfo()['approval_auth'] === 'leader' ) || ( getAccountInfo()['approval_auth'] === 'ceo' ) ) ) {
            return true;
        } else {
            return false;
        }
    }

?>