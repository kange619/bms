<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    구매관리 > 주문등록 <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc" >                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="material_idx" value="<?=$material_idx?>" />                
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="file_idx" id="file_idx" value="<?=$file_idx?>" />

                <!-- 주문 정보 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            
                            <div class="table-responsive m-b-0">
                                <h5 class="header-title m-b-10">
                                    <b>주문정보</b>    
                                </h5>
                                <hr class="m-t-0">
                                <table class="table table-bordered text-left">
                                    <tbody> 
                                        <tr>
                                            <th class="info">업체선택</th>
                                            <td class="text-left" colspan="3">
                                                <select class="form-control" name="selectCust" style="width:30%">
                                                    <option value="option1">전체</option>
                                                    <option value="option2">option1</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="info">주문일</th>
                                            <td class="text-left" colspan="3">
                                                <input type="text" class="form-control datepicker" readonly="readonly" style="width:30%">    
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="info">입고예정일</th>
                                            <td class="text-left" colspan="3">
                                                <input type="text" class="form-control datepicker" readonly="readonly" style="width:30%">    
                                            </td>
                                        </tr>                                                                  
    
                                    </tbody>
                                </table>
                            </div> 

                        </div>

                    </div>
                </div>
                <!-- 주문정보 --> 

                <!-- 품목리스트 --> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h5 class="header-title m-t-0">
                                <b>품목리스트</b>                            
                            </h5>
                            <hr class="m-t-0">
                            <div class="table-responsive m-b-0">
                                <table class="table table-bordered text-center dataTable" id="excelTable">
                                    <thead>
                                        <tr class="active">
                                            <th class="info" >선택</th> 
                                            <th class="info sorting" data-order="entry_no">종류</th>
                                            <th class="info sorting" data-order="material_idx">품목명</th>
                                            <th class="info sorting" data-order="material_name">단가(원)</th>                                                                        
                                            <th class="info sorting" data-order="net_contents">단위</th>
                                            <th class="info sorting" data-order="reg_date">중량</th>                                                                                
                                                                                                
                                        </tr>                                
                                    </thead>
                                    <tbody>
                                        <tr><td colspan="9">데이터가 없습니다</td></tr>                                    
                                    </tbody>                                       
                                </table>

                                <form name="list_form" id="list_form" method="post" action="./<?=$page_name?>_proc" >
                                    <input type="hidden" name="mode" id="list_form_mode" />
                                    <input type="hidden" name="material_idx" id="material_idx" />
                                    <input type="hidden" name="page" value="<?=$page?>">
                                    <input type="hidden" name="list_rows" value="<?=$list_rows?>">                                                        
                                    <input type="hidden" name="top_code" value="<?=$top_code?>">
                                    <input type="hidden" name="left_code" value="<?=$left_code?>">
                                    <input type="hidden" name="ref_params" value="<?=$params?>" />
                                </form>
                            </div>                                                
                        </div>                       
                    </div>
                </div>
                <!-- 품목리스트 -->   

                <!-- 선택리스트 --> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h5 class="header-title m-t-0">
                                <b>선택리스트</b>                            
                            </h5>
                            <hr class="m-t-0">
                            <div class="table-responsive m-b-0">
                                <table class="table table-bordered text-center dataTable" id="excelTable">
                                    <thead>
                                        <tr class="active">
                                            <th class="info" >삭제</th> 
                                            <th class="info sorting" data-order="entry_no">종류</th>
                                            <th class="info sorting" data-order="material_idx">품목명</th>
                                            <th class="info sorting" data-order="material_name">단가(원)</th>                                                                        
                                            <th class="info sorting" data-order="net_contents">단위</th>
                                            <th class="info sorting" data-order="reg_date">중량</th>                                                                                
                                            <th class="info sorting" data-order="reg_date">주문수량</th>                                                                                
                                            <th class="info sorting" data-order="reg_date">금액</th>                                                                                
                                                                                                
                                        </tr>                                
                                    </thead>
                                    <tbody>
                                        <tr><td colspan="9">데이터가 없습니다</td></tr>                                    
                                    </tbody>                                       
                                </table>

                                <form name="list_form" id="list_form" method="post" action="./<?=$page_name?>_proc" >
                                    <input type="hidden" name="mode" id="list_form_mode" />
                                    <input type="hidden" name="material_idx" id="material_idx" />
                                    <input type="hidden" name="page" value="<?=$page?>">
                                    <input type="hidden" name="list_rows" value="<?=$list_rows?>">                                                        
                                    <input type="hidden" name="top_code" value="<?=$top_code?>">
                                    <input type="hidden" name="left_code" value="<?=$left_code?>">
                                    <input type="hidden" name="ref_params" value="<?=$params?>" />
                                </form>
                            </div>                                                
                        </div>                       
                    </div>
                </div>
                <!-- 선택리스트 -->   
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

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {
            

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


    //  업로드 버튼 이벤트 처리
    function readFile(arg_this, arg_input_name) {
        if (arg_this.files && arg_this.files[0]) {

            if(window.FileReader){  // modern browser
				var filename = $(arg_this)[0].files[0].name;
			} 
			else {  // old IE
				var filename = $(arg_this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
			}
            
            $('code.'+arg_input_name ).text(filename);   
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
            
