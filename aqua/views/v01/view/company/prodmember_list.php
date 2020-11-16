<?php
var_dump($list);
?>


<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    생산담당자 관리 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md" onclick="location.href='./<?=$page_name?>_write?page=<?=$page?><?=$params?>'">추가</button>                
                </h1>                   
            </section>

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

                                        <!-- 
                                        <th class="info sorting " data-order="reg_date" >가입일시</th>                                        
                                        <th class="info sorting " data-order="member_name" >담당자</th>
                                        <th class="info sorting " data-order="phone_no" >휴대폰번호</th>
                                        <th class="info sorting " data-order="email" >이메일</th>                                                                                                         
                                        <th class="info sorting " data-order="use_flag" >상태</th>                                                                                                         
                                        <th class="info " >삭제</th>     
                                        -->                                                                                                                                            
                                    </tr>                                
                                </thead>        

                                <tbody>
                                    
                                    <tr>
                                        
                                    </tr>

                                </tbody> 

                                <tbody>
                                    <?php echo $paging->total_rs; ?>
                                    <?php 
                                    if( $paging->total_rs > 0 ){ 
                                                
                                        foreach($list AS $key=>$value) {
                                    ?>
                                    <tr>
                                        <td><?=( $paging->total_rs - ($page-1) * (int)$list_rs-$key );?></td>
                                        <td><?=$value['reg_date'];?></td>
                                        <td>
                                            <a class="underline" href="./<?=$page_name?>_write?mode=edit&page=<?=$page?><?=$params?>&production_member_idx=<?=$value['production_member_idx'];?>">
                                                <?=$value['name'];?>
                                            </a>
                                        </td>
                                        
                                        <td><?=$value['phone_no'];?></td>
                                        <td><?=$value['work_position'];?></td>
                                        <td><?=$value['work_detail'];?></td>                                    
                                        <td><?=$value['health_certi_date'];?></td>
                                    </tr>
                                    <?php   
                                        }
                                    } else {
                                    ?>                                
                                        <tr><td colspan="9">데이터가 없습니다</td></tr>
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


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


            
