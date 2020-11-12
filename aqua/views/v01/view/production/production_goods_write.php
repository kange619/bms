<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    생산제품등록 <?=$page_work?>  
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button>                  
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./company_proc">                
                <input type="hidden" name="mode" value="<?=$mode?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                       
            <!-- 담당자 확인 및 변경  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>제품등록 </b>                                
                            </h5>
                            <hr class="m-t-0">
                            <input type="hidden" name="current_partner_idx" value="<?=$company_member_idx?>" />
                            <input type="hidden" name="edit_partner_idx" id="edit_partner_idx" value="" />

                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>                                                                                                                                              
                                        <th class="info">품목명</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                                                    
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">제품명</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                                                    
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">제품등록번호</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                                                    
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">품목신고번호</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                                                    
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">조리원지정</th>
                                        <td class="text-left" colspan="1" width="500px">     
                                            <input type="text" class="form-control" name="">                                        
                                            <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:5px;" onclick="changePartner()" >검색하기</button> 
										</td>                                                                                                                    
									</tr>
                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 담당자 확인 및 변경  -->
           
            </form>

            <div class="row"> 
                <div class="col-lg-12">                    
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
                    
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


<!-- 조리원 검색 레이어  -->
<div id="company_member_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">조리원 지정</h3>
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">
                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 40%;">성명</th>
                                        <th class="info" style="width: 40%;">작업품목</th>
                                        <th class="info" style="width: 20%;">지정</th>
                                    </tr>
                                </thead>
                                <tbody>                                   
                                    <tr style="cursor: pointer;" >
                                        <td colspan="3" class="text-center">
                                            회원 정보가 없습니다.
                                        </td>  
                                    </tr>                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                                    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- 조리원 검색 레이어  -->


<script>

    $(function(){
        
    });

    /**
     * 조리원 검색 레이어 open
     */
    function changePartner(){
        $('#company_member_modal').modal();
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
            
