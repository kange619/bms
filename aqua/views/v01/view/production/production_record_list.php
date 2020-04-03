<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    제품 생산 이력관리
                    <!-- <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="location.href='./<?=$page_name?>_write?page=<?=$page?><?=$params?>'">+등록</button>                  -->
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

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">상태</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <select class="form-control" name="sch_production_status" style="width:200px" >     
                                                    <option value="" <?=($sch_production_status == '' ? 'selected="selected"' : '' )?> >전체</option>
                                                    <?php
                                                        foreach( $production_status_arr AS $key=>$item ) {
                                                    ?>                                            
                                                    <option value="<?=$key?>" <?=($key == $sch_production_status ? 'selected="selected"' : '' )?> ><?=$item?></option>
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
                                        <label class="col-sm-3 control-label">지시일시</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_s_date" value="<?=$sch_s_date;?>">
                                                <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_e_date" value="<?=$sch_e_date;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">생산 예정일</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_schedule_s_date" value="<?=$sch_schedule_s_date;?>">
                                                <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_schedule_e_date" value="<?=$sch_schedule_s_date;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">검색</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="제조번호, 제품명, 지시자 ">
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h5 class="header-title m-t-0">
                            <b>총 <?=$paging->total_rs?>건 / 총 생산량 : <?=number_format($total_schedule_quantity)?> Kg / <?=number_format($total_pouch_quantity)?> 봉 </b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info sorting" data-order="produce_no"  style="width: 10%;">제조번호</th>                                                                                 
                                        <th class="info sorting" data-order="schedule_date" >제조일자</th>
                                        <th class="info sorting" data-order="product_name"  style="width: 10%;">제품명</th>                                        
                                        <th class="info " >포장단위</th>
                                        <th class="info sorting" data-order="schedule_quantity" >생산량</th>
                                        <th class="info sorting" data-order="expiration_date" >유통기한(일수)</th>
                                        <th class="info sorting" data-order="member_name" >지시자</th>
                                                                                                                                   
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=$value['produce_no'];?></td>
                                        <td><?=$value['schedule_date'];?></td>
                                        <td>                                            
                                            <a href="./<?=$page_name?>_view?page=<?=$page?><?=$params?>&production_idx=<?=$value['production_idx'];?>">  
                                                <?=$value['product_name'];?>
                                            </a>
                                        </td>
                                        
                                        
                                        <td>
                                            <?=$value['product_unit'];?><?=$value['product_unit_type'];?> X <?=$value['packaging_unit_quantity'];?>
                                            <br> <?=$value['pouch_quantity']?> 봉 / <?=$value['box_quantity']?> 박스
                                        </td>
                                        <td><?=number_format($value['schedule_quantity']);?> <?=$value['product_unit_type'];?></td>                                     
                                        <td><?=$value['expiration_date'];?>( <?=$value['expiration_days'];?> )</td>                                     
                                        <td><?=$value['member_name'];?></td>
                                        
                                        
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="7">데이터가 없습니다</td></tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>                                       
                            </table>

                            <form name="list_form" id="list_form" method="post" action="./<?=$page_name?>_proc" >
                                <input type="hidden" name="mode" id="mode" />
                                <input type="hidden" name="production_idx" id="production_idx" />
                                <input type="hidden" name="page" value="<?=$page?>">
                                <input type="hidden" name="list_rows" value="<?=$list_rows?>">                                                        
                                <input type="hidden" name="top_code" value="<?=$top_code?>">
                                <input type="hidden" name="left_code" value="<?=$left_code?>">
                                <input type="hidden" name="ref_params" value="<?=$params?>" />
                                <input type="hidden" name="page_name" value="<?=$page_name?>" />
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
<script>
    function cancelOrder( arg_order ) {
        
        if( confirm('해당 주문을 취소처리 하시겠습니까?') == true ) {
            $('#mode').val('order_cancel');
            $('#production_idx').val( arg_order );
            $('#list_form').submit();
        }

    }

    function delProc( arg_idx ){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#mode').val('del');
            $('#production_idx').val(arg_idx);
            $('#list_form').submit();
        }

    }

</script>

            
