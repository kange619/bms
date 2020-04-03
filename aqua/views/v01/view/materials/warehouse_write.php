<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    원/부자재 입고관리  > <?=$page_work?>
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                </h1>                
            </section>

            <form class="form-horizontal" role="form" method="post" id="form_write" enctype="multipart/form-data"  action="./<?=$page_name?>_proc">                
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="order_idx" value="<?=$order_idx?>" />
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="top_code" value="<?=$top_code?>" />
                <input type="hidden" name="left_code" value="<?=$left_code?>" />
                <input type="hidden" name="ref_params" value="<?=$params?>" />
                <input type="hidden" name="file_idx" id="file_idx" value="" />
                <input type="hidden" name="del_file_idx" id="del_file_idx" value="" />

                <input type="hidden" name="materials_usage_idx" id="materials_usage_idx" value="<?=$materials_usage_idx?>" />
                <input type="hidden" name="material_idx" id="material_idx" value="<?=$material_idx?>" />
                <input type="hidden" name="company_name" id="company_name" value="<?=$company_name?>" />
                <input type="hidden" name="material_name" id="material_name" value="<?=$material_name?>" />                
                <input type="hidden" name="product_name" id="product_name" value="<?=$product_name?>" />                
                <input type="hidden" name="material_kind" id="material_kind" value="<?=$material_kind?>" />
                <input type="hidden" name="material_unit" id="material_unit" value="<?=$material_unit?>" />
                <input type="hidden" name="standard_info" id="standard_info" value="<?=$standard_info?>" />
                <input type="hidden" name="country_of_origin" id="country_of_origin" value="<?=$country_of_origin?>" />
                <input type="hidden" name="material_unit_price" id="material_unit_price" value="<?=$material_unit_price?>" />
                

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
                                                        <input type="text" class="form-control datepicker " name="order_date" id="order_date" value="<?=$order_date?>" data-valid="blank" readonly="readonly" style="width:100px !important">  
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="info middle-align">입고일</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <input type="text" class="form-control datepicker " name="receipt_date" id="receipt_date" value="<?=$receipt_date?>"  readonly="readonly" style="width:100px !important" >  
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        if( $mode != "edit" ) {
                                    ?>
                                    <tr>
                                        <th class="info middle-align">제품찾기</th>
                                        <td colspan="3"  >
                                        <button type="button" class="btn btn-sm btn-info waves-effect waves-light m-l-10" onclick="searchMaterial()">찾기</button>
                                        </td>
                                    </tr>  
                                    <?php
                                        }
                                    ?>
                                    <tr>
                                        <th class="info middle-align">회사명</th>
                                        <td colspan="3" id="company_name_area" >
                                            <?=$company_name?>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th class="info middle-align">자재명</th>
                                        <td colspan="3" id="material_name_area" >
                                            <?=$material_name?>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <th class="info middle-align">자재종류</th>
                                        <td colspan="3" id="material_kind_area" >
                                            <?php
                                                if( empty( $material_kind ) == false ) {
                                            ?>
                                            <?=( $material_kind == 'raw') ? '원자재' : '부자재';?>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">단위</th>
                                        <td colspan="3" id="material_unit_area" >
                                            <?=$material_unit?>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th class="info middle-align">규격</th>
                                        <td colspan="3" id="standard_info_area">
                                            <?=$standard_info?>
                                        </td>
                                    </tr> 

                                    <tr>
                                        <th class="info middle-align">원산지</th>
                                        <td colspan="3" id="country_of_origin_area">
                                            <?=$country_of_origin?>
                                        </td>
                                    </tr> 

                                    <tr>
                                        <th class="info middle-align">단가(원)</th>
                                        <td colspan="3" id="material_unit_price_area">
                                            <?=$material_unit_price?>
                                        </td>
                                    </tr> 

                                    <tr>
                                        <th class="info middle-align">제조일자/유통기한</th>
                                        <td colspan="3">
                                            <div class="form-group">                                            
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group">
                                                        <select class="form-control " name="available_date_type" id="available_date_type" >
                                                            <option value="MD" <?=( $available_date_type == 'MD' ? 'selected="selected"' : '')?> >제조일자</option>
                                                            <option value="ED" <?=( $available_date_type == 'ED' ? 'selected="selected"' : '')?> >유통기한</option>
                                                        </select>
                                                        <span class="input-group-addon bg-primary b-0 text-white"> : </span>
                                                        <input type="text" class="form-control datepicker " name="available_date" id="available_date" value="<?=$available_date?>"  style="width:100px !important" >  
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     
                                    <tr>
                                        <th class="info middle-align">수량</th>
                                        <td colspan="3">
                                            <input type="text" class="form-control " name="quantity"  id="quantity"  value="<?=$quantity?>" style="min-width:100px" data-valid="num" >
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 주문 정보 -->
            
            <!-- 파일 정보  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                    
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>납품 서류</b>
                                <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="addForm()">추가</button>
                            </h5>
                            <hr class="m-t-0">
                            
                            <table class="table table-bordered text-center" style="table-layout:fixed;">
								<thead>
									<tr>
										<th class="info" >서류명</th>										
										<th class="info" style="width:300px" >파일찾기</th>										
										<th class="info" style="width:150px" >삭제</th>
									</tr>
								</thead>
								<tbody id="add_file_area">									
                                    
									
                                </tbody>
							</table>

                            
                            

                        </div> 
                    
                    </div>

                </div>
            </div>
            <!-- // 파일 정보 -->


            </form>

            <div class="row"> 
                <div class="col-lg-12">
                    <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
                    <button type="button" class="pull-left btn btn-success waves-effect w-md m-l-5" onclick="register('approval_request')">입고확인</button>
                    <button type="button" class="pull-right btn btn-primary waves-effect w-md m-l-5" onclick="register('<?=$mode?>')">저장</button>
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
                                        <th class="info" style="width: 40%;">원자재명</th>
                                        <th class="info" style="width: 40%;">납품업체명</th>                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if( count( $materials ) > 0  ){
                                            foreach( $materials AS $item ) {                                                
                                    ?>
                                    <tr style="cursor: pointer;" >       
                                        <td class="text-center vertical-align">
                                            <button type="button" class="pull-right btn btn-sm btn-purple waves-effect w-md m-l-5" style="top:-4px;" onclick="choiceMaterial(this)" data-material="<?=preg_replace( '/\"/', "'" ,json_encode( $item, JSON_UNESCAPED_UNICODE ))?>">선택</button> 
                                        </td>                                 
                                        <td class="text-center vertical-align"><?=$item['material_name']?></td>
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
<!-- // 원자재 목록 레이어  -->


<script>

    $(function(){
        filesHandler();
    });

    /**
        파일 정보 확인
     */
    function filesHandler(){

        var files = <?=$receiving_docs?>;
        var file_idx = [];
        var data = [];

        $.each(files, function(idx, item){

            file_idx.push(item.idx);
            
            data.push({
                file_idx : item.idx
                ,file_title : item.file_title
                , file_origin_name : item.origin_name
                , file_server_name : item.server_name
            });
        });
        
        console.log( data );

        $('#file_idx').val(file_idx.join(','));

        $('#add_file_area').append( $('#tmplate_add_file_form').tmpl( data ) );
    }    
     /**
        파일 form 추가버튼 동작
     */
    function addForm(){

        var empty_data = [{file_title: '',  file_origin_name : '' }];

        $('#add_file_area').append( $('#tmplate_add_file_form').tmpl( empty_data ) );

    }

    /**
    * 파일 form 삭제
    */
    function delForm( arg_this, arg_del_file_idx ){

        var get_del_file_idx = $('#del_file_idx').val();
        var del_file_idx_arr, result_val;
 
        if( get_del_file_idx == '' ) {

            $('#del_file_idx').val( arg_del_file_idx );

        } else {

            if( get_del_file_idx.indexOf(',') > -1 ) {
                
                del_file_idx_arr = get_del_file_idx.split(',');
                del_file_idx_arr.push( arg_del_file_idx );
                result_val = del_file_idx_arr.join(',');

            } else {
                result_val = get_del_file_idx+','+arg_del_file_idx;
            }
            
            $('#del_file_idx').val(result_val);

        }
        

        $( arg_this ).parent().parent().remove();

    }
    
    //  업로드 버튼 이벤트 처리
    function readFile(arg_this) {

        if (arg_this.files && arg_this.files[0]) {

            if(window.FileReader){  // modern browser
				var filename = $(arg_this)[0].files[0].name;
			} 
			else {  // old IE
				var filename = $(arg_this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
			}
            
            $(arg_this).parent().find('code').text(filename);   
        }
    }


    function searchMaterial(){        
        $('#search_material_modal').modal();
    }

    function choiceMaterial( arg_this ) {       

        var data = JSON.parse( $(arg_this).data('material').replace(/'/g, '"') );

        $('#materials_usage_idx').val( data.materials_usage_idx );
        $('#material_idx').val( data.material_idx );
        $('#material_name').val( data.material_name );
        $('#product_name').val( data.product_name );
        $('#company_name').val( data.company_name );
        $('#material_unit').val( data.material_unit );
        $('#standard_info').val( data.standard_info );
        $('#material_kind').val( data.material_kind );
        $('#country_of_origin').val( data.country_of_origin );
        $('#material_unit_price').val( data.material_unit_price );
        $('#quantity').val('');

        $('#material_name_area').html( data.material_name );
        $('#company_name_area').html( data.company_name );
        $('#material_unit_area').html( data.material_unit );
        $('#standard_info_area').html( data.standard_info );
        $('#country_of_origin_area').html( data.country_of_origin );
        $('#material_unit_price_area').html( data.material_unit_price );
        
        $('#material_kind_area').html( ( data.material_kind == 'raw' ) ? '원자재' : '부자재' );

        $('#search_material_modal').modal('hide');

    }

    /**
     * 저장 버튼 동작
     */
    function register( arg_method ){

        viewFormValid.alert_type = 'add';        
        if( viewFormValid.run( 'form_write' ) === true ) {

           if( arg_method == 'approval_request' ) {
                
                if( confirm('입고확인 승인 요청을 하시겠습니까?') == false ) {
                    return;
                } 
                
                if( $('#receipt_date').val() == '' ) {
                    alert('입고일자를 입력해주세요.');
                    $('#receipt_date').focus();
                    return;
                }

                if( $('#available_date').val() == '' ) {
                    alert('제조일자/유통기한 일자를 입력해주세요.');
                    $('#available_date').focus();
                    return;
                }

           } 

           $('#mode').val( arg_method );
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

<script id="tmplate_add_file_form" type="text/x-jquery-tmpl">
<tr>
    <td><input type="text" name="file_title[]" class="form-control " value="${file_title}" style="width:100% !important" ></td>    
    <td>
        <div class="form-group">                                                
            <div class="upload-btn-wrapper">
                <button type="button" class="btn btn-primary">업로드</button>
                <input type="file" name="doc_file[]" onchange="readFile(this);" style="width:120px !important;height:50px" >                                                    
                <br/><br/><code class="control-label m-l-10"></code>
            </div>

            {{if file_origin_name }}
            <br/><br/><a href="/file_down.php?key=${file_idx}" >${file_origin_name}</a>
            {{/if}}        

        </div>
    </td>										
    <td><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delForm(this,'${file_idx}' )">삭제</button></td>
</tr>
</script>
