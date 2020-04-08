<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    <?=$task_title?>
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="location.href='./<?=$page_name?>_write?page=<?=$page?><?=$params?>'">+등록</button>                 
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
                        <div class="table-responsive m-b-0">
                            <table class="table table-bordered text-center" id="excelTable">
                                <thead>
                                    <tr class="active">                                        
                                        <th class="info" >문서명</th>                                                                
                                        <th class="info" style="width: 20%" >승인대기</th>                                                                
                                    </tr>                                
                                </thead>
                                <tbody>
                                   
                                    <?php
                                        foreach( $doc_list AS $idx=>$val ) {
                                    ?>
                                    <tr>                                        
                                        <td>
                                            <a href="./doc_list?page=<?=$page?><?=$params?>&doc_usage_idx=<?=$val['key'];?>">
                                                <?=$val['title']?>
                                            </a>
                                        </td>
                                        <td >0</td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                
                                </tbody>                                       
                            </table>
                        </div>
                        

                    </div>                       
                </div>
            </div><!-- end row --> 

        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->

            
