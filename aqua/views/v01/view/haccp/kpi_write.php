<div class="content-page">
    <!-- start content -->
	<div class="content">
		<!-- container -->
        <div class="container">
            <section class="content-header">
              <h1>
                KPI 관리
                <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
              </h1>
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="kpi_idx" value="<?=$kpi_idx?>" />                
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="page_name" value="<?=$page_name?>" />
                <input type="hidden" name="product_name"  id="product_name" value="<?=$product_name?>" />

			<!-- 식품위생서류 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
							<b>기본정보</b>
						</h5>
						<hr class="m-t-0">
						<div class="col-lg-12 table-responsive m-b-0">
                            
                            <table class="table table-bordered text-left">
                                <colgroup width="20%"></colgroup>
                                <colgroup width=""></colgroup>
                                <tbody>
                                    <tr>
                                        <td class="info">제품명</td>
                                        <td>
                                            <select class="form-control" name="product_idx" id="product_idx" style="width:200px" data-valid="blank" >
                                                <option value="">제품을 선택하세요</option>
                                                <?php
                                                    foreach( $products AS $key=>$val ) {
                                                ?>
                                                <option value="<?=$val['product_idx']?>" <?=($product_idx == $val['product_idx'] ) ? 'selected="selected"' : '' ?>><?=$val['product_name']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="info">생산기간</td>
                                        <td colspan="3">                                            
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="production_start_date" id="production_start_date" value="<?=$production_start_date?>" data-valid="blank" >
                                                        <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                        <input type="text" class="form-control datepicker " name="production_end_date" id="production_end_date" value="<?=$production_end_date?>" data-valid="blank" >
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <!-- <tr>
                                        <td class="info">측정일자</td>
                                        <td colspan="3">                                            
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="check_start_date" id="check_start_date" value="<?=$check_start_date?>" data-valid="blank" >
                                                        <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                        <input type="text" class="form-control datepicker " name="check_end_date" id="check_end_date" value="<?=$check_end_date?>" data-valid="blank" >
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <h5 class="header-title m-t-40">
                                <b>KPI 정보</b>
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center">
                                <colgroup width="5%"></colgroup>
                                <colgroup width="25%"></colgroup>
                                <colgroup width="30%"></colgroup>
                                <colgroup width="20%"></colgroup>
                                <colgroup width="20%"></colgroup>
                                <thead>
                                    <tr>
                                        <th class="info">항목</th>
                                        <th class="info">제목</th>
                                        <th class="info">계산방법</th>
                                        <th class="info">입력</th>
                                        <th class="info">측정치</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>P</td>
                                        <td>시간당/일일생산량</td>
                                        <td>주문량/총 작업시간</td>
                                        <td><input type="text" id="P_txt1" class="form-control" name="order_quantity" style="width:45%" placeholder="주문량" value="<?=$order_quantity?>"  /> / <input type="text" class="form-control" id="P_txt2" name="total_work_time" style="width:45%" placeholder="총 작업시간" value="<?=$total_work_time?>" /></td>
                                        <td><input type="text" id="kpi_p" class="form-control" name="kpi_p" value="<?=$kpi_p?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Q</td>
                                        <td>공정불량율 감소</td>
                                        <td>공정별 불량수량/공정별 생산량</td>
                                        <td><input type="text" id="Q_txt1" class="form-control" name="faulty_quantity" style="width:45%" placeholder="공정별 불량수량" value="<?=$faulty_quantity?>" /> / <input type="text" class="form-control" id="Q_txt2" name="production_output" style="width:45%" placeholder="공정별 생산량" value="<?=$production_output?>" /></td>
                                        <td><input type="text" id="kpi_q" class="form-control" name="kpi_q" value="<?=$kpi_q?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>BOM 정확도</td>
                                        <td>BOM소요량/실제소요량</td>
                                        <td><input type="text" id="C_txt1" class="form-control" name="bom_cost" style="width:45%" placeholder="BOM소요량" value="<?=$bom_cost?>" /> / <input type="text" class="form-control" id="C_txt2" name="real_cost" style="width:45%" placeholder="실제소요량" value="<?=$real_cost?>" /></td>
                                        <td><input type="text" id="kpi_c" class="form-control" name="kpi_c"  value="<?=$kpi_c?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>D</td>
                                        <td>납기지연 비율 감소</td>
                                        <td>납기지연수량/총출하량</td>
                                        <td><input type="text" id="D_txt1" class="form-control" name="delay_quantity" style="width:45%" placeholder="납기지연수량" value="<?=$delay_quantity?>" /> / <input type="text" class="form-control" id="D_txt2" name="total_shipment_quantity" style="width:45%" placeholder="총출하량" value="<?=$total_shipment_quantity?>"  /></td>
                                        <td><input type="text" id="kpi_d" class="form-control" name="kpi_d" value="<?=$kpi_d?>" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        
						</div>
						<div class="form-group row"></div>
					</div>
				</div>
			</div>
			<!-- //식품위생서류 -->
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
<script>

/**
* 저장 버튼 동작
*/
function register(){

    viewFormValid.alert_type = 'add';        
    if( viewFormValid.run( 'form_write' ) === true ) {
      // submit

        $( '#product_name' ).val( $("#product_idx option:checked").text() );

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

kpiCalc();
function kpiCalc() {
    $("#P_txt1,#P_txt2").keyup(function(){
        var P_txt1 = parseFloat($("#P_txt1").val());
        var P_txt2 = parseFloat($("#P_txt2").val());
        var result1 = P_txt1 / P_txt2;
        if(isNaN(result1)) {
            result1 = 0;
        }
        $("#kpi_p").val(result1.toFixed(2));
    });

    $("#Q_txt1,#Q_txt2").keyup(function(){
        var Q_txt1 = parseFloat($("#Q_txt1").val());
        var Q_txt2 = parseFloat($("#Q_txt2").val());
        var result2 = Q_txt1 / Q_txt2;
        if(isNaN(result2)) {
            result2 = 0;
        }
        $("#kpi_q").val(result2.toFixed(2));
    });

    $("#C_txt1,#C_txt2").keyup(function(){
        var C_txt1 = parseFloat($("#C_txt1").val());
        var C_txt2 = parseFloat($("#C_txt2").val());
        var result3 = C_txt1 / C_txt2;
        if(isNaN(result3)) {
            result3 = 0;
        }
        $("#kpi_c").val(result3.toFixed(2));
    });

    $("#D_txt1,#D_txt2").keyup(function(){
        var D_txt1 = parseFloat($("#D_txt1").val());
        var D_txt2 = parseFloat($("#D_txt2").val());
        var result4 = D_txt1 / D_txt2;
        if(isNaN(result4)) {
            result4 = 0;
        }
        $("#kpi_d").val(result4.toFixed(2));
    });
};
</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>