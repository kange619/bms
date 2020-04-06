<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    수주/출하관리  > 수주 <?=$page_work?>
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
                                        <th class="info middle-align">출하예정일</th>
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
                                        <th class="info middle-align">주문상태</th>
                                        <td colspan="3">

                                            <select class="form-control" name="process_state" id="process_state" style="width:200px" >
                                               
                                                <option value="O" <?=($process_state == 'O' ? 'selected="selected"' : '' )?> >주문</option>                                                
                                                <option value="C" <?=($process_state == 'C' ? 'selected="selected"' : '' )?> >취소</option>
                                                
                                            </select>

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
                                            <input type="text" name="quantity" class="form-control " value="<?=$quantity?>" style="min-width:100px" data-valid="num" >
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
    function register(){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {

            // if( $('#process_state').val() == 'W' ) {
            //     if( $('#receipt_date').val() == '' ) {
            //         alert('입고완료일을 입력해주세요.');
            //         $('#receipt_date').focus();
            //         return;                    
            //     }
            // }

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

<script type="text/javascript" src="<?=$aqua_view_path;?>/public/js/view.form.valid.js"></script>
            
