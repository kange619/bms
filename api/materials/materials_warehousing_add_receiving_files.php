<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 원부자재 납품서류 업로드 처리 v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 원부자재 납품서류 업로드 처리를 진행한다.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 * 
 * [v1.0.0] 2020.03.26 - 이정훈
 *  - 원부자재 납품서류 업로드 처리
 * 
 * ---------------------------------------------------
*/

#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 헤더 체크
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
checkHeaders();


#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# SET Values
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
$result = [];

$result['status'] = "success";
$result['msg'] = '';
$result['doc_files'] = [];

$model_materals = $_aqua->new('materialsModel');
$file_manager = $_aqua->new('fileUploadHandler');         
$model_auth = $_aqua->new('authModel');         

if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;
	$result .= '	* order_idx : 주문번호'.PHP_EOL;	
	$result .= '	* member_no : 회원번호'.PHP_EOL;	
	$result .= '	* file_title[] : 서류명'.PHP_EOL;	
	$result .= '	* doc_file[] : 파일'.PHP_EOL;	
	$result .= '	 del_file_idx : 삭제할 파일키'.PHP_EOL;	
	$result .= '//////////////////////////////// RESPONSE //////////////////////////////// '.PHP_EOL;
	$result .= '	status : success - 성공 / fail - 필수값 누락 등의 문제로 진행불가 / error - 서버 시스템 오류 '.PHP_EOL;	
    $result .= '	,msg : 처리 결과 간략글  '.PHP_EOL;    
    $result .= '	,doc_files : [{  '.PHP_EOL;
    $result .= '	    file_idx : 파일키  '.PHP_EOL;
    $result .= '	   ,file_title : 서류명  '.PHP_EOL;
    $result .= '	   ,file_server_name : 서버 파일명  '.PHP_EOL;
    $result .= '	   ,file_origin_name : 사용자 파일명  '.PHP_EOL;
    $result .= '	   ,path : 저장경로  '.PHP_EOL;
    $result .= '	,}]  '.PHP_EOL;
    
	exit( $result );
} 

issetParams( $params, [
    'order_idx'
    ,'member_no'
]);


# 회원 로그인 처리
$login_state = $model_auth->loginApp( $params['member_no'] );

if( $login_state['return_data']['num_rows'] > 0 ) {
    # 로그인 처리

    $set_info['idx'] = $login_state['return_data']['row']['company_member_idx'];
    $set_info['name'] = $login_state['return_data']['row']['member_name'];
    $set_info['work_auth'] = $login_state['return_data']['row']['work_auth'];
    $set_info['menu_auth'] = $login_state['return_data']['row']['menu_auth'];
    $set_info['approval_auth'] = $login_state['return_data']['row']['approval_auth'];
    $set_info['phone_no'] = $login_state['return_data']['row']['phone_no'];
    $set_info['email'] = $login_state['return_data']['row']['email'];
    $set_info['root_page'] = $root_page;

    # 세션등록처리
    setAccountSession( $set_info );

} else {

    $result['status'] = 'success'; 
    $result['msg'] = '일치하는 회원정보가 존재하지 않습니다.'; 
    jsonExit( $result );

}

#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# 파일 업로드
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=  
$file_manager->path = UPLOAD_MATERIALS_ORDER;
$file_manager->file_element = 'doc_file';
$file_manager->table_data = [
    'insert'=> [
        'tb_name' => 't_materials_order'                        
        ,'where_used' => 'receiving_doc'
        ,'tb_key' => $params['order_idx']
    ]
];
$file_manager->set_file_title = $params['file_title'];
$file_manager->fileUpload();
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
# // 파일 업로드
#+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=     

if( $params['del_file_idx'] ){
    $file_manager->dbDeleteHandler( " idx IN ( ". $params['del_file_idx'] ." ) " );
}

 # 파일 정보            
 $file_result = $file_manager->dbGetFile("
    tb_key = '". $params['order_idx'] ."'
    AND where_used = 'receiving_doc'
    AND tb_name = 't_materials_order'
");

$result['status'] = 'success'; 

foreach( $file_result['rows'] AS $idx=>$rows ){

    $result['doc_files'][$idx]['file_idx'] = $rows['idx'];
    $result['doc_files'][$idx]['file_title'] = $rows['file_title'];
    $result['doc_files'][$idx]['file_server_name'] = $rows['server_name'];
    $result['doc_files'][$idx]['file_origin_name'] = $rows['origin_name'];
    $result['doc_files'][$idx]['path'] = $rows['path'];

}

jsonExit( $result );

?>