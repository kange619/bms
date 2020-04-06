<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    수주관리  > 주문 <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" value="<?=$mode?>" />
                <input type="hidden" name="order_idx" value="<?=$order_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="page_name" value="<?=$page_name?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="client_idx" id="client_idx" value="<?=$client_idx?>" />
                <input type="hidden" id="products" value="<?=preg_replace( '/\"/', "'", $products)?>" />
                <input type="hidden" id="client_addrs" value="<?=preg_replace( '/\"/', "'", $client_addrs)?>" />
                <input type="hidden" name="order_del_idx" id="order_del_idx" value="" />
            


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
                                        <th class="info middle-align">                                            
                                            <button type="button" class="btn btn-sm btn-info waves-effect waves-light m-l-10" onclick="searchClient()">회사찾기</button>
                                        </th>
                                        <td colspan="3" id="client_company_name_area" >
                                            <?=$company_name?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">                                            
                                            회사주소
                                        </th>
                                        <td colspan="3" id="client_company_addr_area" >
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="info middle-align">수주일</th>
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
                                        <th class="info middle-align">출하일</th>
                                        <td colspan="3">
                                            <input type="text" class="form-control datepicker " name="delivery_date" id="delivery_date" value="<?=$delivery_date?>"  readonly="readonly" style="width:100px !important" >  
                                            <span>
                                                <input type="checkbox" id="sync_delivery_date" value="Y"  style="width: 20px !important;margin-left:10px" checked="checked" > 
                                                <label for="sync_delivery_date" style="cursor:pointer">출하일 일치</label>
                                            </span>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 주문 정보 -->

            <!-- 재고 현황 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>제품 현황</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
										<th class="info" style="width:100px">선택</th>
										<th class="info">제품명</th>										
										<th class="info">제품정보</th>                                        
                                        <th class="info">재고량</th>										
									</tr>
								</thead>
								<tbody id="materials_area" >
                                
                                </tbody>
							</table>
                        </div> 

                    </div>

                </div>
            </div>
            <!-- //재고 현황 -->

            <!-- 선택 현황 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>선택 제품</b>                    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>										
										<th class="info">제품명</th>																				
										<th class="info">제품정보</th>										
                                        <th class="info">배송지</th>                                        
                                        <th class="info">출하일</th>
                                        <th class="info">수량</th>
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
            <!-- //선택 현황 -->

            
            
            
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



<!-- 수주업체 레이어  -->
<div id="search_client_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <th class="info" style="width: 40%;">고객사</th>                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $clients ) > 0  ){
                                            foreach( $clients AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >       
                                        <td class="text-center vertical-align">
                                            <button type="button" class=" btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceClient(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
                                        </td>                                 
                                        <td class="text-center vertical-align"><?=$item['company_name']?></td>                                        
                                        
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr style="cursor: pointer;" >
                                        <td colspan="4" class="text-center">
                                            기업 정보가 없습니다.
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
<!-- // 수주업체 레이어  -->

<script>

    $(function(){        
        makeProductsState();

        jqueryAddEvent({
            selector : '#sync_delivery_date'
            ,event : 'click'
            ,fn : syncDeliveryDateHandler
        });
    })
    /**
        출하일 일치 체크박스 클릭 이벤트처리 
    */
    function syncDeliveryDateHandler(){

        var checked_status = $(this).prop('checked');

        $.each( $('#tmplate_material_choice_area').find('input[name="delivery_date[]"]'), function(){

            if( checked_status == true ) {
                $(this).val( $('#delivery_date').val() );
            } 
            
        });
    }

    /**
        제품 선택 버튼 동작
     */
     function choiceProduct( arg_this, arg_product_unit_idx){ 

        if( $('#client_idx').val() == '' ) {
            alert('업체를 선택해주세요');            
            return;
        }

        var data = [];

        products_obj[arg_product_unit_idx]['order_idx'] = ''; //#  order_idx 공백값으로 추가하여 insert 되게끔 한다.
        products_obj[arg_product_unit_idx]['client_addrs'] = current_client_company_addr; 
        
        if( $('#sync_delivery_date').prop('checked') == true ) {
            products_obj[arg_product_unit_idx]['delivery_date'] = $('#delivery_date').val(); 
        } else {
            products_obj[arg_product_unit_idx]['delivery_date'] = ''; 
        }

        
        data = [products_obj[arg_product_unit_idx]];
        products_obj[arg_product_unit_idx].element = arg_this;

        // $( arg_this ).hide();

        $('#tmplate_material_choice_area').append( $('#tmplate_product_choice_area_form').tmpl( data ) );
        
        $('.datepicker').datepicker({
            calendarWeeks: false,
            todayHighlight: true,
            autoclose: true,
            toggleActive: true,
            format: "yyyy-mm-dd",
            language: "kr",
            clearBtn: true
        });
        
     }

     /**
      * 제품 현황 목록 생성
      */
     var products_obj = {};
     function makeProductsState(){

         var products_arr = JSON.parse( $('#products').val().replace(/'/g, '"') );
// console.log( products_arr );
        $.each(products_arr, function(idx, val){            
            products_obj[val.product_unit_idx] = val;
        });
        
         if( typeof( products_arr ) == 'object' ) {

            $('#materials_area').html( $('#tmplate_product_area_form').tmpl( products_arr ) );

         }

     }

     /**
      * 선택 제품 삭제
      */
     function delForm( arg_this, arg_product_unit_idx ){
        

        var order_del_idx = $('#order_del_idx').val();

        if( order_del_idx == '') {
            order_del_idx = [];
        } else {
            order_del_idx = order_del_idx.split(',');
        }

        if( arg_product_unit_idx !== '' ) {
            order_del_idx.push( arg_product_unit_idx );

            $('#order_del_idx').val( order_del_idx.join(',') );
        }

        
        $( arg_this ).parent().parent().remove();

        // $( materials_obj[arg_product_unit_idx].element ).show();

        products_obj[arg_product_unit_idx].element = '';

     }

    /**
        수주업체 레이어 오픈
     */
    function searchClient(){
        $('#search_client_modal').modal();
    }
    /**
        수주업체 선택
    */
    var current_client_company = {};
    var current_client_company_addr = {};
    function choiceClient( arg_this ){

        var data = JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );
        var client_addrs = JSON.parse( $('#client_addrs').val().replace(/'/g, '"') );

        current_client_company = data;
        current_client_company_addr = client_addrs[ data.client_idx ];
        
        console.log(  data );
        $('#client_idx').val( data.client_idx );
        $('#client_company_name_area').html( data.company_name );
        $('#client_company_addr_area').html( data.client_addr +' '+ data.client_addr_detail );
        $('#search_client_modal').modal('hide');
    }
    /**
     * 저장 버튼 동작
     */
    function register(){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {

            if( $('#client_idx').val() == '' ) {
                alert('수주회사를 선택해주세요.');
                return;
            }

            if( $('input[name="product_unit_idx[]"]').length == 0 ){
                alert('주문 제품을 하나 이상 선택해주세요.');
                return;
            }

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
<script id="tmplate_product_area_form" type="text/x-jquery-tmpl">
<tr>
    <td>
        
        {{if stock_quantity > 0 }}
            <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" onclick="choiceProduct(this, '${product_unit_idx}')" >선택</button>
        {{else}}
            재고없음
        {{/if}}

    </td>         
    <td>${product_name}</td>
    <td>
        {{if stock_quantity > 0 }}
            ${product_unit}${product_unit_type} X ${packaging_unit_quantity}
        {{else}}
            -
        {{/if}}
    </td>   
    <td>${stock_quantity}</td> 
</tr>
</script>
<script id="tmplate_product_choice_area_form" type="text/x-jquery-tmpl">
<tr>    
    <td>
        <input type="hidden" name="order_idx[]" value="${order_idx}" >
        <input type="hidden" name="product_idx[]" value="${product_idx}" >
        <input type="hidden" name="product_name[]" value="${product_name}" >
        <input type="hidden" name="food_code[]" value="${food_code}" >
        <input type="hidden" name="product_unit_idx[]" value="${product_unit_idx}" >
        <input type="hidden" name="product_unit[]" value="${product_unit}" >
        <input type="hidden" name="product_unit_type[]" value="${product_unit_type}" >
        <input type="hidden" name="packaging_unit_quantity[]" value="${packaging_unit_quantity}" >
        ${product_name}        
    </td>    
    <td>        
        ${product_unit}${product_unit_type} X ${packaging_unit_quantity}
    </td>    
    <td>
        <select class="form-control width100 " name="addr_idx[]" >            
            {{each(idx, item) client_addrs}}
                <option value="${(item.addr_idx)}">${(item.addr_name)}</option>
            {{/each}}
        </select>
    </td> 
    <td>        
        <input type="text" class="form-control datepicker" name="delivery_date[]"  value="${delivery_date}" style="min-width:100px" placeholder="yyyy-mm-dd" data-valid="blank" >
    </td>    
    <td><input type="text" name="quantity[]" class="form-control " value="${quantity}" style="min-width:100px" data-valid="num" ></td> 
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this, '${order_idx}')">삭제</button></td>     
</tr>
</script>
<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
