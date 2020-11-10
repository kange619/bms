<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    원/부자재 기준 관리  > <?=$page_work?>
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

           <!-- 서비스 정보 -->
           <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>품목 정보</b>    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody> 
                                    <tr>
										<th class="info">분류</th>
                                        <td class="text-left" colspan="3">
                                            <select class="form-control" name="material_kind" style="width:30%">
                                                <option value="raw" <?=($material_kind == 'raw' ? 'selected="selected"' : '' )?> >원자재</option>
                                                <option value="sub" <?=($material_kind == 'sub' ? 'selected="selected"' : '' )?> >부자재</option>
                                            </select>
										</td>
									</tr>
                                    <tr>
                                        <th class="info middle-align">품목</th>
                                        <td colspan="3" >                                            
                                            <input type="text" class="form-control " name="material_name" id="material_name" value="<?=$material_name?>" data-valid="blank" style="width:40%"  >     
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info middle-align">단위용량(중량)</th>
                                        <td colspan="3" >
                                        
                                            <select class="form-control" name="net_contents" style="width:30%">
                                                <option value="kg" <?=($net_contents == 'kg' ? 'selected="selected"' : '' )?> >kg</option>
                                                <option value="g" <?=($net_contents == 'g' ? 'selected="selected"' : '' )?> >g</option>
                                                <option value="L" <?=($net_contents == 'L' ? 'selected="selected"' : '' )?> >L</option>
                                                <option value="ml" <?=($net_contents == 'ml' ? 'selected="selected"' : '' )?> >ml</option>
                                                <option value="개" <?=($net_contents == '개' ? 'selected="selected"' : '' )?> >개</option>
                                            </select>        
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
										<th class="info">사용여부</th>
                                        <td class="text-left" colspan="3">
                                            <select class="form-control" name="use_flag" style="width:200px">
                                                <option value="Y" <?=($use_flag == 'Y' ? 'selected="selected"' : '' )?> >사용</option>
                                                <option value="N" <?=($use_flag == 'N' ? 'selected="selected"' : '' )?> >미사용</option>
                                            </select>
										</td>
									</tr>

                                    <tr>
                                        <th class="info middle-align">기준서</th>
                                        <td colspan="3" >                                            
                                            <div class="form-group">                                                
                                                <div class="upload-btn-wrapper">
                                                    <button type="button" class="btn btn-primary">업로드</button>
                                                    <input type="file" name="material_std_file" id="material_std_file"  onchange="readFile(this, 'material_std_file');">                                                    
                                                    <code class="control-label m-l-10 material_std_file"></code>
                                                    
                                                </div>

                                                <?php
                                                    if( isset( $file_origin_name ) == true ) {
                                                ?>
                                                <br/><br/><a href="/file_down.php?key=<?=$file_idx?>" ><?=$file_origin_name?></a>
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
            <!-- //서비스 정보 --> 

           
           
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
            
