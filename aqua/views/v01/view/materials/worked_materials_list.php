<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    가공원료 기준등록
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


                                <!-- <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">분류</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <select class="form-control" name="sch_material_kind" style="width:200px" >                                                
                                                <option value="" <?=($sch_material_kind == '' ? 'selected="selected"' : '' )?> >전체</option>
                                                <option value="raw" <?=($sch_material_kind == 'raw' ? 'selected="selected"' : '' )?> >원자재</option>
                                                <option value="sub" <?=($sch_material_kind == 'sub' ? 'selected="selected"' : '' )?> >부자재</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">등록일</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_s_date" value="<?=$sch_s_date;?>">
                                                <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_e_date" value="<?=$sch_e_date;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">사용여부</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <select class="form-control" name="sch_use_flag" style="width:200px" >                                                
                                                <option value="" <?=($sch_use_flag == '' ? 'selected="selected"' : '' )?> >전체</option>
                                                <option value="Y" <?=($sch_use_flag == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($sch_use_flag == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">검색</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="품목">
                                        </div>
                                    </div>
                                </div> -->

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
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" >
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
                                        <th class="info sorting" data-order="entry_no" style="width: 5%">No</th>
                                        <th class="info sorting" data-order="material_idx"  style="width: 10%;">품목코드</th>
                                        <th class="info sorting" data-order="material_name" style="width: 30%;" >품목</th>                                                                        
                                        <th class="info sorting" data-order="net_contents" >단위용량(중량)</th>
                                        <th class="info sorting" data-order="reg_date" >등록일</th>                                        
                                        <th class="info sorting" data-order="use_flag" >사용여부</th>                                                                     
                                        <th class="info" >삭제</th>                                                       
                                        <!-- <th class="info sorting" data-order="material_kind" >분류</th>               -->
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=$value['entry'];?></td>
                                        <td><?=$value['material_idx'];?></td>
                                        <!-- <td><?=( $value['material_kind'] == 'raw' ) ? '원자재' : '부자재' ;?></td> -->
                                        <td><?=$value['material_name'];?></td>
                                        <td><?=$value['net_contents'];?></td>
                                        <td><?=$value['reg_date'];?></td>
                                        <td><?=$value['use_flag'];?></td>
                                        <td>
                                            <a href="./<?=$page_name?>_write?mode=edit&page=<?=$page?><?=$params?>&material_idx=<?=$value['material_idx'];?>">
                                                <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" >수정</button>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="delProc('<?=$value['material_idx'];?>')">삭제</button>
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
                                <input type="hidden" name="mode" id="list_form_mode" />
                                <input type="hidden" name="material_idx" id="material_idx" />
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
    function delProc( arg_idx ){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#list_form_mode').val('del');
            $('#material_idx').val(arg_idx);
            $('#list_form').submit();
        }

    }
</script>

            
