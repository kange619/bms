<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    HACCP 이행점검표
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

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">검색</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="업무종류">
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
                            <b>HACCP 이행점검표</b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info " style="width: 3%;">NO</th>
                                        <th class="info sorting" data-order="df_work_checklist_title"  style="width: 10%;">업무종류</th>                                         
                                        <th class="info sorting" data-order="df_work_checklist_doc_title"  style="width: 40%;" >업무내용</th>
                                        <th class="info " >업무처리일정</th>
                                        <th class="info " style="width: 200px;"  >변경</th>
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr data-row_items="<?=preg_replace( '/\"/', "'" ,json_encode( $value, JSON_UNESCAPED_UNICODE ))?>" >
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td><?=$value['df_work_checklist_title'];?></td>
                                        <td><?=$value['df_work_checklist_doc_title'];?></td>
                                        <td>
                                            <?php
                                                $value['df_work_schedule_weeks'] = preg_replace('/0/', '일', $value['df_work_schedule_weeks']);
                                                $value['df_work_schedule_weeks'] = preg_replace('/1/', '월', $value['df_work_schedule_weeks']);
                                                $value['df_work_schedule_weeks'] = preg_replace('/2/', '화', $value['df_work_schedule_weeks']);
                                                $value['df_work_schedule_weeks'] = preg_replace('/3/', '수', $value['df_work_schedule_weeks']);
                                                $value['df_work_schedule_weeks'] = preg_replace('/4/', '목', $value['df_work_schedule_weeks']);
                                                $value['df_work_schedule_weeks'] = preg_replace('/5/', '금', $value['df_work_schedule_weeks']);
                                                $value['df_work_schedule_weeks'] = preg_replace('/6/', '토', $value['df_work_schedule_weeks']);
                                                echo( $value['df_work_schedule_weeks'] );
                                            ?>
                                        </td>
                                        <!-- <td>
                                            <a href="/file_down.php?key=<?=$value['file_idx'];?>" ><?=$value['origin_name'];?></a>
                                        </td>     -->
                                        <td>
                                            <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" onclick="documentWrite('edit', this)" data-row_items="<?=preg_replace( '/\"/', "'" ,json_encode( $value, JSON_UNESCAPED_UNICODE ))?>" >수정</button>
                                            <button type="button" class="btn btn-danger" onclick="delProc('<?=$value['df_idx'];?>')">삭제</button>
                                        </td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="5">데이터가 없습니다</td></tr>
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

<!-- HACCP 점검표 등록 -->
<div id="write_layer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" >
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">HACCP 점검표</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" name="write_layer_form" id="write_layer_form" action="standard_proc" >
							    <input type="hidden" name="mode" id="layer_mode"  />
							    <input type="hidden" name="df_type" value="<?=$df_type?>" />
							    <input type="hidden" name="df_idx" id="layer_df_idx" />
							    <input type="hidden" name="df_group" id="layer_df_group" />
							    <input type="hidden" name="df_sort" id="df_sort" />
                                <input type="hidden" name="page" value="<?=$page?>" />
                                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                                <input type="hidden" name="ref_params" value="<?=$params?>" />
                                <input type="hidden" name="page_name" value="<?=$page_name?>" />
                                <input type="hidden" name="file_idx" id="file_idx" value="" />
                                <input type="hidden" name="df_title" value="HACCP 점검표" />

                            <table class="table table-bordered text-left">
                                <tbody>
                                    <tr>
                                        <td class="info text-center wper20">업무종류</td>
                                        <td class="wper80">
                                            <select class="form-control" name="df_work_checklist" id="df_work_checklist" data-valid="blank" >
                                                <option value="">업무종류를 선택하세요</option>
                                                <?php
                                                    foreach( $work_checklist AS $key=>$val ) {
                                                ?>
                                                <option value="<?=$val['checklist_code']?>"><?=$val['checklist_title']?></option>
                                                <?php
                                                    }
                                                ?>
                                              
                                            </select>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="info text-center wper20">업무내용</td>
                                        <td class="wper80">
                                        <select class="form-control" name="df_work_checklist_doc" id="df_work_checklist_doc" data-valid="blank" >
                                                <option value="">업무내용을 선택하세요</option>
                                                <?php
                                                    foreach( $doc_list AS $key=>$val ) {
                                                ?>
                                                <option value="<?=$val['doc_usage_idx']?>">#<?=$val['item_title']?># <?=$val['doc_title']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <!-- 11/06/2020 kange start -->
                                    <tr>
                                        <th class="info text-center wper20">업무처리유형</th>
                                        <td colspan="3">
                                            <input type="radio" name="workProcessType" id="workProcessType_day"  value="Y"  data-valid="blank"/> 
                                            <label class="m-r-15" for="workProcessType_day">매일</label> 
                                            <input type="radio" name="workProcessType" id="workProcessType_week"  value="N"  data-valid="blank"/>  
                                            <label class="m-r-15" for="workProcessType_week">주1회</label> 
                                            <input type="radio" name="workProcessType" id="workProcessType_month"  value="N"  data-valid="blank"/>  
                                            <label class="m-r-15" for="workProcessType_month">월1회</label> 
                                        </td>
                                    </tr>
                                    <!-- 11/06/2020 kange end -->

                                    <tr>
                                        <td class="info text-center wper20">업무처리 일정</td>
                                        <td class="text-center wper80">
                                            <div class="d-IBlock weekWrap">
                                                <button type="button" class="btn btn-default weekday" id="weekday_1" onclick="selectWeek('1', this)">월</button>
                                                <button type="button" class="btn btn-default weekday" id="weekday_2" onclick="selectWeek('2', this)">화</button>
                                                <button type="button" class="btn btn-default weekday" id="weekday_3" onclick="selectWeek('3', this)">수</button>
                                                <button type="button" class="btn btn-default weekday" id="weekday_4" onclick="selectWeek('4', this)">목</button>
                                                <button type="button" class="btn btn-default weekday" id="weekday_5" onclick="selectWeek('5', this)">금</button>
                                                <button type="button" class="btn btn-default weekday" id="weekday_6" onclick="selectWeek('6', this)">토</button>
                                                <button type="button" class="btn btn-default weekday" id="weekday_0" onclick="selectWeek('0', this)">일</button>
                                            </div>
                                            <input class="form-control schedule1" type="hidden" name="df_work_schedule_weeks" id="df_work_schedule_weeks" value="">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="info text-center wper20">업무담당자</td>
                                        <td class="wper80">
                                            <select class="form-control" name="person_in_charge" id="person_in_charge" data-valid="blank" >
                                                <option value="">업무담당자를 선택하세요</option>                                                                                              
                                            </select>
                                        </td>
                                    </tr>

                                    <!-- <tr>
                                        <td class="info text-center wper20">첨부파일</td>
                                        <td class="wper80">
                                            <div class="upload-btn-wrapper">
                                                <button type="button" class="btn btn-primary">업로드</button>
                                                <input type="file" name="doc_file" onchange="readFile(this);" style="width:120px !important;height:50px" >                                                    
                                                <code class="control-label m-l-10"></code>
                                            </div>
                                        </td>
                                    </tr> -->
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
<!-- //HACCP 점검표 등록 -->

<script>

    var current_data = {};
    /**
        문서 등록 레이어 노출 동작 
     */
    function documentWrite( arg_type, arg_element ){

        $('#df_work_checklist').val('');
        $('#df_work_checklist_doc').val('');
        $('#write_layer_form').find('input[type="file"]').val('');
        $('#write_layer_form').find('code').text('');
        $('#file_idx').val('');
        $('#layer_df_idx').val('');
        $('#df_sort').val('');
        
        $('#df_work_schedule_weeks').val('');

        $('.weekday').addClass('btn-default');
        $('.weekday').removeClass('btn-primary');
        
        switch( arg_type ) {
            case 'add' : {
                $('#layer_mode').val('ins');
                break;
            }
            case 'edit' : {

                current_data = JSON.parse( $(arg_element).parent().parent().data('row_items').replace(/'/g, '"') );
                
                $('#layer_mode').val('edit');

                $('#file_idx').val(current_data.file_idx);
                $('#layer_df_idx').val(current_data.df_idx);                
                $('#layer_df_group').val(current_data.df_group);
                // $('#df_work_schedule_weeks').val(data.df_work_schedule_weeks);
                $('#df_work_checklist').val(current_data.df_work_checklist);
                $('#df_work_checklist_doc').val(current_data.df_work_checklist_doc);
                $('#df_sort').val(current_data.df_sort);
                $('#write_layer_form').find('code').text( current_data.origin_name );

                $.each( current_data.df_work_schedule_weeks.split(','), function(key, val){
                    $('#weekday_' + val ).trigger('click');
                })

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

    //  업로드 버튼 이벤트 처리
    function readFile(arg_this) {

        if (arg_this.files && arg_this.files[0]) {

            if(window.FileReader){  // modern browser
                var filename = $(arg_this)[0].files[0].name;
            } 
            else {  // old IE
                var filename = $(arg_this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
            }
            
            $(arg_this).parent().find('code').text(filename);   
        }
    }

    function selectWeek( arg_val, arg_this ) {
        
        var get_weeks = $('#df_work_schedule_weeks').val();
        var weeks_arr = [];

        if( get_weeks == '' ) {
            $('#df_work_schedule_weeks').val( arg_val );
        } else {

            weeks_arr = get_weeks.split(',');
            
            if( weeks_arr.indexOf( arg_val ) > -1 ) {
                weeks_arr.splice( weeks_arr.indexOf( arg_val ) , 1);
            } else {
                weeks_arr.push( arg_val );
            }

            weeks_arr.sort();

            $('#df_work_schedule_weeks').val( weeks_arr.join(',') );

        }

        if( $(arg_this).hasClass('btn-default') ) {
            $(arg_this).removeClass('btn-default');
            $(arg_this).addClass('btn-primary');
        }else {
            $(arg_this).addClass('btn-default');
            $(arg_this).removeClass('btn-primary');
        }
        

    }

    function closeModal(){

        $('#write_layer').modal('hide');

    }


    function delProc( arg_idx ){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#list_mode').val('del');
            $('#df_idx').val(arg_idx);
            $('#list_form').submit();
        }

    }

</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>

            
