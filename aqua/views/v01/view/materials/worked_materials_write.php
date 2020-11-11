<!-- Start content-page -->
<div class="content-page" >
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <section class="content-header">                    
                <h1>
                    가공원료 기준등록  > <?=$page_work?>
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

            <!-- 기본정보 -->
           <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>기본정보</b>    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>                                                                         
                                    <tr>                                                                                                                                              
                                        <th class="info">품명</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name="" > 
										</td>                                      
                                        <th class="info">분류</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <select class="form-control" name="" style="width:30%">
                                                <option value="raw">원자재</option>
                                                <option value="sub">부자재</option>
                                            </select>                                            
										</td>                                                                                 
									</tr>                                                                           
                                    <tr>                                                                                                                                              
                                        <th class="info">판매원</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">보관방법</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                        <input type="text" class="form-control" name="" > 
										</td>                                                                                 
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">생산지</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">등급</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                        <input type="text" class="form-control" name="" > 
										</td>                                                                                 
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">성상(색상)</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">주요원재료</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                 
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">적정재고</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">기타</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                        <input type="text" class="form-control" name="" > 
										</td>                                                                                 
									</tr>                                    
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- 기본정보 --> 

            <!-- 포장규격 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>포장규격</b>    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>                                                                         
                                    <tr>                                                                                                                                              
                                        <th class="info">내 포장형태</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">외 포장형태</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name="">                                          
										</td>                                                                                 
									</tr>                                                                           
                                    <tr>                                                                                                                                              
                                        <th class="info">중량</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">표시사항</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                 
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">기타</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info"></th>
                                        <td class="text-left" colspan="1" width="500px">                                                                                    
										</td>                                                                                 
									</tr>                                                                    
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- 포장규격 --> 

            <!-- 공전분류 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>공전분류</b>    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>                                                                         
                                    <tr>                                                                                                                                              
                                        <th class="info">영업허가</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">식품의종류</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name="">                                          
										</td>                                                                                 
									</tr>                                                                           
                                    <tr>                                                                                                                                              
                                        <th class="info">식품의유형</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">유통기한</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                 
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">정의</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info"></th>
                                        <td class="text-left" colspan="1" width="500px">                                                                                    
										</td>                                                                                 
									</tr>                                                                    
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- 공전분류 --> 
            <!-- 입고검수규격 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">                        
                        <div class="table-responsive m-b-0">
                            <h5 class="header-title m-b-10">
                                <b>입고검수규격</b>    
                            </h5>
                            <hr class="m-t-0">
                            <table class="table table-bordered text-left">
                                <tbody>                                                                         
                                    <tr>                                                                                                                                              
                                        <th class="info">허가사항</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">품목제조보고</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name="">                                          
										</td>                                                                                 
									</tr>                                                                           
                                    <tr>                                                                                                                                              
                                        <th class="info">원료첨가물</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">표시사항</th>
                                        <td class="text-left" colspan="1" width="500px">                                            
                                            <input type="text" class="form-control" name=""> 
										</td>                                                                                 
									</tr>
                                    <tr>                                                                                                                                              
                                        <th class="info">유통기한정의</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name=""> 
										</td>                                      
                                        <th class="info">오기</th>
                                        <td class="text-left" colspan="1" width="500px">                                                                                    
                                            <input type="text" class="form-control" name="">
										</td>                                                                                 
									</tr>                                        
                                    <tr>                                                                                                                                              
                                        <th class="info">품질규격</th>
                                        <td class="text-left" colspan="1" width="500px">
                                            <input type="text" class="form-control" name="">
                                            <input type="text" class="form-control" name=""> 
                                            <input type="text" class="form-control" name=""> 
                                            <input type="text" class="form-control" name="">
                                            <input type="text" class="form-control" name=""> 
                                            <input type="text" class="form-control" name="">  
										</td>  
                                        <td class="text-left" colspan="2">                                                                            
                                            <input type="text" class="form-control" name="">
                                            <input type="text" class="form-control" name="">  
                                            <input type="text" class="form-control" name="">
                                            <input type="text" class="form-control" name="">
                                            <input type="text" class="form-control" name=""> 
                                            <input type="text" class="form-control" name="">                                                                                         
										</td>                                                                                 
									</tr> 
                                    <tr>                                                                                                                                              
                                        <th class="info">기타</th>
                                        <td class="text-left" colspan="3" width="500px">
                                            <input type="text" class="form-control" name="">                                             
										</td>  
                                                                                                                       
									</tr>                                                                                                       
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- 입고검수규격 -->             

                   
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
            
