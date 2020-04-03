<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    고객사정보 정보  <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="client_idx" value="<?=$client_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="page_name" value="<?=$page_name?>" />
            

            <!-- 기본정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>기본정보</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>                                    
                                    <tr>
                                        <th class="info middle-align">회사명</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_name" name="company_name" value="<?=$company_name?>" data-valid="str" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">사업자등록번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="registration_no" name="registration_no" maxlength="10" value="<?=$registration_no?>"  />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">대표명</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="ceo_name" name="ceo_name" value="<?=$ceo_name?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">전화번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_tel" name="company_tel" placeholder="'-'없이 입력하세요"  maxlength="11" value="<?=$company_tel?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">팩스번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_fax" name="company_fax" placeholder="'-'없이 입력하세요" maxlength="11" value="<?=$company_fax?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">홈페이지</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_homepage" name="company_homepage" value="<?=$company_homepage?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">주소</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="client_zip_code" name="client_zip_code" value="<?=$client_zip_code?>" maxlength="6" readonly="readonly"style="width:80px !important " /> 
                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-10" onclick="findAddress()">주소찾기</button>
                                            <br><br>
                                            <input class="form-control" type="text" id="client_addr" name="client_addr" value="<?=$client_addr?>" readonly="readonly" style="width:80% !important " />
                                            <br><br>
                                            <input class="form-control" type="text" id="client_addr_detail" name="client_addr_detail" placeholder="상세주소" value="<?=$client_addr_detail?>" style="width:80% !important " />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">사용여부</th>
                                        <td colspan="3">

                                            <select class="form-control" name="use_flag" id="use_flag" style="width:200px" >
                                               
                                                <option value="Y" <?=($use_flag == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($use_flag == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                                
                                            </select>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //기본정보 -->
            
            <!-- 신규 담당자 정보 입력  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>담당자 정보</b>
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
                                        <th class="info middle-align">이름</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="manager_name" name="manager_name" value="<?=$manager_name?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">휴대폰 번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="manager_phone_no" name="manager_phone_no" placeholder="'-'없이 입력하세요" maxlength="11" value="<?=$manager_phone_no?>"  />  
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">이메일</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="manager_email" name="manager_email" value="<?=$manager_email?>" />
                                        </td>
                                    </tr>

                                    

                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 신규 담당자 정보 입력  -->
            <!-- 제조식품 유형선택  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>주소지 관리</b>     
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="addForm()">추가</button>               
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
										<th class="info" style="width:250px" >주소지명</th>
                                        <th class="info" style="width:120px" >주소찾기</th>
                                        <th class="info" style="width:80px" >우편번호</th>
										<th class="info">주소</th>										
                                        <th class="info" style="width:200px">상세주소</th>										
										<th class="info" style="width:150px">삭제</th>
									</tr>
								</thead>
								<tbody id="addr_add_area">
                                    
                                </tbody>
							</table>

                            
                        </div> 
                        
                    </div>

                </div>
            </div>
            <!-- // 제조식품 유형선택  -->

            </form>

            <div class="row"> 
                <div class="col-lg-12">
                    <?php
                        if($mode == 'edit') {
                    ?>
                    <button type="button" class="pull-left btn btn-danger waves-effect w-md m-l-5" onclick="delProc()">삭제</button> 
                    <?php
                        }
                    ?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->



<script>

    var current_opener = '';

    $(function(){
        
        makeComapanyAddrs();


    })

   

    /**
        삭제 버튼 동작
     */
    function delProc(){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#mode').val('del');            
            $('#form_write').submit();
        }

    }

    /**
        주소지 추가버튼 동작
     */
     function addForm(){ 

        var empty_data = [{addr_name: '', zipcode: '', addr: '', addr_detail: '' }];

        $('#addr_add_area').append( $('#tmplate_addr_add_area_form').tmpl( empty_data ) );
 
        
     }

     /**
      * 주소지 목록 생성
      */
     function makeComapanyAddrs(){

         var company_addrs = <?=$company_addrs?>;

         if( typeof( company_addrs ) == 'object' ) {

            $('#addr_add_area').html( $('#tmplate_addr_add_area_form').tmpl( company_addrs ) );

         }

     }

     /**
      * 주소지 삭제
      */
     function delForm( arg_this ){
        $( arg_this ).parent().parent().remove();
     }
    

    /**
     * 저장 버튼 동작
     */
    function register(){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {
            // submit
            $('#form_write').submit();
        }

    }

    /**
     * 주소검색
     */
    function findAddress() {
        new daum.Postcode({
            oncomplete: function(data) {
                // console.log( data );

                if( data.postcode1 == '' ) {
                    $("#client_zip_code").val( data.zonecode );
                } else {
                    $("#client_zip_code").val(data.postcode1+"-"+data.postcode2);
                }
                
                $("#client_addr").val(data.address);
                $("#client_addr_detail").focus();
            }
        }).open();
    }


    /**
     * 주소검색
     */
    function findClientAddrs( arg_this ) {
        new daum.Postcode({
            oncomplete: function(data) {
                console.log( data );
                var zipcode = $(arg_this).parent().parent().find('input[name="zipcode[]"]');
                var zipcode_text = $(arg_this).parent().parent().find('.addr_zipcode_area');
                var addr = $(arg_this).parent().parent().find('input[name="addr[]"]');
                var addr_detail = $(arg_this).parent().parent().find('input[name="addr_detail[]"]');
                if( data.postcode1 == '' ) {
                    $(zipcode).val( data.zonecode );
                    $(zipcode_text).html( data.zonecode );
                } else {
                    $(zipcode).val(data.postcode1+"-"+data.postcode2);
                    $(zipcode_text).html(data.postcode1+"-"+data.postcode2);
                }
                
                $(addr).val(data.address);
                $(addr_detail).focus();
            }
        }).open();
    }

</script>

<style>    
    .table>tbody>tr>th.info {
        width: 15%;
    }
    table input {
        width: 40% !important; display: inline-block !important;
    }
</style>
<script id="tmplate_addr_add_area_form" type="text/x-jquery-tmpl">
<tr>     
    <td>
        <input type="text" name="addr_name[]" class="form-control " placeholder="주소지명" value="${addr_name}" data-valid="blank" style="width:100% !important" >
    </td>
    <td>        
        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-10" onclick="findClientAddrs(this)">주소찾기</button>
    </td>
    <td>
        <span class="addr_zipcode_area" ></span>
        <input type="hidden" name="zipcode[]" value="${zipcode}" >
    </td>
    <td>
        <input type="text" class="form-control " name="addr[]"  placeholder="주소" value="${addr}" data-valid="blank" style="width:100% !important" >
    </td>
    <td>
        <input type="text" class="form-control " name="addr_detail[]"  placeholder="상세주소" value="${addr_detail}" style="width:100% !important" >
    </td> 
    
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this)">삭제</button></td>
</tr>
</script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
