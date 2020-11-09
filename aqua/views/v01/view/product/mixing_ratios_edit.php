<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    배합비율 정보관리 > [ <?=$product_name?> ]
                    
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>?page=<?=$page?><?=$params?>'">목록</button> 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" value="<?=$mode?>" />
                <input type="hidden" name="product_idx" value="<?=$product_idx?>" />                
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />


            <!-- 제품정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>제품정보</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
										<th class="info">식품유형</th>
                                        <td class="text-left" colspan="3">
                                            <?=$food_types[$food_code]?>
										</td>
                                    </tr>
                                    
                                    <tr>
										<th class="info">품목</th>
                                        <td class="text-left" colspan="3"></td>
									</tr>                                    

                                    <tr>
                                        <th class="info middle-align">제품명</th>
                                        <td colspan="3">
                                        <?=$product_name?>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th class="info middle-align">품목보고번호</th>
                                        <td colspan="3">
                                            <?=$item_report_no?>
                                        </td>
                                    </tr>

                                    <tr>
										<th class="info">중량</th>
                                        <td class="text-left" colspan="3"></td>
									</tr>                                     
                                   
                                </tbody>
                            </table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //제품정보 -->
            
            <!-- 제품 포장단위 정보 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>비율정보 등록</b>     
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="addForm()" >추가</button>                
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
                                        <!-- 주석처리함. 아래에서 원재료/배합비는 원래 주석처리 된 코드임 11/09/20 kange --> 
										<!-- <th class="info" style="width:150px">찾아보기</th> -->
										<!-- <th class="info">코드</th> -->
										<!-- <th class="info">원재료</th> -->
										<!-- <th class="info">납품업체</th> -->
										<!-- <th class="info">배합비</th> -->
                                        <!-- <th class="info" style="width:150px" >삭제</th> -->

                                        <th class="info">번호</th>
                                        <th class="info">구분</th>
                                        <th class="info">원재료</th>
                                        <th class="info">배합비율</th>
                                        <th class="info">중량</th>
                                        <th class="info" style="width:150px" >삭제</th>
                                        
									</tr>
								</thead>
								<tbody id="material_ratio_add_area">									
                                    
									
                                </tbody>
							</table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- // 제품 포장단위 -->

            
            </form>

            <div class="row"> 
                <div class="col-lg-12">
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>?page=<?=$page?><?=$params?>'">목록</button> 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


<!-- 원자재 목록 레이어  -->
<div id="search_material_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px; border: 1px solid;">
        <div class="modal-content p-0 b-0">                                    
            <div class="panel panel-color panel-inverse m-0" style="width:800px" >
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">원자재 목록</h3>
                </div>
                <div class="panel-body">
                    <div class="row img-contents">
                        <div class="col-lg-12 table-responsive m-b-0">
                            <input type="hidden" id="current_opener" />
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th class="info" style="width: 20%;">선택</th>
                                        <th class="info" style="width: 40%;">품목</th>
                                        <!-- <th class="info" style="width: 40%;">납품업체명</th>                                         -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $materials ) > 0  ){
                                            foreach( $materials AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td class="text-center vertical-align">
                                            <button type="button" class=" btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceMaterial(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
                                        </td>                                        
                                        <td class="text-center vertical-align"><?=$item['material_name']?></td>
                                        <!-- <td class="text-center vertical-align"><?=$item['company_name']?></td> -->
                                        
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td colspan="4" class="text-center">
                                            정보가 없습니다.
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
<!-- // 원자재 목록 레이어  -->

<script> 
    $(function(){
        
        makeMaterialRatios();
    })

    var current_opener = '';
    function searchMaterial( arg_this ){
        current_opener = arg_this;
        $('#search_material_modal').modal();
    }

    function choiceMaterial( arg_this ) {       

        var data = JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );

        $( current_opener ).parent().parent().find('input[name="material_idx[]"]').val( data.material_idx );
        $( current_opener ).parent().parent().find('input[name="material_group[]"]').val( data.material_group );
        $( current_opener ).parent().parent().find('input[name="material_origin[]"]').val( data.material_origin );
        $( current_opener ).parent().parent().find('input[name="material_ratio[]"]').val( data.meterial_ratio );
        $( current_opener ).parent().parent().find('input[name="material_weight[]"]').val( data.meterial_weight );

        $('#search_material_modal').modal('hide');

    }

    /**
        포장단위 추가버튼 동작
     */
     function addForm(){
        
        var empty_data = [{material_idx: '', material_group: '', material_origin: '', material_company_ratio: '', material_weight: '' }];        

        $('#material_ratio_add_area').append( $('#tmplate_material_form').tmpl( empty_data ) );
        
     }

     /**
      * 포장단위 목록 생성
      */
     function makeMaterialRatios(){

         var mixing_ratio_arr = <?=$mixing_ratio?>;

         if( typeof( mixing_ratio_arr ) == 'object' ) {

            $('#material_ratio_add_area').html( $('#tmplate_material_form').tmpl( mixing_ratio_arr ) );

         }

     }

     /**
      * 포장단위 삭제
      */
     function delForm( arg_this ){
        $( arg_this ).parent().parent().remove();
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

    /*
    //original(밑에서는 주석이 안되서 여기에 갖다놓음) 11/09/20 kange 
    <script id="tmplate_material_form" type="text/x-jquery-tmpl">
    <tr>
        <td >
            <button type="button" class="btn btn-sm btn-info waves-effect waves-light m-l-10" onclick="searchMaterial(this)">찾기</button>
            <input type="hidden" name="material_idx[]" value="${material_idx}"  >
        </td>
        <!-- <td><input type="text" name="material_code[]" class="form-control width100" maxlength="20" value="${material_code}"  ></td> -->
        <td><input type="text" name="material_name[]" class="form-control width100" maxlength="20" value="${material_name}" ></td>
        <!-- <td><input type="text" name="material_company_name[]" class="form-control width100" maxlength="20" value="${material_company_name}"  ></td> -->
        <td><input type="text" name="material_ratio[]" class="form-control width100 isNum" maxlength="20" value="${material_ratio}"  ></td>										
        <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this)">삭제</button></td>										
    </tr>    
    */


</script>

<style>    
    .table>tbody>tr>th.info {
        width: 15%;
    }
    /* table input {
        width: 40% !important; display: inline-block !important;
    } */
</style>

<script id="tmplate_material_form" type="text/x-jquery-tmpl">

    <tr>
        <td><input type="text" name="material_idx[]" class="form-control width100" maxlength="20" value="${material_idx}"></td>
        
        <td>
            <select name="material_group[]" class="form-control" width100 >
                <option value="option1">선택하세요</option>                                        
                <option value="option2">원료</option>
                <option value="option3">가공원료</option>                
            </select>        
        </td>

        <td>
            <select name="material_origin[]" class="form-control" width100 >
                <option value="option1">선택하세요</option>                                        
                <option value="option2">원재료1</option>
                <option value="option3">원재료2</option>                
            </select>        
        </td>        
        
        <td><input type="text" name="material_ratio[]" class="form-control width100 isNum" maxlength="20" value="${material_ratio}"  ></td>
        <td><input type="text" name="material_weight[]" class="form-control width100 isNum" maxlength="20" value="${material_weight}"></td>
        <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this)">삭제</button></td>																	
    </tr>
    
</script>



<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
