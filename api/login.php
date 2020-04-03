<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 로그인 체크 v1.0.1
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.1]
 * - 로그인 처리를 한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 * 
 * [v1.0.1] 2020.03.24 - 이정훈
 *  - 서비스 메뉴 항목 반환 추가
 * 
 * [v1.0.0] 2020.03.23 - 이정훈
 *  - 로그인 처리
 * 
 * ---------------------------------------------------
*/

#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# SET Values
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
$result = [];
$model_auth = $_aqua->new('authModel');
$model_company = $_aqua->new('companyModel');


if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;
	$result .= '	* id : 아이디 '.PHP_EOL;
	$result .= '	* pw : 비밀번호 '.PHP_EOL;
    $result .= '	* user_token : token 값 '.PHP_EOL;
    $result .= '	* app_id : AOS : package name / IOS : bundle id '.PHP_EOL;
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	msg : 처리 결과 간략글  '.PHP_EOL;
    $result .= '	account_info : {  '.PHP_EOL;
    $result .= '	    member_no : 회원번호  '.PHP_EOL;
    $result .= '	    ,name : 이름  '.PHP_EOL;
    $result .= '	    ,work_auth : 작업권한  '.PHP_EOL;
    $result .= '	    ,menu_auth : 메뉴 접근 권한  '.PHP_EOL;
    $result .= '	    ,approval_auth : 승인 권한  '.PHP_EOL;
    $result .= '	    ,email : 이메일  '.PHP_EOL;
    $result .= '	}  '.PHP_EOL;
    $result .= '	,company_info : {  '.PHP_EOL;
    $result .= '	    company_no : 기업번호  '.PHP_EOL;
    $result .= '	    ,company_name : 기업명  '.PHP_EOL;
    $result .= '	    ,registration_no : 사업자등록번호  '.PHP_EOL;
    $result .= '	    ,ceo_name : 대표명  '.PHP_EOL;    
    $result .= '	}  '.PHP_EOL;
    $result .= '	,access_auth_info : {  '.PHP_EOL;
    $result .= '	    masicgong_auth_id : 사업자등록번호  '.PHP_EOL;
    $result .= '	    ,masicgong_auth_token : 접근토큰  '.PHP_EOL;
    $result .= '	}  '.PHP_EOL;
    $result .= '	,service_menu_info : [{  '.PHP_EOL;
    $result .= '	    menu_code : 메뉴코드  '.PHP_EOL;
    $result .= '	    ,menu_title : 메뉴명  '.PHP_EOL;
    $result .= '	}]  '.PHP_EOL;

    
	exit( $result );
} 


#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 필수값 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=

if( empty( $params['id'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : id';
	jsonExit( $result );
}

if( empty( $params['pw'] ) == true ) {
	$result['status'] = 'fail';
	$result['msg'] = '필수값 누락 : pw';
	jsonExit( $result );
}

$params['pw'] = hash_conv( $params['pw'] ); 

# 계정정보
$login_state = $model_auth->loginProc( $params );

if( $login_state['state'] == true ){

    $result['account_info']['member_no'] = $login_state['return_data']['row']['company_member_idx'];
    $result['account_info']['name'] = $login_state['return_data']['row']['member_name'];
    $result['account_info']['work_auth'] = $login_state['return_data']['row']['work_auth'];
    $result['account_info']['menu_auth'] = $login_state['return_data']['row']['menu_auth'];
    $result['account_info']['approval_auth'] = $login_state['return_data']['row']['approval_auth'];
    $result['account_info']['email'] = $login_state['return_data']['row']['email'];

    # 회사정보
    $company_idx = $login_state['return_data']['row']['company_idx'];
    
    $return_reqeust = requestApi([
        'request_api' => 'get_company_info.php'
        ,'request_data' => [
            'company_idx' => $company_idx            
        ]
    ]);

    if( $return_reqeust['status'] == 'success' ) {

        $result['company_info']['company_no'] = $return_reqeust['data']['company_info']['company_idx'];
        $result['company_info']['company_name'] = $return_reqeust['data']['company_info']['company_name'];
        $result['company_info']['registration_no'] = $return_reqeust['data']['company_info']['registration_no'];
        $result['company_info']['ceo_name'] = $return_reqeust['data']['company_info']['ceo_name'];

    } else {
        $result['status'] = 'error';
        $result['msg'] = '서버통신 에러 - 회사 정보요청에 실패했습니다.';
        jsonExit( $result );
    }

    
    # 계약정보 - 토큰 값 확인
    
    $return_reqeust = requestApi([
        'request_api' => 'get_contract_info.php'
        ,'request_data' => [
            'company_idx' => $company_idx
            ,'service_code' => 'SV002'            
        ]
    ]);

    if( $return_reqeust['status'] == 'success' ) {

        $result['access_auth_info']['masicgong_auth_id'] = $result['company_info']['registration_no'];
        $result['access_auth_info']['masicgong_auth_token'] = $return_reqeust['data']['service_info']['auth_token'];

        $item_codes = $return_reqeust['data']['service_info']['service_items'];

        if( empty( $item_codes ) == false ) {

            $return_reqeust = requestApi([
                'request_api' => 'get_contract_items.php'
                ,'request_data' => [
                    'item_codes' => $item_codes                
                ]
            ]);

            if( $return_reqeust['status'] == 'success' ) {                
                
                foreach( $return_reqeust['data']['service_info'] AS $idx=>$val ) {
                    
                    $result['service_menu_info'][$idx]['menu_code'] = $val['item_code'];
                    $result['service_menu_info'][$idx]['menu_title'] = $val['title'];    
                }
 
            } else {
                $result['status'] = 'error';
                $result['msg'] = '서버통신 에러 - 서비스 이용항목 정보요청에 실패했습니다.';
                jsonExit( $result );
            }

        } else {

            $result['status'] = 'error';
            $result['msg'] = '이용중인 서비스 정보가 존재하지 않아 앱을 이용할 수 없습니다.';
            jsonExit( $result );
            
        }
        

    } else {
        $result['status'] = 'error';
        $result['msg'] = '서버통신 에러 - 회사 정보요청에 실패했습니다.';
        jsonExit( $result );
    }

    # 토큰 값 업데이트
    if( empty( $params['user_token'] ) == false ){
        $model_company->updateCompanyMember([ 
            'app_token' => $params['user_token'] 
            ,'app_id' => $params['app_id'] 
        ], " company_member_idx = '". $result['account_info']['member_no'] ."' " );
    }

    $result['status'] = 'success';
    jsonExit( $result );

} else {
    $result['status'] = 'fail';
	$result['msg'] = '일치하는 정보가 없습니다.';
	jsonExit( $result );
}




?>