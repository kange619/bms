<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    제품정보관리 > 제품 정보 <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="product_idx" value="<?=$product_idx?>" />                
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="product_unit_del_idx" id="product_unit_del_idx" value="" />


            <!-- 제품정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>제품정보</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
										<th class="info">식품유형</th>
                                        <td class="text-left" colspan="3">
                                            <select class="form-control" name="food_code" style="width:30%" >
                                                <?php
                                                    foreach( $food_types AS $key=>$val ) {
                                                ?>
                                                <option value="<?=$key?>" <?=($key == $food_code) ? 'selected="selected"' : '' ?> ><?=$val?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
										</td>
									</tr>
                                    <tr>
                                        <th class="info middle-align">제품명</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" name="product_name" id="product_name"  placeholder="제품명을 입력해주세요." value="<?=$product_name?>" data-valid="blank" />  
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <th class="info middle-align">제품등록번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" name="product_registration_no" id="product_registration_no"  placeholder="제품등록번호를 입력해주세요."  value="<?=$product_registration_no?>" data-valid="blank" />  
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <th class="info middle-align">품목보고번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" name="item_report_no" id="item_report_no" placeholder="201404640-472" value="<?=$item_report_no?>" data-valid="blank" />  
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">유통기한(일)</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" name="product_expiration_date" id="product_expiration_date" placeholder="180" value="<?=$product_expiration_date?>" data-valid="num" />  
                                        </td>
                                    </tr>
                                         
                                    <tr>
                                        <th class="info middle-align">보관방법</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" name="storage_method" id="storage_method"  placeholder="보관방법을 입력해주세요."  value="<?=$storage_method?>" />  
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">포장방법</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" name="product_packing_method" id="product_packing_method"  placeholder="포장방법을 입력해주세요."  value="<?=$product_packing_method?>"  />  
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //제품정보 -->
            
            <!-- HACCP 인증여부 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>HACCP 인증</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
                                        <th class="info middle-align">인증여부</th>
                                        <td colspan="3">
                                            <input type="radio" name="haccp_certify" id="haccp_certify_y"  value="Y"  data-valid="blank" <?=($haccp_certify == 'Y') ? 'checked="checked"' : '' ?>/> 
                                            <label class="m-r-15" for="haccp_certify_y">인증</label> 
                                            <input type="radio" name="haccp_certify" id="haccp_certify_n"  value="N"  data-valid="blank" <?=($haccp_certify == 'N') ? 'checked="checked"' : ''  ?>   />  
                                            <label class="m-r-15" for="haccp_certify_n">미인증</label> 
                                        </td>
                                    </tr>

                                    
<!--                                     
                                    <tr>
                                        <th class="info middle-align">인증기간</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="haccp_certify_start_date" id="haccp_certify_start_date" value="<?=$haccp_certify_start_date?>" readonly="readonly">
                                                        <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                        <input type="text" class="form-control datepicker " name="haccp_certify_end_date" id="haccp_certify_end_date" value="<?=$haccp_certify_end_date?>"  readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     -->
                                    
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- // HACCP 인증여부 -->

            <!-- 제품 포장단위 정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>제품 포장단위</b>     
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="addProductUnitForm()" >추가</button>                
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center">
                                <colgroup width="20%"></colgroup>
                                <colgroup width="20%"></colgroup>
                                <!-- <colgroup width="20%"></colgroup> -->
                                <colgroup width="20%"></colgroup>
                                <colgroup width="10%"></colgroup>
                                <thead>
									<tr>										
										<th class="info">포장단위별 용량(중량)</th>																				
										<th class="info">포장단위별 수량</th>																				
										<!-- <th class="info">수량단위 명</th>																				 -->
										<th class="info">사용여부</th>
                                        <th class="info">삭제</th>
									</tr>
								</thead>
                                <tbody id="product_unit_add_area" >
                                    
                                    
                                    
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- // 제품 포장단위 -->

            
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
    $(function(){
        if( $('input[name="haccp_certify"]').is(':checked') == false ) {
            $('#haccp_certify_n').trigger('click');
        }

        makeProductUnits();
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
        포장단위 추가버튼 동작
     */
     function addProductUnitForm(){

        var empty_data = [{
            product_unit_idx: ''
            , product_idx: ''
            , product_unit: ''
            , product_unit_type: ''
            , packaging_unit_quantity: ''
            , product_unit_name: ''
            , use_flag: ''
         }];

        $('#product_unit_add_area').append( $('#tmplate_product_unit_form').tmpl( empty_data ) );
        
     }

     /**
      * 포장단위 목록 생성
      */
     function makeProductUnits(){

         var product_unit_arr = <?=$product_units?>;

         if( typeof( product_unit_arr ) == 'object' ) {

            $('#product_unit_add_area').html( $('#tmplate_product_unit_form').tmpl( product_unit_arr ) );

         }

     }

     /**
      * 포장단위 삭제
      */
     function delProductUnitForm( arg_this, arg_unit_idx ){

        var product_unit_del_idx = $('#product_unit_del_idx').val();

        if( product_unit_del_idx == '') {
            product_unit_del_idx = [];
        } else {
            product_unit_del_idx = product_unit_del_idx.split(',');
        }

        if( arg_unit_idx !== '' ) {
            product_unit_del_idx.push( arg_unit_idx );

            $('#product_unit_del_idx').val( product_unit_del_idx.join(',') );
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

</script>

<style>    
    .table>tbody>tr>th.info {
        width: 15%;
    }
    /* table input {
        width: 40% !important; display: inline-block !important;
    } */
</style>

<script id="tmplate_product_unit_form" type="text/x-jquery-tmpl">
    <tr>
        
        <td >
            <input type="hidden"  name="product_unit_idx[]" placeholder="" value="${product_unit_idx}" style="width:100px" />
            <input class="form-control wper100  m-r-5" type="text"  name="product_unit[]" placeholder="" value="${product_unit}" style="width:100px" data-valid="blank" />
            <select class="form-control" name="product_unit_type[]" style="width:100px;margin-lfet:10px" >
                <option value="g" {{if "g" === product_unit_type }}selected="selected"{{/if}} >g</option>                                                    
                <option value="kg" {{if "kg" === product_unit_type }}selected="selected"{{/if}} >kg</option>                                                    
                <option value="ml"{{if "ml" === product_unit_type }}selected="selected"{{/if}}  >ml</option>                                                    
                <option value="L" {{if "L" === product_unit_type }}selected="selected"{{/if}} >L</option>                                                
            </select> 
        </td>        
        <td class="text-center">
            <input type="text" class="form-control wper100  m-r-5 "  name="packaging_unit_quantity[]"  value="${packaging_unit_quantity}"  placeholder="" style="width:50px" data-valid="num" />            
        </td>
        <!-- <td class="text-center">
            <input type="text" class="form-control wper100  m-r-5 "  name="product_unit_name[]"  value="${product_unit_name}"  placeholder="봉/개" style="width:80px" data-valid="blank" />            
        </td> -->
        <td class="text-center">
            <select class="form-control" name="use_flag[]" style="width:100px;margin-lfet:10px" >
                <option value="Y" {{if "Y" === use_flag }}selected="selected"{{/if}}>사용</option>
                <option value="N" {{if "N" === use_flag }}selected="selected"{{/if}}>미사용</option>
            </select> 
        </td>
        <td class="text-center">            
            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delProductUnitForm(this, '${product_unit_idx}')">삭제</button>
        </td>
    </tr>
</script>

<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
