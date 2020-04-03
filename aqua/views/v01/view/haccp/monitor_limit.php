<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    모니터링 한계설정
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="reqeustSubmit('list_form')" >저장</button>                 
                </h1>                   
            </section>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h5 class="header-title m-t-0">
                            <b>목록</b>
                            <!-- <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-5 fright" onclick="tableToExcel('excelTable', '기업회원');">엑셀다운로드</button> -->
                        </h5>
                        <hr class="m-t-0">

                        <form class="form-horizontal group-border-dashed clearfix" name="fsearch" id="fsearch" method="get" action="">
                                <input type="hidden" name="page" value="<?=$page?>">
                                <input type="hidden" name="list_rows" value="<?=$list_rows?>">                                                        
                                <input type="hidden" name="top_code" value="<?=$top_code?>">
                                <input type="hidden" name="left_code" value="<?=$left_code?>">
                                <input type="hidden" name="sch_order_field" id="sch_order_field" value="<?=$sch_order_field?>">
                                <input type="hidden" name="sch_order_status" id="sch_order_status" value="<?=$sch_order_status?>">
                        </form>
                        <div class="table-responsive m-b-0">

                            <form name="list_form" id="list_form" method="post" action="<?=$page_name?>_proc" >

                            <table class="table table-bordered text-center dataTable" id="excelTable">
                                <thead>
                                    <tr class="active">
                                        <th class="info " style="width: 3%;">NO</th>
                                        <th class="info sorting" data-order="storage_name"  style="width: 20%;">저장고</th>                                        
                                        <th class="info sorting" data-order="min_temperature" style="width: 20%;" >최저치</th>
                                        <th class="info sorting" data-order="max_temperature" style="width: 20%;" >최고치</th>
                                        
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=( ( $paging->total_rs - ( $page-1 ) * $list_rows - $key ) );?></td>
                                        <td><?=$value['storage_name'];?></td>
                                        <td>
                                            <input class="form-control" name="min_temperature[<?=$value['storage_idx']?>]"  value="<?=$value['min_temperature'];?>" >
                                        </td>
                                        <td>
                                            <input class="form-control" name="max_temperature[<?=$value['storage_idx']?>]" value="<?=$value['max_temperature'];?>" >
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

                            
                                <input type="hidden" name="mode" id="list_mode" />                                
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


<script>
    
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

   

</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>

            
