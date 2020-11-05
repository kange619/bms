<?php 
# 세팅될 설정파일

$_aqua_config = [];

# 설정 파일을 읽어드린다. 
$masic_solution_init_path = $_SERVER['DOCUMENT_ROOT']. "/init.json";

// $get_file = fopen( $file_path, "r") or die("서비스를 시작 할 수 없습니다. 서버 관리자에게 문의하세요");
$get_file = @fopen( $masic_solution_init_path, "r");

if( $get_file ) {
    
    $get_file_content = fread( $get_file, filesize( $masic_solution_init_path ));
    
    fclose($get_file);
    $get_file = '';

    # 배열 형태로 변환한다.
    $init_file_arr = json_decode( $get_file_content, true );

    if( $init_file_arr['masicgong_service'] === true ) {
        # 서버 통신 시도

        $request = [
            CURLOPT_URL => 'http:'. $init_file_arr['define']['MASICGONG_DOMAIN'] . '/get_service_status.php'
            ,CURLOPT_POST => true
            ,CURLOPT_RETURNTRANSFER => true
            ,CURLOPT_CONNECTTIMEOUT => 10
            ,CURLOPT_TIMEOUT => 10
            ,CURLOPT_HTTPHEADER => [
                 'Pragma: no-cache'
                , 'Accept: */*'
                , 'Content-Type: application/json'
                , 'masicgong_auth_id : ' . $init_file_arr['masicgong_auth_id']
                , 'masicgong_auth_token : ' . $init_file_arr['masicgong_auth_token']
            ]
        ];

        $request_ping = curl_init(); 
        curl_setopt_array($request_ping, $request); 
        $request_result = curl_exec($request_ping);

		if( curl_getinfo( $request_ping )['http_code'] == 200 ) {

            if( empty( $request_result ) == true ){
                exit('서비스에 문제가 발생하였습니다');
            }

            $response_data = json_decode( $request_result , true ); 
            
            switch( $response_data['status'] ) {

                case 'success' : {
                    
                    if( $response_data['code'] == 'update' ) {
                        
                        if( empty( $response_data['update_info'] ) === false ) {
                            
                            # update_info 데이터를 대입한다.
                            $init_file_arr = $response_data['update_info'];
    
                            # 파일 정보를 업데이트 한다.
                            $update_file = @fopen( $masic_solution_init_path, "w");
                            
                            fwrite($update_file, json_encode( $response_data['update_info'], JSON_UNESCAPED_UNICODE ) );
                            fclose($update_file);
                            $update_file = '';
                            
                        }
                        
                    }
    
                    break;
                }
                case 'fail' : {
                    # 서비스 기간 종료 - 솔루션에서 아무 동작 하지 않음
                    break;
                }
                case 'error' : {                
                    # 마식공 서버에서 에러 발생 - 솔루션에서 아무 동작 하지 않음
                    break;
                }
            }

		} else {
            $response_data['status'] = 'error';
		}

        curl_close($request_ping);

    }


    $_aqua_config = $init_file_arr['config'];
    
    foreach( $init_file_arr['define'] AS $key=>$val ){        
        define($key, $val);
    }
    
} else {

    # 파일이 없으므로 에러 페이지 노출
    include_once($_SERVER['DOCUMENT_ROOT']."/aqua/views/html_errors/503_solution.html");
    exit;
}

?>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/aqua/_system/aqua.php"); ?>