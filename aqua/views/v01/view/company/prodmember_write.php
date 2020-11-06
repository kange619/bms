<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    생산담당자 관리 > 담당자 정보 <?=$page_work?>                    
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="company_member_idx" value="<?=$company_member_idx?>" />                
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />


            <!-- 기본정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>생산업무 담당자등록</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
                                        <th class="info middle-align">이름</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="member_name" name="member_name" value="<?=$member_name?>" data-valid="kr|en" />
                                        </td>
                                    </tr> 

                                    <tr>
                                        <th class="info middle-align">휴대폰 번호(ID)</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="phone_no" name="phone_no" placeholder="'-'없이 입력하세요" maxlength="11" value="<?=$phone_no?>" data-valid="num/11" />  
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">비밀번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="password" id="password" name="password" <?=( $mode == 'ins' ) ? 'data-valid="pw"' : '' ?> />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">비밀번호 확인</th>
                                        <td colspan="3">
                                            <input class="form-control" type="password" id="re_password" name="re_password"  />
                                            <span class="m-l-10" id="re_pw_result"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">업무구분</th>
                                        <td colspan="3">

                                            <select class="form-control" name="job_position" id="job_position" style="width:200px" >
                                               
                                                <option value="Y" <?=($job_position == 'Y' ? 'selected="selected"' : '' )?> >option1</option>
                                                <option value="N" <?=($job_position == 'N' ? 'selected="selected"' : '' )?> >option2</option>
                                                
                                            </select>

                                        </td>
                                    </tr>      

                                    <tr>
                                        <th class="info middle-align">업무내용</th>
                                        <td colspan="3">

                                            <select class="form-control" name="job_detail" id="job_detail" style="width:200px" >
                                               
                                                <option value="Y" <?=($job_detail == 'Y' ? 'selected="selected"' : '' )?> >option1</option>
                                                <option value="N" <?=($job_detail == 'N' ? 'selected="selected"' : '' )?> >option2</option>
                                                
                                            </select>

                                        </td>
                                    </tr>   
                                                               
                                
                                    <tr>
                                        <th class="info middle-align">정/부</th>
                                        <td colspan="3">

                                            <select class="form-control" name="person_in_charge" id="person_in_charge" style="width:200px" >
                                               
                                                <option value="Y" <?=($person_in_charge == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($person_in_charge == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                                
                                            </select>

                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">보건증갱신기간</th>
                                        <td colspan="3">

                                            <select class="form-control" name="renew_certi" id="renew_certi" style="width:200px" >
                                               
                                                <option value="Y" <?=($renew_certi == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($renew_certi == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                                
                                            </select>

                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //기본정보 -->
            
            </form>

            <div class="row"> 
                <div class="col-lg-12">
                    <?php
                        if($mode == 'edit') {
                    ?>                            
                    <button type="button" class="pull-left btn btn-danger waves-effect w-md m-l-5" onclick="delProc()">삭제</button> 
                    <?php
                        }
                    ?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


<script>

     /**
     * 저장 버튼 동작
     */
    function register(){

        if( $('#company_idx').val() == '' ) {
            alert('기업을 선택 해주세요.');
            return;
        }

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {
            // submit
           
            $('#form_write').submit();
        }

    }

    /**
        삭제 버튼 동작
     */
    function delProc(){

        if(confirm('해당 정보를 삭제하시겠습니까?') == true ){
            $('#mode').val('del');            
            $('#form_write').submit();
        }

    }

    

</script>

<style>    
    .table>tbody>tr>th.info {
        width: 15%;
    }
    /* table input {
        width: 40% !important; display: inline-block !important;
    } */
</style>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
