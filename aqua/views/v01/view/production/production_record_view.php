<!-- Start content-page -->
<div class="content-page">
    <!-- start content -->
	<div class="content">
		<!-- container -->
        <div class="container">
            <section class="content-header">
              <h1>
                제품이력 상세보기
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
                                            <td class="info">제품명</td>
											<td class="text-left" >
												[<?=$food_types[ $food_code ]?>]<?=$product_name?>
											</td>
											<td class="info">제조번호</td>
											<td class="text-left" >
                                                <?=$produce_no?>
											</td>
                                        </tr>
										<tr>
											<td class="info">제조일자</td>
											<td class="text-left">
                                                <?=$schedule_date?>
											</td>
                                            <td class="info">유통기한</td>
											<td class="text-left">
                                                <?=$expiration_date?><?='( 생산일로부터 '.$expiration_days.'일 )'?>
                                            </td>
																			
                                        </tr>
                                        
										<tr>
                                            <td class="info">포장단위</td>
											<td class="text-left"><?=$product_unit?><?=$product_unit_type?> X <?=$packaging_unit_quantity?></td>		
											<td class="info">생산량</span></td>
											<td class="text-left"> 
                                                <?=$schedule_quantity?><?=$product_unit_type?> / <?=$pouch_quantity?>봉 (<?=$box_quantity?> 박스)
                                            </td>
										</tr>
										<tr>
                                            <td class="info">생산일보</td>
                                            <td colspan="3" class="text-left"><button class="btn btn-default">상세보기</button></td>
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
                                            
                                            <th class="info">사용정보</th>
                                            <th class="info">원재료</th>
                                            <th class="info">입고일</th>                                            
                                            <th class="info">배합비</th>
                                            <th class="info">원료량</th>
                                            
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
                                            <th class="info">사용정보</th>                                                                    
                                            <th class="info">자재명</th>                                            
                                            <th class="info">수량</th>                                            
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
                
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                    <!-- <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button> -->
               </div>
            </div>

            
		</div><!-- container -->
	</div><!-- content -->
</div><!-- content-page -->


<script>

var edit_raw_flag = false;
var edit_sub_flag = false;

$(document).ready(function(){
    
    
    editUseMaterialInfoMakeHandler();

    
});


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
            
        });
    }

    // console.log( raw_material_arr );
    // console.log( sub_material_arr );

    $('#material_ratio_add_area').append( $('#tmplate_material_added_form').tmpl( raw_material_arr ) );
    $('#material_sub_add_area').append( $('#tmplate_sub_material_added_form').tmpl( sub_material_arr ) );

    
}


</script>


<script id="tmplate_material_added_form" type="text/x-jquery-tmpl">
<tr class="schedule_raw_material_info" >
    <td>
        사용 재고번호
        <br>${material_stock_idxs}
    </td>
    <td>${material_name}</td>    
    <td>${range_date}</td>     
    <td>${material_ratio}</td>										
    <td>${quantity}</td>										
    
</tr>
</script>


<script id="tmplate_sub_material_added_form" type="text/x-jquery-tmpl">
<tr class="schedule_sub_material_info" >
    <td>
        사용 재고번호
        <br>${material_stock_idxs}
    </td>
    <td>${material_name}</td>                 
    <td>${quantity}</td>										
</tr>
</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>