<!-- <?php
var_dump($list);
?> -->


<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    생산담당자 관리 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="location.href='./<?=$page_name?>_write?mode=ins&page=<?=$page?><?=$params?>'">추가</button>
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
                                
                                <!-- 11/23/20 kange Add 검색필터 추가 -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">가입일</label>

                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="text" class="form-control datepicker" readonly="readonly" name="sch_s_date" value="<?=$sch_s_date;?>">
                                            <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                            <input type="text" class="form-control datepicker" readonly="readonly" name="sch_e_date" value="<?=$sch_e_date;?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">상태</label>
                                        <div class="col-sm-2">

                                            <select class="form-control" name="sch_use_flag" style="width:200px" >
                                                <option value="" <?=($sch_use_flag == '' ? 'selected="selected"' : '' )?> >전체</option>
                                                <option value="Y" <?=($sch_use_flag == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($sch_use_flag == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                            </select>

                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="담당자명, 휴대폰번호호">
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
                                <!-- 11/23/20 kange Add 검색필터 추가 -->

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
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 3%;">NO</th>
                                        <th class="info">이름</th>                                                                                
                                        <th class="info">휴대폰번호</th>
                                        <th class="info">업무구분</th>                                                                                                         
                                        <th class="info">업무내용</th>                                                                                                         
                                        <th class="info">보건증갱신기간</th>
                                        <th class="info">정/부</th>
                                        <th class="info">상태</th>
                                                                                                                                     
                                    </tr>                                
                                </thead>        

                                <tbody>
                                    
                                    <tr>
                                        
                                    </tr>

                                </tbody> 

                                <tbody>
                                   
                                    <?php                                                                                     
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <!-- <td><?=( $paging->total_rs - ($page-1) * (int)$list_rs-$key );?></td>                                         -->
                                        <td><?=$value['production_member_idx']?></td>
                                        <td>
                                            <a class="underline" href="./<?=$page_name?>_write?mode=edit&page=<?=$page?><?=$params?>&production_member_idx=<?=$value['production_member_idx'];?>">
                                                <?=$value['name'];?>
                                            </a>
                                        </td>
                                        
                                        <td><?=$value['phone_no'];?></td>
                                        <td><?=$value['work_position'];?></td>
                                        <td><?=$value['work_detail'];?></td>                                                                            
                                        <td><?=$value['health_certi_date'];?></td>
                                        <td><?=$value['person_in_charge'];?></td>
                                        <td><?=$value['use_flag'];?></td>
                                    </tr>
                                    <?php   
                                        }
                                    ?>                                                                    
                                </tbody>                                
                            </table>                            
                        </div>      

                        <?php include_once( $this->getViewPhysicalPath( '/view/inc/select_list_rows.php' )  ); ?>                  
                    </div>                       
                </div>
            </div><!-- end row -->

            <form name="list_form" id="list_form" method="post" action="./<?=$page_name?>_proc">
                <input type="hidden" name="mode" id="ins" />
                <input type="hidden" name="production_member_idx" id="production_member_idx" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
            </form>

        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


            
