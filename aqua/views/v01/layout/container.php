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

        <!-- Plugins Js -->
        <script src="<?=$aqua_view_path;?>/public/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.kr.min.js"></script> 
        <script src="<?=$aqua_view_path;?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=$aqua_view_path;?>/public/plugins/datatables/dataTables.bootstrap.min.js"></script>

        <script type="text/javascript">
            
            $(function () {
                
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
            
        </script>


    </body>
</html>