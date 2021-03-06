<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    수주/출하관리  > 출하
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="order_idx" value="<?=$order_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="page_name" value="<?=$page_name?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="product_stock_idxs" id="product_stock_idxs" value="<?=$product_stock_idxs?>" />
                <input type="hidden" name="total_stock_sum" id="total_stock_sum" value="<?=$prediction_info['total_stock_sum']?>" />
            

            <!-- 주문 정보  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>수주 정보</b>
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-left">
                                <tbody>
                                    
                                    <tr>
                                        <th class="info middle-align">회사명</th>
                                        <td colspan="3">
                                            <?=$company_name?>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th class="info middle-align">배송지</th>
                                        <td colspan="3">

                                            <select class="form-control" name="addr_idx" id="addr_idx" style="width:200px" >
                                               
                                                <option value="0" <?=($addr_idx == '0' ? 'selected="selected"' : '' )?> >본점</option>
                                                <?php
                                                    foreach( $company_addrs AS $idx=>$item ){
                                                ?>                                                
                                                <option value="<?=$item['addr_idx']?>" <?=($addr_idx == $item['addr_idx'] ? 'selected="selected"' : '' )?> ><?=$item['addr_name']?></option>                                                
                                                <?php
                                                    }
                                                ?>
                                                
                                                
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">수주일</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="order_date" id="order_date" value="<?=$order_date?>" data-valid="blank" readonly="readonly" style="width:100px !important">  
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">출하일</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="delivery_date" id="delivery_date" value="<?=$delivery_date?>"  readonly="readonly" style="width:100px !important" >  
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     
                                    <tr>
                                        <th class="info middle-align">제품명</th>
                                        <td colspan="3">
                                            <?=$product_name?>
                                        </td>
                                    </tr>                    
                                   
                                    <tr>
                                        <th class="info middle-align">제품정보</th>
                                        <td colspan="3">
                                            <?=$product_unit?><?=$product_unit_type?> X <?=$packaging_unit_quantity?>
                                        </td>
                                    </tr> 
                                   
                                    <tr>
                                        <th class="info middle-align">수량</th>
                                        <td colspan="3">
                                            <input type="text" class="form-control " name="quantity" id="quantity"  value="<?=$quantity?>" style="min-width:100px" data-valid="num" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">유통기한</th>
                                        <td colspan="3">

                                            <select class="form-control" name="expiration_dates" id="expiration_dates" style="width:200px" >
                                                <option value="">선택하세요</option>
                                                <?php
                                                    foreach( $quantity_expiration_date_arr AS $idx=>$item ){
                                                ?>                                                
                                                <option value="<?=$item['stock_idx']?>"><?=$item['expiration_date']?> ( <?=number_format( $item['stock_quantity'] )?> )</option>                                                
                                                <?php
                                                    }
                                                ?>
                                                
                                                
                                            </select>

                                            <div id="selected_expiration_date_area" >
                                                <?php
                                                    foreach( $prediction_info['prediction_day_arr'] AS $idx=>$item ) {
                                                ?>
                                                <button type="button" class="btn expiration_date_selected_btn" data-stock_idx="<?=$item['stock_idx']?>" data-stock_quantity="<?=$item['stock_quantity']?>" style="margin:5px"  ><?=$item['expiration_date']?>( <?=$item['stock_quantity']?> )</button>                                               
                                                <?php
                                                    }
                                                ?>
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
                    <button type="button" class="pull-left btn btn-success waves-effect w-md m-l-5" onclick="register('approval_request')">출하확인</button>
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register('<?=$mode?>')">저장</button>
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


<script>

    $(document).ready(function(){
        
        jqueryAddEvent({
            selector : '#expiration_dates'
            ,event : 'change'
            ,fn : expirationDatesHandler
        });

        jqueryAddEvent({
            selector : '.expiration_date_selected_btn'
            ,event : 'click'
            ,fn : expirationDateSelectedHandler
        });
 
    });

    /**
        유통기한 선택 이벤트
     */
    function expirationDatesHandler(){
        
        var product_stock_idxs = [];

        if( $('#product_stock_idxs').val() != '' ){            
            product_stock_idxs = $('#product_stock_idxs').val().split(',');
        }

        var text_data = this.options[this.selectedIndex].text;
        var text_data_quantity = Number( text_data.match(/\((.*?)\)/gi,'')[0].replace(/[^0-9]/gi, '') );
        var total_stock_sum = Number( $('#total_stock_sum').val() );

        if( !( product_stock_idxs.indexOf( $(this).val() ) > -1 ) ) {

            product_stock_idxs.push( $(this).val() );

            $('#product_stock_idxs').val(product_stock_idxs.join(','));
            $('#total_stock_sum').val( text_data_quantity + total_stock_sum );

            $('#selected_expiration_date_area').append( '<button type="button" class="btn expiration_date_selected_btn" data-stock_idx="'+ $(this).val() +'" data-stock_quantity="'+ text_data_quantity +'" style="margin:5px" >'+text_data+'</button>' );

            jqueryAddEvent({
                selector : '.expiration_date_selected_btn'
                ,event : 'click'
                ,fn : expirationDateSelectedHandler
            });

        }

    }
    /**
        유통기한 버튼 클릭 이벤트
     */
    function expirationDateSelectedHandler(){

        var this_stock_idx = $(this).data('stock_idx');
        var stock_quantity = Number( $(this).data('stock_quantity') );
        var product_stock_idxs = $('#product_stock_idxs').val().split(',');
        var total_stock_sum = Number( $('#total_stock_sum').val() );

        product_stock_idxs.splice( product_stock_idxs.indexOf( this_stock_idx ), 1 );

        $('#product_stock_idxs').val(product_stock_idxs.join(','));
        $('#total_stock_sum').val( total_stock_sum - stock_quantity );
        
        $(this).remove();

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
    

    /**
     * 저장 버튼 동작
     */
    function register( arg_method ){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {

            if( arg_method == 'approval_request' ) {
                
                if( confirm('출하 확인 승인 요청을 하시겠습니까?') == false ) {
                    return;
                } 
                
                if( $('#product_stock_idxs').val() == '' ) {
                    alert('유통기한을 선택해주세요.');
                    $('#expiration_dates').focus();
                    return;
                }

                if( Number( $('#quantity').val() ) > Number( $('#total_stock_sum').val() ) ) {
                    alert('재고 수량('+ $('#total_stock_sum').val() +') 보다 더 큰 값을 입력하였습니다.\n수량을 확인해주세요.');
                    $('#quantity').focus();
                    return;
                }

                
           } 

            // submit
            $('#mode').val( arg_method );
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

<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
