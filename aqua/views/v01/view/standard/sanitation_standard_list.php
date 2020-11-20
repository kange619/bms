<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    식품위생서류 등록
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
                                            <select class="form-control" name="documentType" id="documentType" >                                        
                                                <option value="All" <?=($documentType == 'All' ? 'selected="selected"' : '' )?> >전체</option>
                                                <option value="Item" <?=($documentType == 'Item' ? 'selected="selected"' : '' )?> >품목명</option>
                                                <option value="Document" <?=($documentType == 'Document' ? 'selected="selected"' : '' )?> >문서명</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="sch_keyword" value="<?=$sch_keyword;?>" placeholder="품목명, 문서명">
                                        </div>
                                    </div>
                                </div>     

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-offset-5 col-sm-7 m-t-15">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='./<?=$page_name?>_list?top_code=<?=$top_code?>&left_code=<?=$left_code?>'">기본설정</button>
                                            <!-- <button type="reset" class="btn btn-primary waves-effect waves-light">기본설정</button> -->
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
                            <b>품목제조보고서</b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info " style="width: 3%;">NO</th>
                                        <th class="info sorting" data-order="df_title"  style="width: 30%;">문서명</th>                                         
                                        <th class="info sorting" data-order="df_item_name"  style="width: 10%;">품목명</th>                                         
                                        <th class="info sorting" data-order="prod_title"  style="width: 10%;">제품명</th>
                                        
                                        <th class="info " style="width: 30%;" >첨부파일</th>
                                        <th class="info " >변경</th>
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td><?=$value['df_title'];?></td>
                                        <td><?=$value['df_item_name'];?></td>
                                        <td><?=$value['prod_title'];?></td>
                                        
                                        <td>
                                            <a href="/file_down.php?key=<?=$value['file_idx'];?>" ><?=$value['origin_name'];?></a>
                                        </td>    
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

<!-- 식품위생서류 등록 -->
<div id="write_layer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">품목제조보고서</h3>
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

                            <table class="table table-bordered text-left">
                                <tbody>

                                    <tr>
                                        <td class="info text-center wper20">문서명</td>
                                        <td class="wper80">
                                            <input type="text" class="form-control" id="df_title" name="df_title" placeholder="문서명" data-valid="blank" >
                                        </td>
                                    </tr>                                

                                    <tr>
                                        <td class="info text-center wper20">품목명</td>
                                        <td class="wper80">
                                            <input type="text" class="form-control" id="df_item_name" name="df_item_name" placeholder="품목명" data-valid="blank" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="info text-center wper20">제품명</td>
                                        <td class="wper80">
                                            <input type="text" class="form-control" id="prod_title" name="prod_title" placeholder="제품명" data-valid="blank" >
                                        </td>
                                    </tr>
                                    
									<tr>
                                        <td class="info text-center wper20">첨부파일</td>
                                        <td class="wper80">
                                            <div class="upload-btn-wrapper">
                                                <button type="button" class="btn btn-primary">업로드</button>
                                                <input type="file" name="doc_file" onchange="readFile(this);" style="width:120px !important;height:50px" >                                                    
                                                <code class="control-label m-l-10"></code>
                                            </div>
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
<!-- //식품위생서류 등록 -->

<script>
    /**
        문서 등록 레이어 노출 동작 
     */
    function documentWrite( arg_type, arg_element ){

        $('#df_title').val('');
        $('#write_layer_form').find('input[type="file"]').val('');
        $('#write_layer_form').find('code').text('');
        $('#file_idx').val('');
        $('#layer_df_idx').val('');
        $('#df_item_name').val('');
        $('#df_sort').val('');
        
        switch( arg_type ) {
            case 'add' : {
                $('#layer_mode').val('ins');
                break;
            }
            case 'edit' : {

                var data = JSON.parse( $(arg_element).data('row_items').replace(/'/g, '"') );

                $('#layer_mode').val('edit');

                $('#file_idx').val(data.file_idx);
                $('#layer_df_idx').val(data.df_idx);
                $('#df_title').val(data.df_title);
                $('#df_item_name').val(data.df_item_name);
                $('#layer_df_group').val(data.df_group);
                $('#df_sort').val(data.df_sort);
                $('#write_layer_form').find('code').text( data.origin_name );

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

    function closeModal(){

        $('#write_layer').modal('hide');
        $('#df_title').val('');
        $('#df_item_name').val('');

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

            
