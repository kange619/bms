<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    출하이력 상세보기
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
                                <b>출하 정보</b>
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

                                            <?php
                                                if( $addr_idx == 0 ) {

                                                
                                            ?>
                                            본점( <?=$client_addr?> <?=$client_addr_detail?> )
                                            <?php
                                                } else {
                                            ?>
                                                <?php
                                                    foreach( $company_addrs AS $idx=>$item ){
                                                        if( $addr_idx == $item['addr_idx'] ) {
                                                ?>                                                
                                                <?=$item['addr_name']?>( <?=$item['addr']?> <?=$item['addr_detail']?> )
                                                <?php
                                                        }
                                                    }
                                                ?>

                                            <?php
                                                }
                                            ?>
                                                

                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">수주일</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <?=$order_date?>
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
                                                        <?=$delivery_date?>
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
                                        <th class="info middle-align">수량(Box)</th>
                                        <td colspan="3">
                                            <?=$quantity?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">유통기한</th>
                                        <td colspan="3">

                                            <div id="selected_expiration_date_area" >
                                                <?php
                                                    foreach( $prediction_info['prediction_day_arr'] AS $idx=>$item ) {
                                                ?>
                                                <button type="button" class="btn expiration_date_selected_btn" data-stock_idx="<?=$item['stock_idx']?>" data-stock_quantity="<?=$item['stock_quantity']?>" style="margin:5px"  ><?=$item['expiration_date']?></button>                                               
                                                <?php
                                                    }
                                                ?>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info">출고검수표</th>
                                        <td><button class="btn btn-default"><a href="http://sandle.localhost.com/doc/doc_14.php">상세보기</a></button></td>
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
               </div>
            </div>


        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->


<script>


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
            
