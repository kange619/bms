<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link href="../public/css/common.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../public/css/doc.css" />
    <script src="../public/js/jquery.min.js"></script>
  </head>
  <body>
    <div id="wrap">
      <section>
        <div class="record_table">
          <table class="ccp_table">
            <!-- 제목 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <th class="info" rowspan="2" style="font-size:24px;">
                      중요관리점(CCP-1B) 모니터링일지
                      <span class="sub_title">[세척공정 (쌀가루)]</span>
                    </th>
                    <th class="info" rowspan="2" style="width:5%;">결재</th>
                    <th class="info" style="width:15%;">작성자</th>
                    <th class="info" style="width:15%;">승인자</th>
                  </tr>
                  <tr>
                    <td class="qr_code" style="height:60px;"></td>
                    <td class="qr_code"></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 제목 끝 -->
            <!-- 작성일자, 점검자 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td class="info" style="width: 100px;">작성일자</td class="info">
                    <td></td>
                    <td class="info" style="width: 100px;">점검자</td style="width: 100px;">
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 작성일자, 점검자 끝 -->
            <!-- 한계기준, 주기 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                  <tr>
                    <td class="info" rowspan="2" style="width: 100px;">한계기준</td>
                    <td>원료량</td>
                    <td>세척수량</td>
                    <td>세척시간</td>
                    <td>세척횟수</td>
                    <td>세척수 교체주기</td>
                  </tr>
                  <tr>
                    <td>300kg 이하</td>
                    <td>120L 이상</td>
                    <td>3분 이상</td>
                    <td>2회 이상</td>
                    <td>매 세척 시미다</td>
                  </tr>
                  <tr>
                    <td class="info" style="width: 100px;">주기</td class="info">
                    <td colspan="5">매 작업 시마다</td>
                  </tr>
                  <tr>
                    <td class="info">방법</td>
                    <td colspan="4">
                      <pre class="pre_font">
▪ 원 료 량 : 포장재 중량 확인, 저울로 확인
▪ 세척수량 : 계량계, 측정자(물 높이)를 이용하여 확인 - 세척수량 적합/부적합
▪ 세척시간 : 타이머(시계)로 확인 (세척수량 확인 후 세척·탈수 까지) 
▪ 세척수 교체주기 : 육안 확인</pre>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 한계기준, 주기 끝 -->
            <!-- 기록 시작 -->
            <!--
                차수는 16번까지, 늘어날 수 있음
            -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                  <tr>
                    <td style="width: 50px;">차수</td>
                    <td>측정시각</td>
                    <td>원료량</td>
                    <td>세척수량<br>(적합/부적합)</td>
                    <td>세척시간</td>
                    <td>세척횟수</td>
                    <td>세척수 교체 확인<br>(적합/부적합)</td>
                    <td>판정<br>(적합/부적합)</td>
                  </tr>
                  <!-- 1차  -->
                  <tr>
                    <td>1</td>
                    <td> : </td>
                    <td> kg</td>
                    <td>
                        <span class="chk_radio">
                            <label for="">적합</label>
                            <input type="radio" id="" name="">
                        </span>
                        <span class="chk_radio">
                            <label for="">부적합</label>
                            <input type="radio" id="" name="">
                        </span>
                    </td>
                    <td> 분 초</td>
                    <td>3</td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                  </tr>
                  <!-- 2차  -->
                  <tr>
                    <td>2</td>
                    <td> : </td>
                    <td> kg</td>
                    <td>
                        <span class="chk_radio">
                            <label for="">적합</label>
                            <input type="radio" id="" name="">
                        </span>
                        <span class="chk_radio">
                            <label for="">부적합</label>
                            <input type="radio" id="" name="">
                        </span>
                    </td>
                    <td> 분 초</td>
                    <td>3</td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                  </tr>
                  <!-- 3차  -->
                  <tr>
                    <td>3</td>
                    <td> : </td>
                    <td> kg</td>
                    <td>
                        <span class="chk_radio">
                            <label for="">적합</label>
                            <input type="radio" id="" name="">
                        </span>
                        <span class="chk_radio">
                            <label for="">부적합</label>
                            <input type="radio" id="" name="">
                        </span>
                    </td>
                    <td> 분 초</td>
                    <td>3</td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                  </tr>
                  <!-- 4차  -->
                  <tr>
                    <td>4</td>
                    <td> : </td>
                    <td> kg</td>
                    <td>
                        <span class="chk_radio">
                            <label for="">적합</label>
                            <input type="radio" id="" name="">
                        </span>
                        <span class="chk_radio">
                            <label for="">부적합</label>
                            <input type="radio" id="" name="">
                        </span>
                    </td>
                    <td> 분 초</td>
                    <td>3</td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                  </tr>
                  <!-- 5차  -->
                  <tr>
                    <td>5</td>
                    <td> : </td>
                    <td> kg</td>
                    <td>
                        <span class="chk_radio">
                            <label for="">적합</label>
                            <input type="radio" id="" name="">
                        </span>
                        <span class="chk_radio">
                            <label for="">부적합</label>
                            <input type="radio" id="" name="">
                        </span>
                    </td>
                    <td> 분 초</td>
                    <td>3</td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="">적합</label>
                        <input type="radio" id="" name="">
                      </span>
                      <span class="chk_radio">
                        <label for="">부적합</label>
                        <input type="radio" id="" name="">
                      </span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 기록 끝 -->
            <!-- 개선조치방법 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td class="info" style="width: 100px;">개선조치방법</td>
                    <td>
                      <pre class="pre_font">
▪ 모니터링 담당자는 즉시 작업을 중지한다.
 ▪ 모니터링 담당자는 원료량, 세척수량, 세척시간을 정상적으로 재조정 한다. 
 ▪ 모니터링 담당자는 재세척을 한다.
 ▪ 재세척한 내역을 기록 후 HACCP팀장에게 보고한다.</pre>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 개선조치방법 끝 -->
            <!-- 조치 및 확인 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr class="info">
                    <td>한계기준 이탈내용</td>
                    <td>개선조치 및 결과</td>
                    <td>조치자</td>
                    <td>확인</td>
                  </tr>
                  <tr>
                    <td style="height:100px; min-width: heifght 100px;"></td>
                    <td></td>
                    <td style="width: 100px;"></td>
                    <td style="width:100px""></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 조치 및 확인 끝 -->
          </table>
        </div>
      </section>
    </div>
  </body>
</html>
