<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    생산제품등록
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="location.href='./<?=$page_name?>_write?page=<?=$page?><?=$params?>'">+등록</button>                    
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

<!--                                <div class="col-sm-4">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="col-sm-3 control-label">등록일</label>-->
<!--                                        <div class="col-sm-9">-->
<!--                                            <div class="input-daterange input-group" id="date-range">-->
<!--                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_s_date" value="--><?//=$sch_s_date;?><!--">-->
<!--                                                <span class="input-group-addon bg-primary b-0 text-white">~</span>-->
<!--                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_e_date" value="--><?//=$sch_e_date;?><!--">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="col-sm-6">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="col-sm-2 control-label">검색</label>-->
<!--                                        <div class="col-sm-9">-->
<!--                                            <input type="text" class="form-control" name="sch_keyword" value="--><?//=$sch_keyword;?><!--" placeholder="제품명, 품목보고번호">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="form-group">-->
<!--                                        <div class="col-sm-offset-5 col-sm-7 m-t-15">-->
<!--                                            <button type="submit" class="btn btn-inverse waves-effect m-l-5">검색</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">등록일</label>

                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="text" class="form-control datepicker" readonly="readonly" name="sch_s_date" value="<?=$sch_s_date;?>">
                                            <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                            <input type="text" class="form-control datepicker" readonly="readonly" name="sch_e_date" value="<?=$sch_e_date;?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">검색</label>
                                        <div class="col-sm-2">

                                            <select class="form-control" name="searchType" id="searchType" >
                                                <option value="All" <?=($searchType == 'All' ? 'selected="selected"' : '' )?> >전체</option>
                                                <option value="item" <?=($searchType == 'item' ? 'selected="selected"' : '' )?> >품목</option>
                                                <option value="productName" <?=($searchType == 'productName' ? 'selected="selected"' : '' )?> >제품명</option>
                                                <option value="productRegNo" <?=($searchType == 'productRegNo' ? 'selected="selected"' : '' )?> >제품등록번호</option>
                                                <option value="itemReportNo" <?=($searchType == 'itemReportNo' ? 'selected="selected"' : '' )?> >품목신고번호</option>
                                            </select>

                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="품목, 제품명, 제품등록번호, 품목신고번호">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-offset-5 col-sm-7 m-t-15">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='./<?=$page_name?>_list?top_code=<?=$top_code?>&left_code=<?=$left_code?>'">기본설정</button>
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
                                        <th class="info" scope="col" style="width: 3%;">NO</th>
                                        <th class="info sorting" data-order="reg_date" scope="col" >등록일</th>
                                        <th class="info sorting" data-order="product_name" scope="col" >품목</th>
                                        <th class="info sorting" data-order="product_name" scope="col" >제품명</th>
                                        <th class="info sorting" data-order="item_report_no" scope="col" >제품등록번호</th>
                                        <th class="info sorting" data-order="item_report_no" scope="col" >품목신고번호</th>
<!--                                        <th class="info sorting" data-order="food_code" scope="col" >식품유형</th>                                                          -->
<!--                                        <th class="info sorting" data-order="product_expiration_date" scope="col" >유통기한</th>                                                          -->
<!--                                        <th class="info sorting" data-order="haccp_certify" scope="col" >HACCP 인증</th>                                                          -->

                                        <th class="info" style="width:200px">변경</th>                                                          
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td><?=dateType($value['reg_date'], 8)?></td>
                                        <td><?=$value['product_name']?></td>
                                        <td><?=$value['product_name']?></td>
                                        <td><?=$value['product_registration_no']?></td>
                                        <td><?=$value['item_report_no']?></td>
<!--                                        <td>--><?//=$food_types[ $value['food_code'] ]?><!--</td>-->
<!--                                        <td>--><?//=$value['product_expiration_date']?><!--</td>-->
<!--                                        <td>--><?//=($value['haccp_certify'] == 'Y' ) ? '인증' : '미인증' ?><!--</td>-->

                                        <td>
                                            <a href="./<?=$page_name?>_write?mode=edit&page=<?=$page?><?=$params?>&product_idx=<?=$value['product_idx'];?>">
                                                <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" >수정</button>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="delProc('<?=$value['product_idx'];?>')">삭제</button>
                                        </td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="8">데이터가 없습니다</td></tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>                                       
                            </table>
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
            <form name="list_form" id="list_form" method="post" action="./<?=$page_name?>_proc">
                <input type="hidden" name="mode" id="list_form_mode" />
                <input type="hidden" name="product_idx" id="product_idx" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
            </form>
        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->

<script>
    function delProc( arg_idx ){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#list_form_mode').val('del');
            $('#product_idx').val(arg_idx);
            $('#list_form').submit();
        }
        
    }
</script>            
