<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    원/부자재 입고관리
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="location.href='./<?=$page_name?>_write?page=<?=$page?><?=$params?>'">+입고등록</button>                 
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
                                                <select class="form-control" name="sch_process_state" style="width:200px" >                                                
                                                <option value="" <?=($sch_process_state == '' ? 'selected="selected"' : '' )?> >전체</option>
                                                <option value="O" <?=($sch_process_state == 'O' ? 'selected="selected"' : '' )?> >주문</option>
                                                <option value="W" <?=($sch_process_state == 'W' ? 'selected="selected"' : '' )?> >입고</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">입고일</label>
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
                                        <label class="col-sm-2 control-label">검색</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="자재명, 회사명, 주문번호, 담당자명 ">
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
                            <b>목록</b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info sorting" data-order="order_idx"  style="width: 10%;">주문번호</th>
                                        <th class="info sorting" data-order="order_date" >주문일</th>
                                        <th class="info sorting" data-order="receipt_date" >입고일</th>
                                        <th class="info sorting" data-order="material_name" style="width: 10%;">자재명</th> 
                                        <th class="info sorting" data-order="quantity" >입고수량</th>                                        
                                        <th class="info sorting" data-order="company_name" >회사명</th>
                                        <th class="info sorting" data-order="manager_name" >담당자명</th>
                                        <th class="info sorting" data-order="manager_phone_no" >담당자연락처</th>
                                        <th class="info sorting" data-order="process_state" >상태</th>                                                                     
                                        <th class="info" >수정</th>                                                                     
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=$value['order_idx'];?></td>
                                        <td><?=$value['order_date'];?></td>
                                        <td><?=$value['receipt_date'];?></td>
                                        <td><?=$value['material_name'];?></td>
                                        <td><?=number_format($value['quantity']);?></td>                                        
                                        <td><?=$value['company_name'];?></td>                                        
                                        <td><?=$value['manager_name'];?></td>
                                        <td><?=$value['manager_phone_no'];?></td>
                                        <td><?=$process_state_arr[ $value['process_state'] ]?></td>
                                        <td>
                                            <?php
                                                if( $value['approval_state'] == 'R' ) {
                                            ?>                                                                                  
                                            <button type="button" class="btn btn-sm btn-default waves-effect waves-light" onclick="alert('준비중입니다.')" >육안검사일지확인</button>
                                            <?php
                                                } 
                                            ?>
                                            <?php
                                                if( $value['approval_state'] !== 'W' ) {
                                            ?>                                                                                  
                                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light" onclick="alert('준비중입니다.')" >승인</button>
                                            <?php
                                                } 
                                            ?>
                                            <?php
                                                if( $value['approval_state'] == 'W'  ) {   
                                            ?>  
                                                <a href="./<?=$page_name?>_write?mode=edit&page=<?=$page?><?=$params?>&order_idx=<?=$value['order_idx'];?>">
                                                    <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" onclick="warehouseProc('<?=$value['order_idx'];?>')" >입고확인</button>
                                                </a>
                                            <?php
                                                    
                                                }
                                            ?> 
                                          
                                        </td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="10">데이터가 없습니다</td></tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>                                       
                            </table>

                            <form name="list_form" id="list_form" method="post" action="./order_proc" >
                                <input type="hidden" name="mode" id="mode" />
                                <input type="hidden" name="order_idx" id="order_idx" />
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
<script>
    function cancelOrder( arg_order ) {
        
        if( confirm('해당 주문을 취소처리 하시겠습니까?') == true ) {
            $('#mode').val('order_cancel');
            $('#order_idx').val( arg_order );
            $('#list_form').submit();
        }

    }
</script>

            
