<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    모니터링 이탈관리
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="documentWrite('add', '')" >+등록</button>                 
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
                                        <label class="col-sm-3 control-label">측정시간</label>
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
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="저장고명">
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
                                        <th class="info " style="width: 3%;">NO</th>
                                        <th class="info sorting" data-order="storage_name"  style="width: 20%;">저장고명</th>                                         
                                        <th class="info sorting" data-order="warning_temperature" style="width: 20%;" >측정값</th>
                                        <th class="info sorting" data-order="reg_date" style="width: 20%;" >측정시간</th>
                                        <th class="info " >한계범위</th>
                                        <th class="info " >변경</th>
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr data-row_items="<?=preg_replace( '/\"/', "'" ,json_encode( $value, JSON_UNESCAPED_UNICODE ))?>" >
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td>
                                            <a href="./<?=$page_name?>_view?page=<?=$page?><?=$params?>&warning_idx=<?=$value['warning_idx'];?>">
                                                <?=$value['storage_name'];?>
                                            </a>
                                        </td>
                                        <td><?=$value['warning_temperature'];?>℃</td>
                                        <td><?=$value['reg_date'];?></td>
                                        <td><?=$value['limit_range'];?>℃</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" onclick="documentWrite('edit', this)" data-row_items="<?=preg_replace( '/\"/', "'" ,json_encode( $value, JSON_UNESCAPED_UNICODE ))?>" >수정</button>
                                            <button type="button" class="btn btn-danger" onclick="delProc('<?=$value['warning_idx'];?>')">삭제</button>
                                        </td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="6">데이터가 없습니다</td></tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>                                       
                            </table>

                            <form name="list_form" id="list_form" method="post" action="<?=$page_name?>_proc" >
                                <input type="hidden" name="mode" id="list_mode" />
                                <input type="hidden" name="warning_idx" id="warning_idx" />
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

<!-- 이탈사항 등록 -->
<div id="write_layer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">이탈사항</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" name="write_layer_form" id="write_layer_form" action="<?=$page_name?>_proc" >
							    <input type="hidden" name="mode" id="layer_mode"  />							    					    
                                <input type="hidden" name="warning_idx" id="layer_warning_idx" />
                                <input type="hidden" name="page" value="<?=$page?>" />
                                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                                <input type="hidden" name="ref_params" value="<?=$params?>" />
                                <input type="hidden" name="page_name" value="<?=$page_name?>" />                                

                            <table class="table table-bordered text-left">
                                <tbody>
                                    <tr>
                                        <td class="info text-center wper20">이탈발생 저장고</td>
                                        <td class="wper80">
                                            <select class="form-control" name="storage_idx" id="storage_idx" data-valid="blank" >
                                                <option value="">선택하세요</option>
                                                <?php
                                                    foreach( $storages AS $key=>$val ) {
                                                ?>
                                                <option value="<?=$val['storage_idx']?>"><?=$val['storage_name']?></option>
                                                <?php
                                                    }
                                                ?>
                                              
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="info text-center wper20">측정온도</td>
                                        <td class="wper80">
                                            <input type="text" class="form-control" id="warning_temperature" name="warning_temperature" data-valid="blank" >
                                        </td>
                                    </tr>									
                                    <tr>
                                        <td class="info text-center">이탈원인</td>
                                        <td class="">
                                            <textarea class="form-control" name="warning_cause" id="warning_cause" cols="30" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="info text-center">이탈조치사항</td>
                                        <td class="">
                                            <textarea class="form-control" name="warning_action" id="warning_action" cols="30" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
							<button type="button" class="btn btn-primary waves-effect waves-light m-t-10" id="reg_btn1" onclick="reqeustSubmit('write_layer_form')">
								저장
							</button>
							<button type="button" class="btn btn-inverse waves-effect waves-light m-t-10 m-l-15" onclick="closeModal()">
								취소
							</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //이탈사항 등록 -->

<script>
    /**
        문서 등록 레이어 노출 동작 
     */
    function documentWrite( arg_type, arg_element ){

        $('#warning_idx').val('');
        $('#storage_idx').val('');
        $('#warning_temperature').val('');
        $('#warning_cause').val('');
        $('#warning_action').val('');
        
        switch( arg_type ) {
            case 'add' : {
                $('#layer_mode').val('ins');
                break;
            }
            case 'edit' : {
                
                var data = JSON.parse( $(arg_element).parent().parent().data('row_items').replace(/'/g, '"') );

                $('#layer_mode').val('edit');

                $('#storage_idx').val(data.storage_idx);
                $('#warning_temperature').val(data.warning_temperature);
                $('#warning_cause').val(data.warning_cause);
                $('#warning_action').val(data.warning_action);
                $('#layer_warning_idx').val(data.warning_idx);
               
                break;
            }
        }

        $('#write_layer').modal();
    }

    /**
        서버 전송 요청
     */
    function reqeustSubmit( arg_form_id ){
        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( arg_form_id ) === true ) {
            // submit
            $('#' + arg_form_id).submit();
        }
    }

    
    function closeModal(){

        $('#write_layer').modal('hide');
        $('#df_title').val('');

    }


    function delProc( arg_idx ){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#list_mode').val('del');
            $('#warning_idx').val(arg_idx);
            $('#list_form').submit();
        }

    }

</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>

            
