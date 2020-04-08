<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link href="../public/css/common.css" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="./_css/webview.css">
    <script>
        function focusEvent( arg_type ) {
            
            // 달력 함수 : callDatePicker() / 시간 함수 : callTimePicker()

            if( arg_type == 'day') {
                var return_val = window.masicgong.callDatePicker();
            } else {
                var return_val = window.masicgong.callTimePicker();

                alert( return_val );
            }
            
        }

        function checkCallback( arg_data ) {
            alert( arg_data );
            
        }

        function buttonClick() {            
            window.masicgong.onFinish();
        }

    </script>
</head>
<body>
<div id="webViewWrap">
    <form action="" name="">
        <div class="webView_doc">
            <!-- 상단 공통부분 -->
            <section class="webView_sec">
                <ul class="input_list">
                    <h2 class="doc_title">육안검사일지</h2>
                    <li>
                        <div class="input_div">
                            <div class="input_cell">
                                <h4 class="input_title">작성일자</h4>
                                <input type="text" name="" id="" class="form_input" onfocus="focusEvent('day')" >
                            </div>
                            <div class="input_cell">
                                <h4 class="input_title">점검자</h4>
                                <input type="text" name="" id="" class="form_input" onfocus="focusEvent('time')" value="<?=$_SESSION[ 'member_no' ]?>" >
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
            <!-- 기록 -->
            <!-- 
                번호 : 8번까지(8행) input_list 반복
                간격 : 클래스명 .input_list.marginTop 으로 간격 줌
             -->
            <section class="webView_sec">
                <div class="section_wrap">
                    <h3 class="section_title">입고기록</h3>
                    <ul class="input_list marginTop">
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">번호</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="strong">1번</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">입고일시</h4>
                                </div>
                                <div class="input_cell">
                                    <input type="text" name="calendar" id="calendar" class="form_input" placeholder="0000-00-00"  >
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">품명</h4>
                                </div>
                                <div class="input_cell">
                                    <input type="text" name="" id="" class="form_input" placeholder="품명">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">성적서(구비여부)</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_1" class="" id="chk_y_1" /><label for="chk_y_1">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_1" class="" id="chk_n_1" /><label for="chk_n_1">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">성적서(항목적합)</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_2" class="" id="chk_y_2" /><label for="chk_y_2">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_2" class="" id="chk_n_2" /><label for="chk_n_2">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">유통기한</h4>
                                </div>
                                <div class="input_cell">
                                    <input type="date" name="" id="" class="form_input" placeholder="0000-00-00">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">차량온도</h4>
                                </div>
                                <div class="input_cell">
                                    <input type="text" name="" id="" class="form_input" placeholder="℃">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">차량상태</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_3" class="" id="chk_y_3" /><label for="chk_y_3">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_3" class="" id="chk_n_3" /><label for="chk_n_3">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">파렛트</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_4" class="" id="chk_y_4" /><label for="chk_y_4">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_4" class="" id="chk_n_4" /><label for="chk_n_4">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">외포장재</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_5" class="" id="chk_y_5" /><label for="chk_y_5">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_5" class="" id="chk_n_5" /><label for="chk_n_5">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">내포장재</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_6" class="" id="chk_y_6" /><label for="chk_y_6">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_6" class="" id="chk_n_6" /><label for="chk_n_6">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">성상</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_7" class="" id="chk_y_7" /><label for="chk_y_7">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_7" class="" id="chk_n_7" /><label for="chk_n_7">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">이물혼입</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_8" class="" id="chk_y_8" /><label for="chk_y_8">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_8" class="" id="chk_n_8" /><label for="chk_n_8">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">표시기준</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_9" class="" id="chk_y_9" /><label for="chk_y_9">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_9" class="" id="chk_n_9" /><label for="chk_n_9">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">적합여부</h4>
                                </div>
                                <div class="input_cell">
                                    <div class="input_chk_wrap">
                                        <div class="input_chk">
                                            <input type="radio" name="chk_10" class="" id="chk_y_10" /><label for="chk_y_10">적합</label>
                                        </div>
                                        <div class="input_chk">
                                            <input type="radio" name="chk_10" class="" id="chk_n_10" /><label for="chk_n_10">부적합</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="input_div">
                                <div class="input_cell">
                                    <h4 class="input_title">부적합시 조치내용</h4>
                                </div>
                                <div class="input_cell">
                                    <input type="text" name="" id="" class="form_input">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
            <!-- 임시저장/승인요청 -->
            <section class="webView_sec">
                <div class="submit_wrap">
                    <div class="input_div">
                        <div class="input_cell">
                            <button type="button" id="tempSave_btn" class="form_input submit_btn button-effect-a reporter"  >임시저장</button>     
                        </div>
                        <div class="input_cell">
                            <button type="button" id="approval_btn" class="form_input submit_btn button-effect-b approval" onclick="buttonClick()" >승인요청</button>               
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- 팝업 -->
        <div id="tempSave_wrap" class="pop_alert">
            <div class="pop_bg">
                <div class="pop_wrap">
                    <div class="pop_cont_wrap">
                        <div class="pop_cont">
                            <h3>임시저장</h3>
                            <p>작성한 정보를 임시저장 하시겠습니까?</p>
                            <div class="input_div">
                                <div class="input_cell">
                                    <button type="button" class="form_input submit_btn reporter" onclick="cancelBtn()">취소</button>     
                                </div>
                                <div class="input_cell">
                                    <button type="button" id="tempSave" class="form_input submit_btn approval">확인</button>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="approval_wrap" class="pop_alert">
            <div class="pop_bg">
                <div class="pop_wrap">
                    <div class="pop_cont_wrap">
                        <div class="pop_cont">
                            <h3>승인요청</h3>
                            <p>승인요청된 정보는 수정할 수 없습니다. 승인요청 하시겠습니까?</p>
                            <div class="input_div">
                                <div class="input_cell">
                                    <button type="button" class="form_input submit_btn reporter" onclick="cancelBtn()">취소</button>     
                                </div>
                                <div class="input_cell">
                                    <button type="submit" id="approval" class="form_input submit_btn approval">확인</button>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>