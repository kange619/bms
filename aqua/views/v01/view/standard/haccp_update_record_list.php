<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    HACCP 개정 이력관리
                    <!-- <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="documentWrite('add', '')" >+등록</button>                  -->
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
                                        <label class="col-sm-3 control-label">반영일</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_apply_s_date" value="<?=$sch_apply_s_date;?>">
                                                <span class="input-group-addon bg-primary b-0 text-white">~</span>
                                                <input type="text" class="form-control datepicker" readonly="readonly" name="sch_apply_e_date" value="<?=$sch_apply_e_date;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">검색</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="기준서명">
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
                            <b>HACCP 기준서</b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info " style="width: 3%;">NO</th>
                                        <th class="info sorting" data-order="df_apply_date" style="width: 20%;" >등록일(반영일)</th>
                                        <th class="info sorting" data-order="df_title"  style="width: 20%;">기준서명</th>                                         
                                        <th class="info "  >제/개정 내용</th>
                                        <th class="info " style="width: 30%;" >첨부파일</th>
                                        <th class="info " >승인/승인자</th>
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr data-row_items="<?=preg_replace( '/\"/', "'" ,json_encode( $value, JSON_UNESCAPED_UNICODE ))?>" >
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td><?=$value['df_apply_date'];?></td>
                                        <td><?=$value['df_title'];?></td>
                                        <td><button class="btn btn-default" onclick="viewData(this);">상세보기</button></td>
                                        <td>
                                            <a href="/file_down.php?key=<?=$value['file_idx'];?>" ><?=$value['origin_name'];?></a>
                                        </td>    
                                        
                                        <td>
                                            <?php
                                                if( $value['df_approve_stauts'] == 'W') {
                                            ?>
                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" onclick="approve(this)" >승인</button>
                                            <?php
                                                } else {
                                                    echo( $value['approve_name'] );
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="4">데이터가 없습니다</td></tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>                                       
                            </table>

                            <form name="list_form" id="list_form" method="post" action="standard_proc" >
                                <input type="hidden" name="mode" id="list_mode" />
                                <input type="hidden" name="df_idx" id="df_idx" />
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


<!-- 상세보기 -->
<div id="doc_detail_layer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">HACCP 개정 상세보기</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <form class="form-horizontal" role="form" method="post" name="frm_data1" action="" enctype="multipart/form-data">
                                <input type="hidden" id="" name="" value="" />
                                <input type="hidden" id="" name="" value="" />
                                <!-- 제품정보 -->
                                <table class="simple_table">
                                    <colgroup width="50%"></colgroup>
                                    <colgroup width="50%"></colgroup>
                                    <thead>
                                        <tr>
                                            <th class="info" colspan="2">
                                                <h3>개정내용 상세보기</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="info text-left">기준서명</td>
                                            <td class="text-right" id="layer_df_title" ></td>
                                        </tr>
                                        <tr>
                                            <td class="info text-left">등록일(반영일)</td>
                                            <td class="text-right" id="layer_df_apply_date" ></td>
                                        </tr>
                                        <tr>
                                            <td class="info text-left" colspan="2">
                                                <strong class="strong_tit">제/개정 내용</strong>
                                                <p><pre class="font-pre" id="layer_df_contents" ></pre></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="info text-left" colspan="2">
                                                <strong class="strong_tit">제/개정 사유</strong>
                                                <p><pre class="font-pre" id="layer_df_reason" ></pre></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary waves-effect waves-light m-t-10" id="layer_approve_btn" onclick="layerApprove()">
								승인
							</button>
                            <button type="button" class="btn btn-inverse waves-effect waves-light m-t-10 m-l-15" onclick="closeModal()">
								닫기
							</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //상세보기 -->

<script>

    /**
        문서 등록 레이어 노출 동작 
     */
    var current_data = {};
    function viewData( arg_this ){
        
        current_data = JSON.parse( $(arg_this).parent().parent().data('row_items').replace(/'/g, '"') );

        $('#layer_df_title').html(current_data.df_title);
        $('#layer_df_apply_date').html(current_data.df_apply_date);
        $('#layer_df_contents').html(current_data.df_contents);
        $('#layer_df_reason').html(current_data.df_reason);

        if( current_data.df_approve_stauts == 'W' ) {
            $('#layer_approve_btn').show();
        } else {
            $('#layer_approve_btn').hide();
        }
        

        $('#doc_detail_layer').modal();

    }

    function layerApprove() {
        
        if(confirm('승인 처리하시겠습니까?') == true ){
            $('#list_mode').val('approve');
            $('#df_idx').val(current_data.df_idx);
            $('#list_form').submit();
        }

    }

    function closeModal(){

        $('#doc_detail_layer').modal('hide');        

    }

    function approve( arg_this ){

        if(confirm('승인 처리하시겠습니까?') == true ){

            current_data = JSON.parse( $(arg_this).parent().parent().data('row_items').replace(/'/g, '"') );

            $('#list_mode').val('approve');
            $('#df_idx').val(current_data.df_idx);
            $('#list_form').submit();
        }

    }

</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>

            
