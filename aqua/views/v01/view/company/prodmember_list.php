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
                                        <th class="info " style="width: 3%;">NO</th>
                                        <th class="info sorting " data-order="reg_date" >이름</th>                                                                                
                                        <th class="info sorting " data-order="phone_no" >휴대폰번호</th>
                                        <th class="info sorting " data-order="job_position" >업무구분</th>                                                                                                         
                                        <th class="info sorting " data-order="job_detail" >업무내용</th>                                                                                                         
                                        <th class="info sorting " data-order="renew_certi" >보건증갱신기간</th>
                                        <th class="info sorting " data-order="person_in_charge" >정/부</th>
                                        <th class="info sorting " data-order="prodmem_status" >상태</th>

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
                            </table>
                        </div>                        
                    </div>                       
                </div>
            </div><!-- end row --> 


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


            
