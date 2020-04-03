<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    업무담당자 관리 > 담당자 정보 <?=$page_work?>                    
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
                                <b>기본정보</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
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
                                        <th class="info middle-align">이름</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="member_name" name="member_name" value="<?=$member_name?>" data-valid="kr|en" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">이메일</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="email" name="email" value="<?=$email?>"  />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">메뉴접근 권한</th>
                                        <td colspan="3"  >
                                            <?php
                                                foreach( $service_items AS $key=>$val ) {
                                                    if( $key == 0 ) {
                                                        $valid_val = 'data-valid="check"';
                                                    } else {
                                                        $valid_val = '';
                                                    }
                                            ?>
                                            <input type="checkbox" name="menu_auth[]" id="menu_auth_<?=$val['code']?>" value="<?=$val['code']?>" <?=$valid_val?> <?=(strpos( $menu_auth, $val['code'] ) > -1 ) ? 'checked="checked"' : '' ?>  > 
                                            <label class="m-r-10" for="menu_auth_<?=$val['code']?>"><?=$val['title']?></label>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">담당업무</th>
                                        <td colspan="3">

                                            <?php
                                                $valid_val = 'data-valid="check"';
                                                foreach( $mes_process AS $key=>$val ) {
                                                    
                                            ?>
                                            <input type="checkbox" name="work_auth[]" id="work_auth_<?=$key?>" value="<?=$key?>" <?=$valid_val?> <?=(strpos( $work_auth, $key ) > -1 ) ? 'checked="checked"' : '' ?>  > 
                                            <label class="m-r-10" for="work_auth_<?=$key?>"><?=$val?></label>
                                            <?php
                                                    $valid_val = '';
                                                }
                                            ?>

                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">업무 권한</th>
                                        <td colspan="3">

                                            <input type="checkbox" name="approval_auth[]" id="approval_auth_no" value="no" <?=(strpos( $approval_auth, 'no' ) > -1 ) ? 'checked="checked"' : '' ?> >
                                            <label class="m-r-10" for="approval_auth_no">업무담당자</label>

                                            <input type="checkbox" name="approval_auth[]" id="approval_auth_leader" value="leader" <?=(strpos( $approval_auth, 'leader' ) > -1 ) ? 'checked="checked"' : '' ?> >
                                            <label class="m-r-10" for="approval_auth_leader">중간승인자(생산팀장)</label>

                                            <input type="checkbox" name="approval_auth[]" id="approval_auth_ceo" value="ceo" <?=(strpos( $approval_auth, 'ceo' ) > -1 ) ? 'checked="checked"' : '' ?> >
                                            <label class="m-r-10" for="approval_auth_ceo">최종승인자(대표이사)</label>

                                        </td>
                                    </tr>

                                    

                                    

                                    <tr>
                                        <th class="info middle-align">계정상태</th>
                                        <td colspan="3">

                                            <select class="form-control" name="use_flag" id="use_flag" style="width:200px" >
                                               
                                                <option value="Y" <?=($use_flag == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($use_flag == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                                
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
            
