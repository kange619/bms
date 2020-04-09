<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="subject" content="<?=$ogp_title?>" /> 
        <meta name="keywords" content="<?=$meta_keywords?>" /> 
        <meta name="description" content="<?=$meta_description?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?=$ogp_title?>" />
        <meta property="og:stitle_name" content="<?=$ogp_stitle_name?>" />	 
        <meta property="og:url" content="<?=$ogp_url?>" />
        <meta property="og:image" content="<?=$ogp_image?>" />
        <meta property="og:description"  content="<?=$ogp_description?>" />
        <?php
            if( $favicon_path ){
        ?>
        <link rel="shortcut icon" href="<?=$favicon_path?>" />
        <?php
            }
        ?>
        <title><?=$meta_title?></title>
        
        <!-- App CSS -->
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/core.css" />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/components.css"  />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/icons.css"  />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/pages.css" />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/admin_dev.css" />
        <link rel="stylesheet" type="text/css" href="<?=$aqua_view_path;?>/public/css/_lee.css" />
        
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?=$aqua_view_path;?>/public/js/jquery.min.js"></script>
        
        
    </head>
    <body class="fixed-left">

        <!-- Top Bar Start -->
        <?php 
            if( $use_top == true ) {

                include_once( $this->getViewPhysicalPath( $top_path ) );
                
            }

            if( $use_left == true ) {
                include_once( $this->getViewPhysicalPath( $left_menu_path )  );
            }
            
        ?>
        <!-- Top Bar End -->

        <?php
            include_once( $contents_path );
        ?>

        <?php 
            if( $use_footer == true ) {

                include_once( $this->getViewPhysicalPath( $footer_path ) );
            
            }
        ?>

        <!-- 전자문서 양식 레이어 -->
        <div id="document_handle_layer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width: 900px;">
                <div class="modal-content p-0 b-0">
                    <div class="panel panel-color panel-inverse">
                        <div class="panel-heading">
                            <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="panel-title" id="document_title_area" ></h3>
                        </div>
                        <form class="form-horizontal" role="doc_layer_form" method="post" id="doc_layer_form" enctype="multipart/form-data"  action="">                
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 table-responsive m-b-0" id="document_form_area" >
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <button type="button" class="btn btn-success waves-effect waves-light m-t-10 doc_write_mode " onclick="saveDoc('save')" style="display:none" >
                                        임시저장
                                    </button>
                                    <button type="button" class="btn btn-primary waves-effect waves-light m-t-10 m-l-15 doc_write_mode" onclick="saveDoc('request_approval')" style="display:none"  >
                                        승인요청
                                    </button>
                                    

                                    <button type="button" class="btn btn-primary waves-effect waves-light m-t-10 m-l-15 doc_approval_mode" onclick="saveDoc('approval')" style="display:none" >
                                        승인
                                    </button>

                                    <button type="button" class="btn btn-inverse waves-effect waves-light m-t-10 m-l-15 " data-dismiss="modal" >
                                        취소
                                    </button>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- //전자문서 양식 레이어 -->
        
        
        
        <script src="<?=$aqua_view_path;?>/public/js/commfunc.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/sweetalert.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/modernizr.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/jquery.form.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/lee.lib.js"></script>        
        <script src="<?=$aqua_view_path;?>/public/js/template/jquery.tmpl.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/template/jquery.tmplPlus.min.js"></script>

        <script src="<?=$aqua_view_path;?>/public/js/bootstrap.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/detect.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/fastclick.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/jquery.slimscroll.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/jquery.blockUI.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/waves.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/jquery.nicescroll.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/jquery.scrollTo.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/imasic.doc.rw.js"></script>
        <script src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
        

        <!-- Plugins Js -->
        <script src="<?=$aqua_view_path;?>/public/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.kr.min.js"></script> 
        <script src="<?=$aqua_view_path;?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/plugins/datatables/dataTables.bootstrap.min.js"></script>

        <script type="text/javascript">
            
            $(function (){
                
                $('.datepicker').datepicker({
                    calendarWeeks: false,
                    todayHighlight: true,
                    autoclose: true,
                    toggleActive: true,
                    format: "yyyy-mm-dd",
                    language: "kr",
                    clearBtn: true
                });

                // $('.list_table').DataTable({
                //     "paging": false,
                //     "lengthChange": true,
                //     "searching": false,
                //     "ordering": false,
                //     "info": false,
                //     "autoWidth": false
                // });

                $('#change_list_rows').change(function(){
                    
                    var result = '';

                    if( location.href.indexOf('list_rows') > -1) {
                        result = location.href.replace( /list_rows=[0-9]+/ig, 'list_rows='+ $(this).val() );
                    } else {
                        result = location.href + '&list_rows='+ $(this).val();
                    }

                    location.href = result;
                    
                });

                $('.profile').click(function(){
                    $('.nav-profile').toggle();
                });
                
                $('.sorting').click(function(){

                    var order_status = '';

                    if( $(this).attr('class').indexOf('sorting_asc') > -1 ) {
                        //# 오름차순 클래스 삭제 후 내림차순으로 변경
                        $('.sorting').removeClass('sorting_asc');
                        $('.sorting').removeClass('sorting_desc');

                        $(this).addClass('sorting_desc');

                        order_status = 'desc';
                        
                    } else if( $(this).attr('class').indexOf('sorting_desc') > -1 ) {
                        //# 내림차순 클래스 삭제 후 오름차순으로 변경
                        $('.sorting').removeClass('sorting_asc');
                        $('.sorting').removeClass('sorting_desc');

                        $(this).addClass('sorting_asc');
                        order_status = 'asc';
                    } else {
                        //# 내림차순 클래스 추가
                        $('.sorting').removeClass('sorting_asc');
                        $('.sorting').removeClass('sorting_desc');

                        $(this).addClass('sorting_desc');

                        order_status = 'desc';
                    }

                    $('#sch_order_field').val( $(this).data('order') );
                    $('#sch_order_status').val( order_status );

                    $('#fsearch').submit();


                });

                setListOrderClass();
             
            });

            function setListOrderClass() {

                var sch_order_field = $('#sch_order_field').val();
                var sch_order_status = $('#sch_order_status').val();

                $('.sorting').each(function(){
                    if( sch_order_field == $(this).data('order') ) {
                        if( sch_order_status == 'asc' ) {
                            $(this).addClass('sorting_asc');
                        } else {
                            $(this).addClass('sorting_desc');
                        }
                    }
                });
            }

            

            /**
                문서 작업 처리 함수
             */
            var doc_current_task = {};
            function docmentHandler( arg_doc_usage_idx, arg_task_type, arg_task_table_idx, arg_task_auth_flag ) {
                
                if( arg_task_auth_flag == false ) {
                    alert('작업 권한이 없습니다.');
                    return;
                }

                doc_current_task = {
                    doc_usage_idx : arg_doc_usage_idx
                    ,task_type : arg_task_type
                    ,task_table_idx : arg_task_table_idx
                }

                if( arg_doc_usage_idx == '' ){
                    console.error('문서 키가 필요합니다.'); 
                    return;
                }

                if( arg_task_type == '' ){
                    console.error('작업 유형값이 필요합니다.'); 
                    return;
                }

                if( arg_task_table_idx == '' ){
                    console.error('작업 테이블 기본키가 필요합니다.'); 
                    return;
                }

                //# 문서 정보 요청
                // ajaxProcessing('open');

                jqueryAjaxCall({
                    type : "post",
                    url : '/doc/getDocForm',
                    dataType : "json",
                    paramData : {
                        doc_usage_idx : arg_doc_usage_idx
                        ,task_type : arg_task_type
                        ,task_table_idx : arg_task_table_idx
                    } ,
                    callBack : function( arg_result ){
                        
                        // ajaxProcessing('close');
                        console.log( arg_result );

                        var work = '';
                        var table_data = '';
                        var data = '';
                        var writer_name = '';
                        var today = '';
                        var work_mode = '';
                        var approver = '';
                        
                        if( Object.keys(arg_result.document_form).length > 0 ){
                            
                            work = 'w';
                            work_mode = 'ins';
                            table_data = arg_result.document_form.doc_table_style_data;
                            data = arg_result.document_form.doc_data;
                            writer_name = arg_result.writer_name;
                            today = arg_result.today;

                            approval_data = arg_result.document_form;
                            
                        }

                        if( Object.keys(arg_result.document_approval_info).length > 0 ){
                            
                            work_mode = 'edit';
                            table_data = arg_result.document_approval_info.doc_table_style_data;
                            data = arg_result.document_approval_info.doc_data;
                            writer_name = '<img src="'+ arg_result.document_approval_info.reporter_qrcode_path + '" >';
                            approver = '<img src="'+ arg_result.document_approval_info.approver_qrcode_path + '" >';
                            if( arg_result.document_approval_info.approval_state == 'D' ) {
                                work = 'r';
                            } else {
                                work = 'w';
                            }

                            approval_data = arg_result.document_approval_info;
                            
                        }
                        
                        /********************************* 레이어 컨트롤 **********************************/
                        $('#document_title_area').html( approval_data.doc_title );
                        
                        switch( approval_data.approval_state ){
                            case 'W' : {

                            }
                            case undefined : {
                                $('.doc_write_mode').show();
                                break;
                            }
                            case 'R' : {
                                $('.doc_approval_mode').show();
                                break;
                            }
                            
                        }

                        //# 문서 생성 함수 호출

                        doc.init({
                            work : work
                            , element : 'document_form_area'                            
                            , table_data : table_data
                            , data : data
                        });
                        
                        $.each($('#document_form_area').find('th'), function(){                            

                            if( ( $(this).text() == '작성일자' )  ) {

                                // $($(this).parent().find('input')[0]).val( today ).trigger('keyup');                     
                                $($(this).parent().find('input')[0]).val( today );                     
                                $(this).parent().find('input')[0].dispatchEvent(new KeyboardEvent('keyup', {key: 'e'}));                     
                                

                                if( work_mode == 'ins' ) {
                                    $($(this).parent().find('input')[1]).val( writer_name );
                                    $(this).parent().find('input')[1].dispatchEvent(new KeyboardEvent('keyup', {key: 'e'}));        
                                    $($(this).parent().find('input')[1]).attr('readonly', 'readonly');
                                }
                            } 

                        });

                        $.each($('#document_form_area').find('td'), function(){     

                            if( ( $(this).text() == '__reporter_qr__' )  ) {
                                $(this).html( writer_name ) ;
                            } 

                            if( ( $(this).text() == '__approval_qr__' ) ) {
                                $(this).html(approver);
                            }

                        });

                        
                        $.each($('#document_form_area').find('input'), function(){                            
                            $(this).attr('data-valid', 'blank');
                        });

                        /********************************* 레이어 컨트롤 **********************************/


                    }
                });


                //# 문서 레이어 노출
                $('#document_handle_layer').modal();

                // console.log( doc_current_task );
            }
            
            function saveDoc( arg_mode ) {
                // console.log( doc.doc_obj );

                viewFormValid.alert_type = 'add';     
                
                if( viewFormValid.run( 'doc_layer_form' ) === true ) {

                    var param_data = {};

                    approval_data['doc_data'] = JSON.stringify( doc.doc_obj );                    
               
                    param_data['doc_usage_idx'] = doc_current_task.doc_usage_idx;
                    param_data['task_type'] = doc_current_task.task_type;
                    param_data['task_table_idx'] = doc_current_task.task_table_idx;
                    param_data['mode'] = arg_mode;

                    for( var item in approval_data ) {                    
                        param_data[ item ] = approval_data[item];
                    }

                    if( arg_mode == 'request_approval' ) {
                        if(confirm('승인요청 하시겠습니까?\n승인 요청 후에는 수정이 불가능합니다.') == false ) {
                            return;
                        }
                    }

                    if( arg_mode == 'approval' ) {
                        if(confirm('승인 처리하시겠습니까?\n승인 후에는 수정이 불가능합니다.') == false ) {
                            return;
                        }
                    }

                    jqueryAjaxCall({
                        type : "post",
                        url : '/doc/docApprovalHandler',
                        dataType : "json",
                        paramData : param_data ,
                        callBack : function( arg_result ){
                            
                            // ajaxProcessing('close');
                            if( arg_result.status == 'success' ) {
                                if( arg_mode == 'save' ) {
                                    alert('저장되었습니다.');
                                }

                                if( arg_mode == 'request_approval' ) {
                                    alert('승인 요청되었습니다.');
                                }

                                if( arg_mode == 'approval' ) {
                                    alert('승인 되었습니다.');
                                }
                                
                                location.reload();

                            } else {
                                alert( arg_result.msg );
                            }
                            
                        }
                    });
                }

            }

            function requestApprovalDoc(){

                viewFormValid.alert_type = 'add';        
                if( viewFormValid.run( 'doc_layer_form' ) === true ) {
                    
                    var param_data = {};

                    param_data['mode'] = 'save';

                    approval_data['doc_data'] = JSON.stringify( doc.doc_obj );               
                    param_data['doc_usage_idx'] = doc_current_task.doc_usage_idx;
                    param_data['task_type'] = doc_current_task.task_type;
                    param_data['task_table_idx'] = doc_current_task.task_table_idx;
                    

                    for( var item in approval_data ) {                    
                        param_data[ item ] = approval_data[item];
                    }

                    jqueryAjaxCall({
                        type : "post",
                        url : '/doc/docApprovalDocProc',
                        dataType : "json",
                        paramData : param_data ,
                        callBack : function( arg_result ){
                            
                            // ajaxProcessing('close');
                            if( arg_result.status == 'success' ) {
                                alert('저장되었습니다.');
                                location.reload();
                            } else {
                                alert( arg_result.msg );
                            }
                            
                        }
                    });

                }

            }
            
            // docmentHandler('35','t_materials_order','10000000000084');
            
            
        </script>

        
        

    </body>
</html>