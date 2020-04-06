<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    제품 재고현황                    
                </h1>                   
            </section>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box p-b-0">
                        <div class="row">
                            <form class="form-horizontal group-border-dashed clearfix" name="fsearch" id="fsearch" method="get" action="">
                                <input type="hidden" name="page" value="<?=$page?>">
                                <input type="hidden" name="list_rows" value="<?=$list_rows?>">                                                        
                                <input type="hidden" name="top_code" value="<?=$top_code?>">
                                <input type="hidden" name="left_code" value="<?=$left_code?>">
                                <input type="hidden" name="sch_order_field" id="sch_order_field" value="<?=$sch_order_field?>">
                                <input type="hidden" name="sch_order_status" id="sch_order_status" value="<?=$sch_order_status?>">

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">분류</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <select class="form-control" name="sch_food_code" style="width:200px" >                                                
                                                    <option value="" <?=($sch_food_code == '' ? 'selected="selected"' : '' )?> >전체</option>

                                                    <?php
                                                        foreach( $food_types AS $key=>$val ) {
                                                    ?>
                                                    <option value="<?=$key?>" <?=($key == $sch_food_code) ? 'selected="selected"' : '' ?> ><?=$val?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">구분</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <select class="form-control" name="sch_task_type" style="width:200px" >  
                                                    <option value="" <?=($sch_task_type == '' ? 'selected="selected"' : '' )?> >전체</option>
                                                    <?php
                                                        foreach( $task_type_arr AS $key=>$val ) {
                                                    ?>
                                                    <option value="<?=$key?>" <?=($sch_task_type == $key ? 'selected="selected"' : '' )?> ><?=$val?></option>
                                                    <?php
                                                        }
                                                    ?>                           
                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">유통기한</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_s_date" value="<?=$sch_s_date;?>">
                                                <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_e_date" value="<?=$sch_e_date;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">검색</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="품목, 주문번호 ">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-offset-5 col-sm-7 m-t-15">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='./<?=$page_name?>_list?top_code=<?=$top_code?>&left_code=<?=$left_code?>'">기본설정</button>
                                            <!-- <button type="reset" class="btn btn-primary waves-effect waves-light">기본설정</button> -->
                                            <button type="submit" class="btn btn-inverse waves-effect m-l-5">검색</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 재고현황 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
                            <b>재고현황</b>                            
						</h5>
						<hr class="m-t-0">					
                        <div class="col-lg-12 table-responsive m-b-0">
							<div class="amount_wrap">
                                <ul class="amount_list">
                                    <?php
                                        foreach($products AS $key=>$value) {
                                    ?>
                                    <li>
                                        <dl class="amount_content">
                                            <dt>
                                                <h3><?=$value['product_name']?></h3>
                                                <?php
                                                    if( $value['stock_quantity'] > 0 ) {
                                                ?>
                                                (<?=$value['product_unit'];?><?=$value['product_unit_type'];?> X <?=$value['packaging_unit_quantity'];?>)
                                                <?php
                                                    }
                                                ?>
                                                <span class="amount"><?=number_format($value['stock_quantity']);?></span>
                                            </dt>
                                            <div class="amount_line"></div>
                                            <dd>
                                                <span class="amount_tit">입고수량</span>
                                                <span class="amount_txt"><?=number_format($value['total_in_quantity']);?></span>
                                            </dd>
                                            <dd>
                                                <span class="amount_tit">총 사용수량</span>
                                                <span class="amount_txt"><?=number_format($value['use_quantity']);?></span>
                                            </dd>
                                            <dd class="text-indent">
                                                <span class="amount_tit">사용</span>
                                                <span class="amount_txt"><?=number_format($value['total_use_quantity']);?></span>
                                            </dd>                                            
                                            <dd class="text-indent">
                                                <span class="amount_tit">폐기</span>
                                                <span class="amount_txt"><?=number_format($value['total_discard_quantity']);?></span>
                                            </dd>                                            
                                        </dl>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
						</div>
						<div class="form-group row"></div>                                       

                        </div>
                    </div>
                </div>
            </div>
            <!-- //재고현황 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h5 class="header-title m-t-0">
                            <b>총(<?=number_format($paging->total_rs)?>)건 / 총 수량 ( <?=number_format($total_quantity)?> )</b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable" style="min-width:1900px" >
                                <thead>
                                    <tr class="active">
                                        <th class="info sorting" data-order="reg_date" >처리일시</th>
                                        <th class="info sorting" data-order="schedule_date" >생산일</th>
                                        <th class="info sorting" data-order="expiration_date" >유통기한</th>                                        
                                        <th class="info sorting" data-order="product_name" style="width: 20%;">제품명</th>                                                                               
                                        <th class="info " style="width: 20%;">제품정보</th>                                                                               
                                        <th class="info sorting" data-order="product_quantity" >수량</th>
                                        <th class="info sorting" data-order="task_type" >구분</th>                                                                                                      
                                        <th class="info sorting" data-order="memo" style="width: 200px;" >메모</th>                                                                                                      
                                        <th class="info " style="width: 200px;" >작업</th>                                                                                                      
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=$value['reg_date'];?></td>
                                        <td><?=$value['schedule_date'];?></td>
                                        <td><?=$value['expiration_date'];?></td>
                                        <td><?=$value['product_name'];?></td>
                                        <td><?=$value['product_unit'];?><?=$value['product_unit_type'];?> X <?=$value['packaging_unit_quantity'];?></td>                                
                                        <td><?=number_format($value['product_quantity']);?>박스</td>                     
                                        <td>
                                            <?=$task_type_arr[ $value['task_type'] ]?>                                            
                                        </td>            

                                        <td>                            
                                            <?=nl2br($value['memo']);?>
                                        </td>                            
                                        <td>
                                            <?php
                                                if( $value['task_type'] == 'I' ) {
                                            ?>
                                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light" onclick="showAddTaskLayer('U', '<?=$value['stock_idx'];?>')" >사용</button>                                            
                                            <button type="button" class="btn btn-sm btn-inverse waves-effect waves-light" onclick="showAddTaskLayer('D', '<?=$value['stock_idx'];?>')" >폐기</button>
                                            <?php
                                                } else {
                                            ?>
                                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delProc('<?=$value['stock_idx'];?>')" >삭제</button>
                                            <?php
                                                }
                                            ?>
                                            
                                        </td>                                        
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="9">데이터가 없습니다</td></tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>                                       
                            </table>

                            <form name="list_form" id="list_form" method="post" action="./<?=$page_name?>_proc" >
                                <input type="hidden" name="mode" id="mode" />
                                <input type="hidden" name="stock_idx" id="stock_idx" />
                                <input type="hidden" name="page" value="<?=$page?>">
                                <input type="hidden" name="list_rows" value="<?=$list_rows?>">                                                        
                                <input type="hidden" name="top_code" value="<?=$top_code?>">
                                <input type="hidden" name="left_code" value="<?=$left_code?>">
                                <input type="hidden" name="ref_params" value="<?=$params?>" />
                            </form>
                        </div>
                        <div class="text-center">
                            <div class="pagination">                    
                                <?=$paging->draw(); ?>
                            </div>
                        </div>

                        <?php include_once( $this->getViewPhysicalPath( '/view/inc/select_list_rows.php' )  ); ?>

                    </div>                       
                </div>
            </div><!-- end row --> 

        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->

<!-- 재고 사용 레이어  -->
<div id="material_task_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0" style="width:800px" >
                <div class="panel-heading">
                    <!-- <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button> -->
                    <h3 class="panel-title" id="modal_title" ></h3>
                    <input type="hidden" id="task_type" >
                    <input type="hidden" id="task_stock_idx" >
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <form id="material_task_form" >   
                            <table class="table table-bordered text-left">
                                <tbody>
                                    <tr>
                                        <td class="info text-center wper20">현재수량</td>
                                        <td class="text-center wper30" >
                                            <span id="current_quantity" ></span> <span id="net_contents" ></span>
                                        </td>
                                        
                                    </tr> 
                                    <tr>
                                        <td class="info text-center wper20">수량</td>
                                        <td class="text-center wper30" style="text-align:left">
                                            <input class="form-control" type="text" id="use_quantity" data-valid='num' >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="info text-center wper20">내역</td>
                                        <td class="text-center wper30">
                                            <textarea class="form-control" id="memo"  ></textarea>
                                        </td>
                                    </tr> 
                                    
                                </tbody>
                            </table>
                            </form>
                            
                            <div class="form-group">
                                <div class="text-center">                                   
                                    <button type="button" class="btn btn-primary waves-effect waves-light m-t-10" onclick="addTask();" >저장</button>
                                    <button type="button" class="btn btn-inverse waves-effect waves-light m-t-10 m-l-15" onclick="closeModal('material_use_modal'); return false;">
                                        취소
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>                                    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- // 재고 사용 레이어  -->

<script>

    function showAddTaskLayer( arg_type, arg_stock_idx ) {
        
        $('#current_quantity').text('');
        $('#use_quantity').val('');
        $('#net_contents').text('박스');
        $('#task_type').val( arg_type );
        $('#task_stock_idx').val( arg_stock_idx );

        getStock( arg_stock_idx );

        switch( arg_type ) {
            case 'U' : {
                $('#modal_title').text('제품 사용처리');
                break;
            }
            case 'R' : {
                $('#modal_title').text('제품 반품처리');
                break;
            }
            case 'D' : {
                $('#modal_title').text('제품 폐기처리');
                break;
            }
        }

        
        $('#material_task_modal').modal();
        $('#use_quantity').focus();

    }

    function getStock( arg_stock_idx ) {

        jqueryAjaxCall({
            type : "post",
            url : '/product/get_stocks_json',
            dataType : "json",
            paramData :{
                stock_idx : arg_stock_idx                          
            } ,
            callBack : function( arg_result ){
                // console.log( arg_result );
                if( arg_result.status == 'success' ){
                    $('#current_quantity').text( arg_result.stock_quantity );
                } 
            }
        });

    }

    function addTask(){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'material_task_form' ) === true ) {

            var task_type = $('#task_type').val();    
            var get_use_quantity = $('#use_quantity').val();
            var memo = $('#memo').val();

            jqueryAjaxCall({
                type : "post",
                url : '/product/task_stocks_json',
                dataType : "json",
                paramData : {
                    stock_idx : $('#task_stock_idx').val()
                    ,task_type : task_type                          
                    ,use_quantity : get_use_quantity                          
                    ,memo : memo                          
                } ,
                callBack : function( arg_result ){
                    
                    if( arg_result.status == 'success' ){
                        alert( arg_result.msg );
                        location.reload();
                    } else {
                        alert( arg_result.msg );
                        
                    }
                }
            });

        }

        
    }

    function closeModal( arg_id ){

        $('#material_task_modal').modal('hide');
        $('#use_quantity').val('');

    }

    function delProc( arg_idx ){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#mode').val('del');
            $('#stock_idx').val(arg_idx);
            $('#list_form').submit();
        }

    }

</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
