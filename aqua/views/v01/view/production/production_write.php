<!-- Start content-page -->
<div class="content-page">
    <!-- start content -->
	<div class="content">
		<!-- container -->
        <div class="container">
            <section class="content-header">
              <h1>
                제품생산 지시관리                
                <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button>                 
              </h1>
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="production_idx" value="<?=$production_idx?>" />                
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="page_name" value="<?=$page_name?>" />                
                <input type="hidden" name="use_material_info" id="use_material_info" value="<?=preg_replace( '/\"/', "'", $use_material_info)?>" />
                <input type="hidden" name="raw_material_info" id="raw_material_info" value="<?=preg_replace( '/\"/', "'", $raw_material_info)?>" />
                <input type="hidden" name="sub_material_info" id="sub_material_info" value="<?=preg_replace( '/\"/', "'", $sub_material_info)?>" />
                
                
			<!-- 생산지시 정보 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
							<b>지시하기</b>
						</h5>
						<hr class="m-t-0">
						<div class="col-lg-12 table-responsive m-b-0">
                        

								<table class="table table-bordered text-center">
									<colgroup width="20%"></colgroup>
									<colgroup width="30%"></colgroup>
									<colgroup width="20%"></colgroup>
									<colgroup width="30%"></colgroup>
									<tbody>
                                        <tr>
                                            <td class="info">식품유형</td>
											<td>
												<select class="form-control" name="food_code" id="food_code"  >
													<option value="">선택하세요</option>
													<?php
                                                        foreach( $food_types AS $key=>$val ) {
                                                    ?>
                                                    <option value="<?=$key?>" <?=($key == $food_code) ? 'selected="selected"' : '' ?> ><?=$val?></option>
                                                    <?php
                                                        }
                                                    ?>
												</select>
											</td>
											<td class="info">제품명</td>
											<td>
												<select class="form-control" name="product_idx" id="product_idx" data-current_val="<?=$product_idx?>" data-valid="blank" >
													<option value="">선택하세요</option>													
												</select>
											</td>
                                        </tr>
										<tr>
											<td class="info">포장단위</td>
											<td>
												<select class="form-control" name="product_unit_idx" id="product_unit_idx" data-current_val="<?=$product_unit_idx?>" data-valid="blank" >
													<option value="">선택하세요</option>													
												</select>
											</td>
                                            <td class="info">생산 예정일</td>
											<td class="text-left">
                                                <input type="radio" class="m-r-5" name="timing" id="timing_am" value="am" <?=($timing == 'am') ? 'checked="checked"' : ''?> data-valid="blank" />
                                                <label for="timing_am" >오전</label>
                                                <input type="radio" class="m-l-10 m-r-5" name="timing" id="timing_pm" value="pm" <?=($timing == 'pm') ? 'checked="checked"' : ''?> />
                                                <label for="timing_pm" >오후</label>
                                                <input type="radio" class="m-l-10 m-r-5" name="timing" id="timing_all" value="all" <?=($timing == 'all') ? 'checked="checked"' : ''?> />
                                                <label for="timing_all" >종일</label>
                                                <br/><input type="text" class="form-control input-date m-t-10 datepicker" name="schedule_date" id="schedule_date" value="<?=$schedule_date?>" style="width:100px;" />
                                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-10" onclick="getExpirationDate()" >유통기한 계산</button>
                                            </td>
																			
                                        </tr>
                                        
										<tr>
                                            <td class="info">제조번호</td>
											<td><input type="text" class="form-control" name="produce_no" id="produce_no" value="<?=$produce_no?>" data-valid="blank" /></td>		
											<td class="info">유통기한<span id="product_expiration_date_text" ><?='<br/>( 생산일로부터 '.$expiration_days.'일 )'?></span></td>
											<td>
                                                <input type="text"class="form-control input-date" name="expiration_date" id="expiration_date" value="<?=$expiration_date?>" data-valid="blank" />
                                                <input type="hidden" name="expiration_days" id="expiration_days" value="<?=$expiration_days?>"  />
                                            </td>
										</tr>
										<tr>
											<td class="info">생산량(kg)</td>
											<td class="text-left">
                                                <input type="text" class="form-control"  name="schedule_quantity" id="schedule_quantity" value="<?=$schedule_quantity?>" data-valid="blank" />
                                            </td>
											<td class="info">봉/박스</td>
											<td>
												<table class="sample_table">
                                                    <colgroup width="50%"></colgroup>
                                                    <colgroup width="50%"></colgroup>
													<!-- <tr>
														<td class="amount_cnt"><span class="text_point">KG</span></td>
														<td class="amount_cnt"><input type="text" id="amount_kg" class="form-control" /></td>
													</tr> -->
													<tr>
														<td class="amount_cnt"><span class="text_point">파우치(봉)</span></td>
														<td class="amount_cnt"><input type="text" class="form-control" id="amount_pouch" name="pouch_quantity" value="<?=$pouch_quantity?>" /></td>
													</tr>
													<tr>
														<td class="amount_cnt"><span class="text_point">박스</span></td>
														<td class="amount_cnt"><input type="text" class="form-control" id="amount_box" name="box_quantity" value="<?=$box_quantity?>" /></td>
													</tr>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							
						</div>
						<div class="form-group row"></div>
					</div>
				</div>
			</div>
            <!-- //생산지시 정보 -->
            <!-- 원료 사용정보 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
                            <b>원료 사용정보</b>
                            <button type="button" class="btn btn-primary fright" onclick="addForm()" >추가</button>
						</h5>
						<hr class="m-t-0">
						<div class="">
                            <form action="">
                                <table class="table table-bordered text-center">
                                    <colgroup width="10%"></colgroup>
                                    <colgroup width="18%"></colgroup>
                                    <colgroup width="18%"></colgroup>
                                    <colgroup width="18%"></colgroup>
                                    <colgroup width="18%"></colgroup>
                                    <colgroup width="10%"></colgroup>
                                    <thead>
                                        <tr>
                                            <th class="info" style="width:150px">찾아보기</th>
                                            <th class="info">원재료</th>
                                            <th class="info">입고일</th>
                                            <th class="info">선택 입고일(재고량)</th>
                                            <th class="info">배합비</th>
                                            <th class="info">원료량</th>
                                            <th class="info">삭제</th>
                                        </tr>
                                    </thead>
                                    <tbody id="material_ratio_add_area" >
                                       
                                    </tbody>
                                </table>
                            
                            <div class="form-group row"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //원료 사용정보 -->
            <!-- 부자재 사용정보 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
                            <b>부자재 사용정보</b>
                            <button type="button" class="btn btn-primary fright" onclick="addSubForm()">추가</button>
						</h5>
						<hr class="m-t-0">
						<div class="">
                            <form action="">
                                <table class="table table-bordered text-center">
                                    <colgroup width="22.5%"></colgroup>
                                    <colgroup width="22.5%"></colgroup>
                                    <colgroup width="22.5%"></colgroup>
                                    <colgroup width="22.5%"></colgroup>
                                    <colgroup width="10%"></colgroup>
                                    <thead>
                                        <tr>
                                            <th class="info">찾아보기</th>                                            
                                            <th class="info">자재명</th>                                            
                                            <th class="info">재고량</th>
                                            <th class="info">수량</th>
                                            <th class="info">삭제</th>
                                        </tr>
                                    </thead>
                                    <tbody id="material_sub_add_area" >
                                        
                           
                                    </tbody>
                                </table>
                            
                            <div class="form-group row"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- //부자재 사용정보 -->
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

            
		</div><!-- container -->
	</div><!-- content -->
</div><!-- content-page -->


<!-- 원자재 목록 레이어  -->
<div id="search_material_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <!-- <th class="info" style="width: 40%;">납품업체명</th>                                         -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $materials ) > 0  ){
                                            foreach( $materials AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td class="text-center vertical-align">
                                            <button type="button" class=" btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceMaterial(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
                                        </td>                                        
                                        <td class="text-center vertical-align"><?=$item['material_name']?></td>
                                        <!-- <td class="text-center vertical-align"><?=$item['company_name']?></td> -->
                                        
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
                                        <!-- <th class="info" style="width: 40%;">납품업체명</th>                                         -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $sub_materials ) > 0  ){
                                            foreach( $sub_materials AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td class="text-center vertical-align">
                                            <button type="button" class=" btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceSubMaterial(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
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


<script>

var edit_raw_flag = false;
var edit_sub_flag = false;

$(document).ready(function(){
    
    jqueryAddEvent({
        selector : '#food_code'
        ,event : 'change'
        ,fn : foodCodeChangeHandler
    });
    
    jqueryAddEvent({
        selector : '#product_idx'
        ,event : 'change'
        ,fn : productChangeHandler
    });

    jqueryAddEvent({
        selector : '#produce_no'
        ,event : 'focus'
        ,fn : getNewProduceNo
    });

    jqueryAddEvent({
        selector : '#schedule_date'
        ,event : 'change'
        ,fn : function(){
            $('#produce_no').val('');
            $('#expiration_date').val('');
        }
    });

    jqueryAddEvent({
        selector : '#schedule_quantity'
        ,event : 'keyup'
        ,fn : scheduleQuantityKeyupHandler
    });

    if( $('#mode').val() == 'edit' ){
        
        $('#food_code').trigger('change');


        editUseMaterialInfoMakeHandler();
        
    }

    
    // makeMaterialRatios( test );
});


// var test = {"mixing_ratio":[{"mixing_idx":"9","material_ratio":"97","product_idx":"100000006","company_idx":"14","material_idx":"10003","material_name":"찹쌀","ratio_quantity":1940,"receiving_dates":[{"stock_quantity":"300","receipt_date":"2020-03-12","material_idx":"10003","material_kind":"raw"},{"stock_quantity":"1800","receipt_date":"2020-03-26","material_idx":"10003","material_kind":"raw"},{"stock_quantity":"3800","receipt_date":"2020-03-31","material_idx":"10003","material_kind":"raw"}],"range_date":"2020-03-12,2020-03-26","range_date_arr":["2020-03-12(300)","2020-03-26(1800)"]},{"mixing_idx":"10","material_ratio":"3","product_idx":"100000006","company_idx":"14","material_idx":"10007","material_name":"감자전분","ratio_quantity":60,"receiving_dates":[{"stock_quantity":"1500","receipt_date":"2020-03-31","material_idx":"10007","material_kind":"raw"}],"range_date":"2020-03-31","range_date_arr":["2020-03-31(1500)"]}],"status":"success","msg":""}

var food_code_obj = {};
var product_obj = {};
var product_unit_obj = {};
/**
 * 식품유형 값 변경 동작
 */
function foodCodeChangeHandler(){
// console.log( $(this).val() );
    if( $(this).val() !== '' ) {

        ajaxProcessing('open');

        jqueryAjaxCall({
            type : "post",
            url : '/product/product_list_json',
            dataType : "json",
            paramData : {
                food_code : $(this).val()                              
            } ,
            callBack : function( arg_result ){
                
                ajaxProcessing('close');

                

                if( arg_result.status == 'success' ){
                    makeProductOption( arg_result.list );
                } else {
                    alert( arg_result.msg );
                }
            }
        });
    }
        
}

/**
 * 제품 option 값 생성
 */
 function makeProductOption( arg_data ){
    var selected = '';
    $("#product_idx").html( "<option value='' >선택하세요</option>" );

    $.each(arg_data, function(idx, item){

        product_obj[ item.product_idx ] = item;
        
        if( $("#product_idx").data('current_val') == item.product_idx ) {
            selected = 'selected="selected"';
        } else {
            selected = '';
        }

        $("#product_idx").append( "<option value='"+ item.product_idx +"' "+ selected +" >"+item.product_name+"</option>" );

        if( $('#mode').val() == 'edit' ){
            $('#product_idx').trigger('change');
        }

    });
 }

/**
 * 제품 값 변경 동작
 */
function productChangeHandler(){

    if( $(this).val() !== '' ) {

        ajaxProcessing('open');
        
        jqueryAjaxCall({
            type : "post",
            url : '/product/get_poduct_unit_info_json',
            dataType : "json",
            paramData : {
                product_idx : $(this).val()                              
            } ,
            callBack : function( arg_result ){
                
                ajaxProcessing('close');
                
                if( arg_result.status == 'success' ){
                    makeProductUnitOption( arg_result.product_units );
                } else {
                    alert( arg_result.msg );
                }
            }
        });

    }

}

/**
 * 제품 포장단위 option 값 생성
 */
function makeProductUnitOption( arg_data ){
    var selected = '';
    $("#product_unit_idx").html( "<option value='' >선택하세요</option>" );

    $.each(arg_data, function(idx, item){

        product_unit_obj[ item.product_unit_idx ] = item;

        if( $("#product_unit_idx").data('current_val') == item.product_unit_idx ) {
            selected = 'selected="selected"';
        } else {
            selected = '';
        }

        $("#product_unit_idx").append( "<option value='"+ item.product_unit_idx +"' "+ selected +" >"+item.product_unit + item.product_unit_type +" X "+item.packaging_unit_quantity+"</option>" );

    });
 }

 /**
  * 유통기한 계산하기 버튼 클릭시
  */
 function getExpirationDate(){

    var get_product_idx = $('#product_idx').val();
    var std_date = $('#schedule_date').val();

    if( get_product_idx == '' ) {
        alert('제품을 선택해주세요.');
        return;
    }

    if( std_date == '' ) {
        alert('날짜를 입력해주세요.');
        return;
    }

    if( input_RegexCheck('date', std_date) == false ){
        alert('날짜형식은 yyyy-mm-dd 형식으로 작성해주세요.');
        $('#schedule_date').focus();
        return;
    }
    
    ajaxProcessing('open');
        
    jqueryAjaxCall({
        type : "post",
        url : '/production/get_expiration_date_json',
        dataType : "json",
        paramData : {
            product_expiration_date : product_obj[get_product_idx].product_expiration_date
            ,std_date : std_date
        } ,
        callBack : function( arg_result ){
            
            ajaxProcessing('close');

            if( arg_result.status == 'success' ){

                $('#product_expiration_date_text').html( '<br/>( 생산일로부터 ' + product_obj[get_product_idx].product_expiration_date + '일 )' );
                $('#expiration_days').val(product_obj[get_product_idx].product_expiration_date);
                $('#expiration_date').val(arg_result.expiration_date);

                getNewProduceNo();

            } else {
                alert( arg_result.msg );
            }
        }
    });

 }

 /**
  * 신규 제조번호 값을 가져온다.
  */
 function getNewProduceNo(){

    var get_product_idx = $('#product_idx').val();
    var get_schedule_date = $('#schedule_date').val();
    var code = '';

    if( (get_product_idx !== '') && ( get_schedule_date !== '' )) {
        
        code = product_obj[get_product_idx].product_registration_no + get_schedule_date.replace(/-/gi, '');
        // console.log( code ); return;
        ajaxProcessing('open');
        
        jqueryAjaxCall({
            type : "post",
            url : '/production/get_new_produce_no_json',
            dataType : "json",
            paramData : {
                code : code                
            } ,
            callBack : function( arg_result ){
                
                ajaxProcessing('close');

                if( arg_result.status == 'success' ){
                    $('#produce_no').val(arg_result.new_no);
                } else {
                    alert( arg_result.msg );
                }
            }
        });
        
    }
    
 }

 /**
  * 생산량 값 입력시 동작
  */
function scheduleQuantityKeyupHandler(){

    if( $('#product_unit_idx').val() !== '' ) {

        // 생산량 입력
        var amount = parseFloat( $(this).val() );
        // 포장용량
        var unit = parseFloat( product_unit_obj[$('#product_unit_idx').val()].product_unit );
        // 박스당 용량
        var unit_qantity = parseFloat(  product_unit_obj[$('#product_unit_idx').val()].packaging_unit_quantity );


        // kg = 생산량
        var kgVal = amount;
        // console.log(amount);
        // console.log(kgVal);
        // 파우치 = 생산량 / 포장용량
        var pouchVal = amount / unit;
        // 박스 = 파우치 / 박스당 용량
        var boxVal = pouchVal / unit_qantity;
        // $("#amount_kg").val(kgVal);
        $("#amount_pouch").val(pouchVal);
        $("#amount_box").val(boxVal);

        if( $(this).val().length > 1 ) {
            $('#material_ratio_add_area').html('');
            getProductMixingratio( $('#product_idx').val(), $(this).val() );
        }
    }

}

/**
 * 제품 배합비율 정보를 가져온다.
 */
function getProductMixingratio( arg_product_idx, arg_quantity ){
    if( arg_product_idx !== '' ) {

        ajaxProcessing('open');
        
        jqueryAjaxCall({
            type : "post",
            url : '/product/get_poduct_mixingratio_json',
            dataType : "json",
            paramData : {
                product_idx : arg_product_idx                
                ,quantity : arg_quantity                
            } ,
            callBack : function( arg_result ){
                
                ajaxProcessing('close');

                $('#material_ratio_add_area').html('');
                if( arg_result.status == 'success' ){                    
                    makeMaterialRatios(arg_result.mixing_ratio);
                } else {
                    alert( arg_result.msg );
                }
            }
        });

    }
}

/**
 * 원료사용정보 생성
 */
function makeMaterialRatios( arg_data ){

    if( typeof( arg_data ) == 'object' ) {

        $('#material_ratio_add_area').append( $('#tmplate_material_form').tmpl( arg_data ) );
        // var result = parseFloat(schedule_quantity) / 100 * parseFloat(value);

        
        jqueryAddEvent({
            selector : '.select_receiving_dates'
            ,event : 'change'
            ,fn : receivingDatesChangeHandler
        });

        jqueryAddEvent({
            selector : '.range_date_selected_btn'
            ,event : 'click'
            ,fn : rangeDateSelectedBtn
        });

        jqueryAddEvent({
            selector : '.material_ratio_input'
            ,event : 'keyup'
            ,fn : materialRatioInputKeyupHandler
        });
        
    }

}

/**
    원료 추가영역 배합비 키업 이벤트 처리
 */
function materialRatioInputKeyupHandler(){

    if( input_RegexCheck('only_number', $(this).val()) == false ){
        alert('숫자로만 입력해주세요.');
        $(this).val($(this).val().replace(/[^a-zA-Z0-9]+/i, ''));
        $(this).focusout();
    }

    if( $('#schedule_quantity').val() > 0 ) {
        $(this).parent().parent().find('input[name="quantity[]"]').val( $('#schedule_quantity').val() / 100 * $(this).val() );
    }
    
}

/**
    원료 사용영역 입고일 변경시 이벤트
 */
function receivingDatesChangeHandler(){

    var this_row_range_date = $(this).parent().parent().find('input[name="range_date[]"]').val().split(',');
    if( $(this).val() !== '' ) {

        var text_data = this.options[this.selectedIndex].text;

        if( !( this_row_range_date.indexOf( $(this).val() ) > -1 ) ) {

            this_row_range_date.push( $(this).val() );

            $(this).parent().parent().find('input[name="range_date[]"]').val(this_row_range_date.join(','));
            
            $(this).parent().parent().find('.selected_range_date_area').append( '<button type="button" class="btn range_date_selected_btn" style="margin:5px" >'+text_data+'</button>' );

            jqueryAddEvent({
                selector : '.range_date_selected_btn'
                ,event : 'click'
                ,fn : rangeDateSelectedBtn
            });
            
        }
    }

}

/**
  선택된 재고일자 클릭시 동작
 */
function rangeDateSelectedBtn(){

    return;
    var this_date = $(this).text().substr(0,10);
    var this_row_range_date = $(this).parent().parent().find('input[name="range_date[]"]').val().split(',');
    this_row_range_date.splice( this_row_range_date.indexOf( this_date ), 1 );

    $(this).parent().parent().find('input[name="range_date[]"]').val(this_row_range_date.join(','));
    
    $(this).remove();
}

/**
    원자재 추가버튼 동작
*/

function addForm(){
    
    if( ( $('#mode').val() == 'edit'  ) && ( edit_raw_flag == false )) {
        if( confirm('추가 작업을 진행하시겠습니까?\n\n자재 정보 변경시 기존 예약 정보는 모두 삭제됩니다.') == false ) {
            return;
        }

        edit_raw_flag = true;
        $('#material_ratio_add_area').html('');

    }
    var empty_data = [
        {
            material_idx: ''
            , range_date: ''
            , receiving_dates: []
            , range_date_arr: []
            , material_ratio: '' 
            , ratio_quantity: ''
        }
    ];

    $('#material_ratio_add_area').append( $('#tmplate_material_form').tmpl( empty_data ) );

    jqueryAddEvent({
        selector : '.material_ratio_input'
        ,event : 'keyup'
        ,fn : materialRatioInputKeyupHandler
    });
}

/**
    부자재 추가버튼 동작
*/
function addSubForm(){

    if( ( $('#mode').val() == 'edit'  ) && ( edit_sub_flag == false )) {

        if( confirm('추가 작업을 진행하시겠습니까?\n\n자재 정보 변경시 기존 예약 정보는 모두 삭제됩니다.') == false ) {            
            
            return;
        }
        edit_sub_flag = true;
        $('#material_sub_add_area').html('');

    }

    var empty_data = [
        {
            material_idx: ''                
            , material_name: ''
            , stock_quantity: ''        
            , quantity: '' 
        }
    ];

    $('#material_sub_add_area').append( $('#tmplate_sub_material_form').tmpl( empty_data ) );

}

/**
* 원부자재 삭제
*/
function delForm( arg_this, arg_m_idx ){
    $( arg_this ).parent().parent().remove();    
}

/**
* 원자재 삭제 - 수정화면
*/
function editDelForm( arg_type ){
    
    if( arg_type == 'raw' ) {
        
        if( edit_raw_flag == false ) {
            if( confirm('삭제 하시겠습니까?\n\n자재 정보 변경시 기존 예약 정보는 모두 삭제됩니다.') == true ) {
                $('.schedule_raw_material_info').remove();
                edit_raw_flag = true;
            }

        }
        
    } else {

        if( edit_sub_flag == false ) {
            if( confirm('삭제 하시겠습니까?\n\n자재 정보 변경시 기존 예약 정보는 모두 삭제됩니다.') == true ) {
                $('.schedule_sub_material_info').remove();
                edit_sub_flag = true;
            }

        }
        
    }

}



/**
 원료 찾기
 */
var current_opener = '';
function searchMaterial( arg_this ){
    current_opener = arg_this;
    $('#search_material_modal').modal();
}

/**
    부자재 찾기 버튼 동작
 */
var current_sub_opener = '';
function searchSubMaterial( arg_this ) {
    current_sub_opener = arg_this;
    $('#search_sub_material_modal').modal();
}

/**
    원료 레이어에서 원료 선택시 동작
 */
function choiceMaterial( arg_this ) {       

    var data = JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );
    var data_exist = false;

    $.each( $( current_opener ).parent().parent().parent().find( 'input[name="material_idx[]"]' ) , function(){
        
        if( $(this).val() == data.material_idx ) {
            if( data_exist == false ) {
                data_exist = true
            }
        }
    });

    if( data_exist == false ) {
        
        ajaxProcessing('open');
        
        jqueryAjaxCall({
            type : "post",
            url : '/product/get_material_quantity_by_receiving_date_json',
            dataType : "json",
            paramData : {
                material_idx : data.material_idx           
                , material_kind : 'raw'               
            } ,
            callBack : function( arg_result ){
                
                ajaxProcessing('close');
                
                if( arg_result.status == 'success' ){
                    
                    var option_html = '<option value="">선택</option>';
                    var total_stock_quantity = 0; 

                    $.each( arg_result.receiving_dates, function(idx, item){
                        option_html += '<option value="'+ item.receipt_date +'">'+ item.receipt_date +'('+ item.stock_quantity +')</option>';

                        total_stock_quantity += Number( item.stock_quantity );
                    });
                    
                    $( current_opener ).parent().parent().find('input[name="material_idx[]"]').val( data.material_idx );
                    $( current_opener ).parent().parent().find('input[name="total_stock_quantity[]"]').val( total_stock_quantity );
                    $( current_opener ).parent().parent().find('input[name="material_name[]"]').val( data.material_name );
                    $( current_opener ).parent().parent().find('.material_name_area').html( data.material_name );
                    $( current_opener ).parent().parent().find('select[name="receiving_dates[]"]').html( option_html );

                    jqueryAddEvent({
                        selector : '.select_receiving_dates'
                        ,event : 'change'
                        ,fn : receivingDatesChangeHandler
                    });

                } else {
                    alert( arg_result.msg );
                }
            }
        });

    } else {
        alert('이미 추가된 품목입니다.');
    }

    $('#search_material_modal').modal('hide');

}

/**
    부자재 선택 버튼 클릭 동작
 */
function choiceSubMaterial( arg_this ) {

    var data = JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );
    
    var data_exist = false;

    $.each( $( current_sub_opener ).parent().parent().parent().find( 'input[name="sub_material_idx[]"]' ) , function(){
        
        if( $(this).val() == data.material_idx ) {
            if( data_exist == false ) {
                data_exist = true
            }
        }
    });

    if( data_exist == false ) {
        
        ajaxProcessing('open');
        
        jqueryAjaxCall({
            type : "post",
            url : '/product/get_material_quantity_by_receiving_date_json',
            dataType : "json",
            paramData : {
                material_idx : data.material_idx                          
                , material_kind : 'sub'                         
            } ,
            callBack : function( arg_result ){
                
                ajaxProcessing('close');

                if( arg_result.status == 'success' ){
                    var total_stock_quantity = 0;
                    $.each( arg_result.receiving_dates, function(idx, item){
                        total_stock_quantity += Number( item.stock_quantity );
                    });

                    $( current_sub_opener ).parent().parent().find('input[name="sub_material_idx[]"]').val( data.material_idx );
                    $( current_sub_opener ).parent().parent().find('input[name="sub_material_name[]"]').val( data.material_name );
                    $( current_sub_opener ).parent().parent().find('.sub_material_name_area').html( data.material_name );
                    $( current_sub_opener ).parent().parent().find('input[name="sub_total_stock_quantity[]"]').val( total_stock_quantity );
                    $( current_sub_opener ).parent().parent().find('.sub_material_stock_quantity_area').html( total_stock_quantity );
                    
                } else {
                    alert( arg_result.msg );
                }
            }
        });

    } else {
        alert('이미 추가된 품목입니다.');
    }

    $('#search_sub_material_modal').modal('hide');
}

/**
    수정시 원부자재 데이터 정보 생성
 */
function editUseMaterialInfoMakeHandler(){
    
    raw_material_info = JSON.parse( $('#raw_material_info').val().replace(/'/g, '"') );
    sub_material_info = JSON.parse( $('#sub_material_info').val().replace(/'/g, '"') );
    // JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );

    // console.log( raw_material_info );
    // console.log( sub_material_info );

    var loop_cnt = 0;
    var raw_material_arr = [];
    var sub_material_arr = [];

    if( raw_material_info.hasOwnProperty('material_idx') == true ) {

        $.each(raw_material_info.material_idx, function(idx, val){

            raw_material_arr[idx] = [];
            raw_material_arr[idx]['material_idx'] = val;
            raw_material_arr[idx]['material_name'] = raw_material_info.material_name[idx];
            raw_material_arr[idx]['quantity'] = raw_material_info.quantity[idx];
            raw_material_arr[idx]['range_date'] = raw_material_info.range_date[idx];
            raw_material_arr[idx]['receiving_dates'] = raw_material_info.receiving_dates[idx];
            raw_material_arr[idx]['material_ratio'] = raw_material_info.material_ratio[idx];
            raw_material_arr[idx]['use_order_idxs'] = raw_material_info.use_order_idxs[idx];
            raw_material_arr[idx]['use_order_quantity'] = raw_material_info.use_order_quantity[idx];                    
            raw_material_arr[idx]['material_stock_idxs'] = raw_material_info.material_stock_idxs[idx];      
            if( raw_material_info.hasOwnProperty('receipt_date') == true ) {
                raw_material_arr[idx]['receipt_date'] = raw_material_info.receipt_date[idx];
            } 
        });

    }
    
    loop_cnt = 0;
    if( sub_material_info.hasOwnProperty('material_idx') == true ) {
    
        $.each(sub_material_info.material_idx , function(idx, val){
            
            sub_material_arr[idx] = [];
            sub_material_arr[idx]['material_idx'] = val;
            sub_material_arr[idx]['material_name'] = sub_material_info.material_name[idx];
            sub_material_arr[idx]['quantity'] = sub_material_info.quantity[idx];
            sub_material_arr[idx]['use_order_idxs'] = sub_material_info.use_order_idxs[idx];
            sub_material_arr[idx]['use_order_quantity'] = sub_material_info.use_order_quantity[idx];        
            sub_material_arr[idx]['material_stock_idxs'] = sub_material_info.material_stock_idxs[idx];     
              
            if( sub_material_arr.hasOwnProperty('receipt_date') == true ) {
                sub_material_arr[idx]['receipt_date'] = sub_material_arr.receipt_date[idx];
            }
            
        });
    }

    // console.log( raw_material_arr );
    // console.log( sub_material_arr );

    $('#material_ratio_add_area').append( $('#tmplate_material_added_form').tmpl( raw_material_arr ) );
    $('#material_sub_add_area').append( $('#tmplate_sub_material_added_form').tmpl( sub_material_arr ) );

    
}

/**
 * 저장 버튼 동작
 */
function register(){
    
    viewFormValid.alert_type = 'add';        
    if( viewFormValid.run( 'form_write' ) === true ) {
        // submit

        var return_flag = false;
        var return_target = '';

        $('input[name="quantity[]"]').each(function( idx, item ){
            
            if( Number( $(this).val() ) > Number( $( $('input[name="total_stock_quantity[]"]')[idx] ).val() ) ) {
                return_target = this;
                return_flag = true;
                return false;
            }

        });

        if( return_flag == true ) {
            alert('재고량 보다 큰 수를 입력하셨습니다.');
            $(return_target).focus();
            return;
        }

        $('input[name="sub_quantity[]"]').each(function(idx, item){
            
            if( Number( $(this).val() ) > Number( $( $('input[name="sub_total_stock_quantity[]"]')[idx] ).val() ) ) {
                return_target = this;
                return_flag = true;
                return false;
            }

        });

        if( return_flag == true ) {
            alert('재고량 보다 큰 수를 입력하셨습니다.');
            $(return_target).focus();
            return;
        }

        $('#form_write').submit();

    }
    
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


</script>

<script id="tmplate_material_form" type="text/x-jquery-tmpl">
<tr>
    <td>
        <button type="button" class="btn btn-sm btn-info waves-effect waves-light m-l-10" onclick="searchMaterial(this)">찾기</button>
        <input type="hidden" name="material_idx[]" value="${material_idx}"  >
        <input type="hidden" name="material_name[]" value="${material_name}"  >
        <input type="hidden" name="total_stock_quantity[]" value="${total_stock_quantity}"  >
        <input type="hidden" name="range_date[]" value="${range_date}"  >
    </td>
    <td class="material_name_area" >${material_name}</td>    
    <td>
        <select class="form-control width100 select_receiving_dates " name="receiving_dates[]" >
            <option value=""  >선택</option>
            {{each(idx, item) receiving_dates}}
                <option value="${(item.receipt_date)}">${(item.receipt_date)}(${(item.stock_quantity)})</option>
            {{/each}}
        </select>
    </td>    
    <td class="selected_range_date_area" >    
        {{each(idx, item) range_date_arr}}     
            <button type="button" class="btn range_date_selected_btn" style="margin:5px"  >${(item)}</button>
        {{/each}}
    </td>										
    <td><input type="text" name="material_ratio[]" class="form-control width100 isNum material_ratio_input" maxlength="20" value="${material_ratio}" placeholder="0"  ></td>										
    <td><input type="text" name="quantity[]" class="form-control width100 isNum" maxlength="20" value="${ratio_quantity}" placeholder="0" ></td>										
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this)">삭제</button></td>										
</tr>
</script>


<script id="tmplate_sub_material_form" type="text/x-jquery-tmpl">
<tr>
    <td>
        <button type="button" class="btn btn-sm btn-info waves-effect waves-light m-l-10" onclick="searchSubMaterial(this)">찾기</button>
        <input type="hidden" name="sub_total_stock_quantity[]" value="${total_stock_quantity}"  >
        <input type="hidden" name="sub_material_idx[]" value="${material_idx}"  >                                                
        <input type="hidden" name="sub_material_name[]" value="${material_name}"  >                                                
    </td>
    <td class="sub_material_name_area" >${material_name}</td>    
    <td class="sub_material_stock_quantity_area" >${stock_quantity}</td>                                            
    <td><input type="text" name="sub_quantity[]" class="form-control width100 isNum" maxlength="20" value="${quantity}" placeholder="0" ></td>										
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this)">삭제</button></td>                                            
</tr>
</script>


<script id="tmplate_material_added_form" type="text/x-jquery-tmpl">
<tr class="schedule_raw_material_info" >
    <td>
        예약 재고번호
        <br>${material_stock_idxs}
    </td>
    <td>${material_name}</td>    
    <td>${range_date}</td>    
    <td>${receipt_date}</td>    
    <td>${material_ratio}</td>										
    <td>${quantity}</td>										
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="editDelForm('raw')">삭제</button></td>										
</tr>
</script>


<script id="tmplate_sub_material_added_form" type="text/x-jquery-tmpl">
<tr class="schedule_sub_material_info" >
    <td>
        예약 재고번호
        <br>${material_stock_idxs}
    </td>
    <td>${material_name}</td>    
    <td>${receipt_date}</td>                                            
    <td>${quantity}</td>										
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="editDelForm('sub')">삭제</button></td>                                            
</tr>
</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>