<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    협력업체 정보  <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./company_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="material_company_idx" value="<?=$material_company_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="materials_usage_del_idx" id="materials_usage_del_idx" value="" />
                <input type="hidden" name="del_file_idx" id="del_file_idx" value="" />

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
                                            <input class="form-control" type="text" id="zip_code" name="zip_code" value="<?=$zip_code?>" maxlength="6" readonly="readonly"style="width:80px !important " /> 
                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-10" onclick="findAddress()">주소찾기</button>
                                            <br><br>
                                            <input class="form-control" type="text" id="addr" name="addr" value="<?=$addr?>" readonly="readonly" style="width:80% !important " />
                                            <br><br>
                                            <input class="form-control" type="text" id="addr_detail" name="addr_detail" placeholder="상세주소" value="<?=$addr_detail?>" style="width:80% !important " />
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

            <!-- 파일 정보  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>규격서</b>
                                <button type="button" class="btn btn-sm btn-default waves-effect w-md m-l-30" style="top:-4px;" onclick="showSpecificationHistory()">이력보기</button>
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="addDocForm()">추가</button>
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
										<th class="info" >품목명</th>										
										<th class="info" style="width:500px" >파일찾기</th>										
										<th class="info" style="width:150px" >삭제</th>
									</tr>
								</thead>
								<tbody id="add_file_area">									
                                    
									
                                </tbody>
							</table>


                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 파일 정보 -->

            <!-- 제조식품 유형선택  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>납품 재료</b>     
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="addForm()">추가</button>               
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
										<th class="info" style="width:150px">종류</th>
                                        <th class="info">품목</th>
										<th class="info">자재명</th>										
                                        <th class="info">원산지</th>
										<th class="info">단위</th>
										<th class="info">규격</th>
										<th class="info">단가(원)</th>										
										<th class="info" style="width:150px">삭제</th>
									</tr>
								</thead>
								<tbody id="material_add_area">
                                    
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


<!-- 원자재 목록 레이어  -->
<div id="search_raw_material_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0" style="width:800px" >
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">원자재 목록</h3>
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <input type="hidden" id="current_opener" />
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 20%;">선택</th>
                                        <th class="info" style="width: 40%;">품목</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $raw_materials ) > 0  ){
                                            foreach( $raw_materials AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td class="text-center vertical-align">
                                            <button type="button" class=" btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceMaterial(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
                                        </td>                                        
                                        <td class="text-center vertical-align"><?=$item['material_name']?></td>
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td colspan="4" class="text-center">
                                            정보가 없습니다.
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                                    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- // 원자재 목록 레이어  -->

<!-- 부자재 목록 레이어  -->
<div id="search_sub_material_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0" style="width:800px" >
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">부자재 목록</h3>
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <input type="hidden" id="current_opener" />
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 20%;">선택</th>
                                        <th class="info" style="width: 40%;">품목</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $sub_materials ) > 0  ){
                                            foreach( $sub_materials AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td class="text-center vertical-align">
                                            <button type="button" class=" btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceMaterial(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
                                        </td>                                        
                                        <td class="text-center vertical-align"><?=$item['material_name']?></td>
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td colspan="4" class="text-center">
                                            정보가 없습니다.
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                                    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- // 부자재 목록 레이어  -->

<!-- 규격서 기록 레이어  -->
<div id="material_specification_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0" style="width:800px" >
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">규격서 이력보기</h3>
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 30%;">품목명</th>
                                        <th class="info" style="width: 70%;">파일</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $material_specification_log ) > 0  ){
                                            foreach( $material_specification_log AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >                                                                             
                                        <td class="text-center vertical-align"><?=$item['file_title']?></td>
                                        <td class="text-center vertical-align">
                                            <a href="/file_down.php?key=<?=$item['idx']?>" ><?=$item['origin_name']?></a>
                                        </td>                                        
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td colspan="2" class="text-center">
                                            이력이 없습니다.
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                                    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- // 규격서 기록 레이어  -->


<script>

    var current_opener = '';

    $(function(){
        
        makeMaterialRatios();
        makeFilesHandler();

        $('.select_meterial_type').on('change', meterialTypeActionHandler );

    })

    /**
        납품재료 자재 종류 select box change 이벤트 처리
     */
    function meterialTypeActionHandler(){
        
        current_opener = this;
        $('#search_'+ $(this).val() +'_material_modal').modal();
        
    }

    function choiceMaterial( arg_this ) {       

        var data = JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );

        $( current_opener ).parent().parent().find('input[name="material_idx[]"]').val( data.material_idx );        
        $( current_opener ).parent().parent().find('input[name="product_name[]"]').val( data.material_name );
        $( current_opener ).parent().parent().find('input[name="material_name[]"]').val( data.material_name );
        $( current_opener ).parent().parent().find('input[name="standard_info[]"]').val( data.net_contents );

        $('#search_raw_material_modal').modal('hide');
        $('#search_sub_material_modal').modal('hide');

    }

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
        포장단위 추가버튼 동작
     */
     function addForm(){ 

        var empty_data = [{materials_usage_idx:'', material_kind: '', material_code: '', material_name: '', country_of_origin: '', material_unit: 1, standard_info: '' ,material_unit_price:'' }];

        $('#material_add_area').append( $('#tmplate_material_add_area_form').tmpl( empty_data ) );

        $('.select_meterial_type').off('change', meterialTypeActionHandler );
        $('.select_meterial_type').on('change', meterialTypeActionHandler );
        
        
     }

     /**
      * 포장단위 목록 생성
      */
     function makeMaterialRatios(){

         var materials_arr = <?=$materials?>;

         if( typeof( materials_arr ) == 'object' ) {

            $('#material_add_area').html( $('#tmplate_material_add_area_form').tmpl( materials_arr ) );

         }

     }

     /**
      * 포장단위 삭제
      */
     function delForm( arg_this, arg_materials_usage_idx ){

        var materials_usage_del_idx = $('#materials_usage_del_idx').val();

        if( materials_usage_del_idx == '') {
            materials_usage_del_idx = [];
        } else {
            materials_usage_del_idx = materials_usage_del_idx.split(',');
        }

        if( arg_materials_usage_idx !== '' ) {

            materials_usage_del_idx.push( arg_materials_usage_idx );

            $('#materials_usage_del_idx').val( materials_usage_del_idx.join(',') );
        }

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
                console.log( data );

                if( data.postcode1 == '' ) {
                    $("#zip_code").val( data.zonecode );
                } else {
                    $("#zip_code").val(data.postcode1+"-"+data.postcode2);
                }
                
                $("#addr").val(data.address);
                $("#addr_detail").focus();
            }
        }).open();
    }

    /**
        저장된 규격서 정보 dom 생성
     */
    function makeFilesHandler(){

        var files = <?=$material_specification_info?>;
        var file_idx = [];
        var data = [];
        
        $.each(files, function(idx, item){

            file_idx.push(item.idx);
            
            data.push({
                file_idx : item.idx
                ,file_title : item.file_title
                , file_origin_name : item.origin_name
                , file_server_name : item.server_name
            });
        });
        
        console.log( data );

        $('#file_idx').val(file_idx.join(','));

        $('#add_file_area').append( $('#tmplate_add_file_form').tmpl( data ) );

    }

    /**
        규격서 양식 추가
     */
    function addDocForm(){

        var empty_data = [{file_title: '',  file_origin_name : '' }];

        $('#add_file_area').append( $('#tmplate_add_file_form').tmpl( empty_data ) );

    }

    /**
    * 규격서 파일 form 삭제
    */
    function delDocForm( arg_this, arg_del_file_idx ){

        var get_del_file_idx = $('#del_file_idx').val();
        var del_file_idx_arr, result_val;

        if( get_del_file_idx == '' ) {

            $('#del_file_idx').val( arg_del_file_idx );

        } else {

            if( get_del_file_idx.indexOf(',') > -1 ) {
                
                del_file_idx_arr = get_del_file_idx.split(',');
                del_file_idx_arr.push( arg_del_file_idx );
                result_val = del_file_idx_arr.join(',');

            } else {
                result_val = get_del_file_idx+','+arg_del_file_idx;
            }
            
            $('#del_file_idx').val(result_val);

        }

        $( arg_this ).parent().parent().remove();

    }

    //  업로드 버튼 이벤트 처리
    function readFile(arg_this) {

        if (arg_this.files && arg_this.files[0]) {

            if(window.FileReader){  // modern browser
                var filename = $(arg_this)[0].files[0].name;
            } 
            else {  // old IE
                var filename = $(arg_this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
            }
            
            $(arg_this).parent().find('code').text(filename);   

            if( $(arg_this).data('fild_idx') !== '') {

                var get_del_file_idx = $('#del_file_idx').val();
                var del_file_idx_arr, result_val;

                if( get_del_file_idx == '' ) {

                    $('#del_file_idx').val( $(arg_this).data('fild_idx') );

                    } else {

                    if( get_del_file_idx.indexOf(',') > -1 ) {
                        
                        del_file_idx_arr = get_del_file_idx.split(',');
                        del_file_idx_arr.push( $(arg_this).data('fild_idx') );
                        result_val = del_file_idx_arr.join(',');

                    } else {
                        result_val = get_del_file_idx+','+$(arg_this).data('fild_idx');
                    }

                    $('#del_file_idx').val(result_val);

                }
            }
        }
    }

    function showSpecificationHistory(){
        $('#material_specification_modal').modal();
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
<script id="tmplate_material_add_area_form" type="text/x-jquery-tmpl">
<tr>     
    <td>
        <input type="hidden" name="materials_usage_idx[]" value="${materials_usage_idx}"  >
        <select class="form-control width100 select_meterial_type " name="material_kind[]" >
            <option value="" {{if "" === material_kind }}selected="selected"{{/if}} >선택</option>
            <option value="raw" {{if "raw" === material_kind }}selected="selected"{{/if}} >원자재</option>
            <option value="sub" {{if "sub" === material_kind }}selected="selected"{{/if}} >부자재</option>
        </select>
        <input type="hidden" name="material_idx[]" value="${material_idx}"  >
    </td>
    <td><input type="text" name="material_name[]" class="form-control " placeholder="품목" value="${material_name}" readonly="readonly" style="min-width:150px" ></td>
    <td><input type="text" name="product_name[]" class="form-control " placeholder="자재명" value="${product_name}" style="min-width:150px" ></td>
    <td><input type="text" name="country_of_origin[]" class="form-control " placeholder="원산지" value="${country_of_origin}" style="min-width:150px" ></td> 
    <td><input type="text" name="material_unit[]" class="form-control " placeholder="" value="${material_unit}" readonly="readonly" style="min-width:150px" ></td> 
    <td><input type="text" name="standard_info[]" class="form-control " placeholder="kg/g/L/ml" value="${standard_info}" style="min-width:150px" ></td> 
    <td><input type="text" name="material_unit_price[]" class="form-control " placeholder="" value="${material_unit_price}" style="min-width:150px" ></td> 
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this, '${materials_usage_idx}')">삭제</button></td>
</tr>
</script>


<script id="tmplate_add_file_form" type="text/x-jquery-tmpl">
<tr>
    <td><input type="text" name="file_title[]" class="form-control " value="${file_title}" style="width:100% !important" data-valid="blank" ></td>    
    <td>
        <div class="form-group">                                                
            <div class="upload-btn-wrapper">
                <button type="button" class="btn btn-primary">업로드</button>
                <input type="file" name="doc_file[]" onchange="readFile(this);" style="width:120px !important;height:50px" data-fild_idx="${file_idx}" >                                                    
                <code class="control-label m-l-10"></code>
            </div>

            {{if file_origin_name }}
            <br/><br/><a href="/file_down.php?key=${file_idx}" >${file_origin_name}</a>
            {{/if}}        

        </div>
    </td>										
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delDocForm(this,'${file_idx}' )"  >삭제</button></td>
</tr>
</script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
