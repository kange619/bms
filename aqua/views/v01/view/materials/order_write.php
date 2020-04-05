<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    원/부자재 주문관리  > 주문 <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./order_proc">                
                <input type="hidden" name="mode" value="<?=$mode?>" />
                <input type="hidden" name="order_idx" value="<?=$order_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
            

            <!-- 재료현황 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>원/부재료 현황</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
										<th class="info" style="width:150px">선택</th>
										<th class="info" style="width:150px">종류</th>										
										<th class="info">품목</th>
										<th class="info">자재명</th>
                                        <th class="info">회사명</th>
                                        <th class="info">원산지</th>
										<th class="info">단위</th>
										<th class="info">규격</th>
										<th class="info">단가(원)</th>
									</tr>
								</thead>
								<tbody id="materials_area" >
                                    
                                </tbody>
							</table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //재료현황 -->

            <!-- 재료현황 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>선택 상품</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>										
										<th class="info" style="width:150px">종류</th>										
										<th class="info">품목</th>
										<th class="info">자재명</th>
                                        <th class="info">회사명</th>
                                        <th class="info">원산지</th>
										<th class="info">단위</th>
										<th class="info">규격</th>
										<th class="info">단가(원)</th>
										<th class="info">주문수량</th>
										<th class="info">삭제</th>
									</tr>
								</thead>
								<tbody id="tmplate_material_choice_area" >
                                    
                                </tbody>
							</table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //재료현황 -->

            
            <!-- 주문 정보  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>주문 정보</b>
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
                                        <th class="info middle-align">주문일</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="order_date" id="order_date" value="<?=date('Y-m-d')?>" data-valid="blank" readonly="readonly" style="width:100px !important">  
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">입고예정일</th>
                                        <td colspan="3">
                                        <div class="form-group">                                            
                                            <div class="col-sm-4">
                                                <div class="input-daterange input-group">
                                                    <input type="text" class="form-control datepicker " name="receipt_date" id="receipt_date" value=""  readonly="readonly" style="width:100px !important" >  
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 주문 정보 -->
            
            </form>

            <div class="row"> 
                <div class="col-lg-12">
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register()">저장</button>
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


<script>

    $(function(){
        
        makeMaterialRatios();
    })

    /**
        포장단위 추가버튼 동작
     */
     function addForm( arg_this, arg_m_idx){ 

        
        var data = [materials_obj[arg_m_idx]];

        materials_obj[arg_m_idx].element = arg_this;
// console.log( data );
        $( arg_this ).hide();

        $('#tmplate_material_choice_area').append( $('#tmplate_material_choice_area_form').tmpl( data ) );
        
     }

     /**
      * 포장단위 목록 생성
      */
     var materials_obj = {};
     function makeMaterialRatios(){

         var materials_arr = <?=$materials?>;

        $.each(materials_arr, function(idx, val){            
            materials_obj[val.materials_usage_idx] = val;
        });

         if( typeof( materials_arr ) == 'object' ) {

            $('#materials_area').html( $('#tmplate_material_area_form').tmpl( materials_arr ) );

         }

     }

     /**
      * 포장단위 삭제
      */
     function delForm( arg_this, arg_m_idx ){
        $( arg_this ).parent().parent().remove();

        $( materials_obj[arg_m_idx].element ).show();

        materials_obj[arg_m_idx].element = '';

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
<script id="tmplate_material_area_form" type="text/x-jquery-tmpl">
<tr>
    <td><button type="button" class="btn btn-sm btn-purple waves-effect waves-light" onclick="addForm(this, '${materials_usage_idx}')">선택</button></td>     
    <td>
        {{if "raw" === material_kind }}
            원자재
        {{else}}
            부자재    
        {{/if}}        
    </td>
    <td>${material_name}</td>
    <td>${product_name}</td>
    <td>${company_name}</td>
    <td>${country_of_origin}</td> 
    <td>${material_unit}</td> 
    <td>${standard_info}</td> 
    <td>${material_unit_price}</td> 
</tr>
</script>
<script id="tmplate_material_choice_area_form" type="text/x-jquery-tmpl">
<tr>    
    <td>
        {{if "raw" === material_kind }}
            원자재
        {{else}}
            부자재    
        {{/if}}        
        <input type="hidden" name="materials_usage_idx[]" value="${materials_usage_idx}" >
        <input type="hidden" name="material_idx[]" value="${material_idx}" >
        <input type="hidden" name="material_kind[]" value="${material_kind}" >
    </td>
    <td>
        ${material_name}
        <input type="hidden" name="material_name[]" value="${material_name}" >        
    </td>
    <td>
        ${product_name}        
        <input type="hidden" name="product_name[]" value="${product_name}" >
    </td>
    <td>
        ${company_name}
        <input type="hidden" name="company_name[]" value="${company_name}" >
    </td>
    <td>
        ${country_of_origin}
        <input type="hidden" name="country_of_origin[]" value="${country_of_origin}" >
    </td> 
    <td>
        ${material_unit}
        <input type="hidden" name="material_unit[]" value="${material_unit}" >
    </td> 
    
    <td>
        ${standard_info}
        <input type="hidden" name="standard_info[]" value="${standard_info}" >
    </td> 
    <td>
        ${material_unit_price}
        <input type="hidden" name="material_unit_price[]" value="${material_unit_price}" >
    </td> 
    <td><input type="text" name="quantity[]" class="form-control " value="" style="min-width:100px" data-valid="num" ></td> 
    <td><button type="button" class="btn btn-sm btn-purple waves-effect waves-light" onclick="delForm(this, '${materials_usage_idx}')">삭제</button></td>     
</tr>
</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
