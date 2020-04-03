<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    정보보호관리  > 상세보기
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc" >                
                <input type="hidden" name="mode" value="<?=$mode?>" />
                <input type="hidden" name="security_idx" value="<?=$security_idx?>" />
                <input type="hidden" name="company_idx" id="company_idx" value="<?=$company_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="file_idx" id="file_idx" value="<?=$file_idx?>" />

            <!-- 기업정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>기업정보</b> 
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>                                    
                                    <tr>
                                        <th class="info middle-align">회사명</th>
                                        <td colspan="3" id="company_name" >
                                            <?=$company_name?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">사업자등록번호</th>
                                        <td colspan="3" id="registration_no" >
                                            <?=$registration_no?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">대표명</th>
                                        <td colspan="3" id="ceo_name" ><?=$ceo_name?></td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">전화번호</th>
                                        <td colspan="3" id="company_tel" ><?=$company_tel?></td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">담당자명</th>
                                        <td colspan="3" id="partner_name" ><?=$partner_name?></td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">담당자 휴대폰 번호</th>
                                        <td colspan="3" id="partner_phone_no" ><?=$partner_phone_no?></td>
                                    </tr>

                          
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //기업정보 -->


           <!-- 서비스 정보 -->
           <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>정보보호 내역</b>    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody> 
                                    <tr>
                                        <th class="info middle-align">작성일</th>
                                        <td colspan="3" >                                            
                                            <?=dateType( $write_date, 8 )?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">기간</th>
                                        <td colspan="3" >                                            
                                            <?=dateType( $start_date, 6 )?> ~ <?=dateType($end_date, 6 )?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">파일</th>
                                        <td colspan="3" >                                            
                                            <?php
                                                if( isset( $file_origin_name ) == true ) {
                                            ?>
                                            <a href="<?=MASICGONG_DOMAIN?>/file_down.php?key=<?=$file_idx?>" ><?=$file_origin_name?></a>
                                            <?php
                                                } 
                                            ?>
                                        </td>
                                    </tr>
 
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //서비스 정보 --> 

           
           
            </form>

            <div class="row"> 
                <div class="col-lg-12">
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button>                     
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->

<style>    
    .table>tbody>tr>th.info {
        width: 15%;
    }
    /* table input {
        width: 40% !important; display: inline-block !important;
    } */
</style>

            
