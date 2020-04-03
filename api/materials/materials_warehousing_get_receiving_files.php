<?php include_once($_SERVER['DOCUMENT_ROOT']."/api/common/common.php"); ?>
<?php
/**
 * ---------------------------------------------------
 * AQUA Framework API 원부자재 납품서류 목록 반환  v1.0.0
 * ---------------------------------------------------
 * 설명
 * ---------------------------------------------------
 * 
 * [v1.0.0]
 * - 원부자재 납품서류 항목 반환.
 * 
 * ---------------------------------------------------
 * History
 * ---------------------------------------------------
 * 
 * [v1.0.0] 2020.03.26 - 이정훈
 *  - 원부자재 납품서류 항목 반환.
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

if( $params['manual']  ) {

	$result = '//////////////////////////////// REQUEST ////////////////////////////////' . PHP_EOL;
	$result .= '	* order_idx : 주문번호'.PHP_EOL;		
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
]);

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