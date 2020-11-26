<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    협력업체 정보 
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
                                                <option value="companyName" <?=($searchType == 'companyName' ? 'selected="selected"' : '' )?> >회사명</option>
                                                <option value="registrationNo" <?=($searchType == 'registrationNo' ? 'selected="selected"' : '' )?> >사업자등록번호</option>
                                                <option value="managerName" <?=($searchType == 'managerName' ? 'selected="selected"' : '' )?> >담당자명</option>
                                                <option value="phoneNo" <?=($searchType == 'phoneNo' ? 'selected="selected"' : '' )?> >휴대폰번호</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="회사명, 사업자등록번호, 담당자명, 휴대폰번호">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-offset-5 col-sm-7 m-t-15">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='./<?=$page_name?>_list?top_code=<?=$top_code?>&left_code=<?=$left_code?>'">기본설정</button>
                                            <button type="submit" class="btn btn-inverse waves-effect m-l-5" onclick="location.href='./<?=$page_name?>_list?top_code=<?=$top_code?>&left_code=<?=$left_code?>&sch_keyword=<?=$sch_keyword?>'">검색</button>
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
                                        <th class="info" style="width: 3%;">NO</th>
                                        <th class="info sorting " data-order="reg_date" >등록일</th>
                                        <th class="info sorting " data-order="company_name" style="width: 10%;">회사명</th> 
                                        <th class="info sorting " data-order="registration_no" >사업자등록번호</th>
                                        <th class="info sorting " data-order="ceo_name" >대표명</th>
                                        <th class="info sorting " data-order="company_tel" >전화번호</th>
                                        <th class="info sorting " data-order="manager_name" >담당자</th>
                                        <th class="info sorting " data-order="manager_phone_no" >휴대폰번호</th>
                                        <th class="info sorting " data-order="manager_email" >이메일</th>                                                                                                         
                                        <th class="info sorting " data-order="use_flag" >사용여부</th>                                                                                                         
                                        <th class="info " >삭제</th>                                                                                                         
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td><?=$value['reg_date'];?></td>
                                        <td>
                                            <a class="underline" href="./<?=$page_name?>_write?mode=edit&page=<?=$page?><?=$params?>&material_company_idx=<?=$value['material_company_idx'];?>">
                                                <?=$value['company_name'];?>
                                            </a>
                                        </td>
                                        <td><?=$value['registration_no'];?></td>
                                        <td><?=$value['ceo_name'];?></td>
                                        <td><?=$value['company_tel'];?></td>
                                        <td><?=$value['manager_name'];?></td>
                                        <td><?=$value['manager_phone_no'];?></td>
                                        <td><?=$value['manager_email'];?></td>
                                        <td><?=($value['use_flag'] == 'Y') ? '사용' : '미사용' ;?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="delProc('<?=$value['material_company_idx'];?>')">삭제</button>
                                        </td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="11">데이터가 없습니다</td></tr>
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
                <input type="hidden" name="material_company_idx" id="material_company_idx" />
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
            $('#material_company_idx').val(arg_idx);
            $('#list_form').submit();
        }
        
    }
</script>
            
