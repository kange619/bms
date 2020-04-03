<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    정보관리 > 기업 정보 <?=$page_work?>                    
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./company_proc">                
                <input type="hidden" name="mode" value="<?=$mode?>" />
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
                                        <th class="info middle-align">회사명</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_name" name="company_name" value="<?=$company_name?>" data-valid="str" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">사업자등록번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="registration_no" name="registration_no" maxlength="10" value="<?=$registration_no?>" data-valid="num/10" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">대표명</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="ceo_name" name="ceo_name" value="<?=$ceo_name?>" data-valid="kr|en" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">전화번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_tel" name="company_tel" placeholder="'-'없이 입력하세요"  maxlength="11" value="<?=$company_tel?>" data-valid="num/10" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">팩스번호</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_fax" name="company_fax" placeholder="'-'없이 입력하세요" maxlength="11" value="<?=$company_fax?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">홈페이지</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="company_homepage" name="company_homepage" value="<?=$company_homepage?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">주소</th>
                                        <td colspan="3">
                                            <input class="form-control" type="text" id="zip_code" name="zip_code" value="<?=$zip_code?>" maxlength="6" readonly="readonly"style="width:80px !important " /> 
                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-l-10" onclick="findAddress()">주소찾기</button>
                                            <br><br>
                                            <input class="form-control" type="text" id="addr" name="addr" value="<?=$addr?>" readonly="readonly" style="width:80% !important " />
                                            <br><br>
                                            <input class="form-control" type="text" id="addr_detail" name="addr_detail" placeholder="상세주소" value="<?=$addr_detail?>" style="width:80% !important " />
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //기본정보 -->
            
           
            <!-- 담당자 확인 및 변경  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>담당자 정보 </b>
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="changePartner()" >담당자 변경</button> 
                            </h5>
                            <hr class="m-t-0">
                            <input type="hidden" name="current_partner_idx" value="<?=$company_member_idx?>" />
                            <input type="hidden" name="edit_partner_idx" id="edit_partner_idx" value="" />

                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
                                        <th class="info middle-align">휴대폰 번호(ID)</th>
                                        <td id="current_partner_ph" >
                                            <?=$phone_no?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">이름</th>
                                        <td id="current_partner_name" >
                                            <?=$member_name?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">이메일</th>
                                        <td id="current_partner_email" >
                                            <?=$email?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 담당자 확인 및 변경  -->

            <!-- 취급 식품 유형  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>취급 식품유형</b>                                
                            </h5>
                            <hr class="m-t-0">

                            <table class="table table-bordered text-left">
                                <tbody>
                                    <?php
                                        foreach( $food_types AS $item ){
                                    ?>
                                    <tr>
                                        <th class="info middle-align">유형</th>
                                        <td id="current_partner_ph" >
                                            <?=$item?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                   
                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 취급 식품 유형  -->
           


            </form>

            <div class="row"> 
                <div class="col-lg-12">                    
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->

<!-- 파트너 회원 변경 레이어  -->
<div id="company_member_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">업무 담당자 목록</h3>
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">
                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 40%;">이름</th>
                                        <th class="info" style="width: 40%;">전화번호</th>
                                        <th class="info" style="width: 20%;">선택</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $company_members ) > 0  ){
                                            foreach( $company_members AS $item ) {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td class="text-center"><?=$item['member_name']?></td>
                                        <td class="text-center vertical-align"><?=$item['phone_no']?></td>
                                        <td class="text-center vertical-align">
                                            <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choicePartner('<?=$item['company_member_idx']?>', '<?=$item['member_name']?>', '<?=$item['phone_no']?>', '<?=$item['email']?>')" >선택</button> 
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td colspan="3" class="text-center">
                                            회원 정보가 없습니다.
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                                    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- // 파트너 회원 변경 레이어  -->

<script>

    $(function(){

        

    });

    /**
     * 파트너 레이어 open
     */
    function changePartner(){
        $('#company_member_modal').modal();
    }

    /**
     * 파트너 데이터 변경
     */
    function choicePartner( arg_member_idx, arg_member_name, arg_member_hp, arg_member_email ){


        $('#edit_partner_idx').val( arg_member_idx );        
        $('#current_partner_name').html( arg_member_name );
        $('#current_partner_ph').html( arg_member_hp );
        $('#current_partner_email').html( arg_member_email );

        $("#company_member_modal").modal('hide');

        alert('파트너 변경 준비가 완료되었습니다.\n\n하단 저장 버튼을 눌러 작업을 완료하세요.');

    }
    
    /**
     * 저장 버튼 동작
     */
    function register(){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {
            // submit
            $('#form_write').submit();
        }

    }

    /**
     * 주소검색
     */
    function findAddress() {
        new daum.Postcode({
            oncomplete: function(data) {
                console.log( data );
                $("#zip_code").val(data.postcode1+"-"+data.postcode2);
                $("#addr").val(data.address);
                $("#addr_detail").focus();
            }
        }).open();
    }

</script>

<style>    
    .table>tbody>tr>th.info {
        width: 15%;
    }
    table input {
        width: 40% !important; display: inline-block !important;
    }
</style>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
