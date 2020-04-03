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
                      <span class="sub_title">[가열공정 (떡류)]</span>
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
                    <td class="info text_bold" style="width: 100px;">작성일자</td>
                    <td></td>
                    <td class="info text_bold" style="width: 100px;">점검자</td>
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
                    <td class="info text_bold" rowspan="2" style="width: 100px;">한계기준</td>
                    <td>가열량</td>
                    <td>세팅온도</td>
                    <td>가열시간</td>
                    <td>가열 후 품온</td>
                  </tr>
                  <tr>
                    <td>8단(5kg) 이하</td>
                    <td>110~120℃</td>
                    <td>30~40분</td>
                    <td>90℃ 이상</td>
                  </tr>
                  <tr>
                    <td class="info text_bold" rowspan="2" style="width: 100px;">주기</td class="info">
                    <td>가열량</td>
                    <td>세팅온도</td>
                    <td>가열시간</td>
                    <td>가열 후 품온</td>
                  </tr>
                  <tr>
                    <td colspan="4">작업 시작 시, 작업 중 2시간마다, 작업 종료 시</td>
                  </tr>
                  <tr>
                    <td class="info text_bold">방법</td>
                    <td colspan="4">
                      <pre class="pre_font">
○ 가열량, 세팅온도, 가열시간
모니터링담당자는 가열량은 저울, 세팅온도는 가열기 온도조절기, 가열시간은 타이머를 확인하여 CCP-1B(떡류) 모니터링일지에 기록한다.
○ 가열 후 품온
모니터링담당자는 가열이 완료된 제품에 대해 탐침형 온도계로 제품 최상단의 중심부온도를 10초간 측정하여 CCP-1B(떡류) 모니터링일지에 기록하고 HACCP팀장에게 보고한다.
※ 가열기 온도계/타이머 및 탐침형 온도계는 연 1회 검·교정을 실시한다.
                      </pre>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 한계기준, 주기 끝 -->
            <!-- 기록 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                  <tr>
                    <td style="width: 50px;">차수</td>
                    <td>가열기 번호</td>
                    <td>측정시각</td>
                    <td>가열량</td>
                    <td>세팅온도</td>
                    <td>가열시간<br>(타이머)</td>
                    <td>가열 후 품온<br>(탐침형온도계)</td>
                    <td>판정<br>(적합/부적합)</td>
                    <td>비고</td>
                  </tr>
<?
                  // 차수 : 4차까지, 늘어날 수 있음
                  // 가열기 번호 : A~D까지, 늘어날 수 있음
?>
                  <!-- 1차 -->
                  <tr>
                    <td rowspan="4">1</td>
                    <td>A</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>B</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>C</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>D</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <!-- 2차 -->
                  <tr>
                    <td rowspan="4">2</td>
                    <td>A</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>B</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>C</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>D</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <!-- 3차 -->
                  <tr>
                    <td rowspan="4">3</td>
                    <td>A</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>B</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>C</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>D</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <!-- 4차 -->
                  <tr>
                    <td rowspan="4">4</td>
                    <td>A</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>B</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>C</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>D</td>
                    <td> : </td>
                    <td> 단</td>
                    <td> ℃</td>
                    <td> 분</td>
                    <td>℃</td>
                    <td>
                      <span class="chk_radio">
                        <label for="check_Y1">적합</label>
                        <input type="radio" id="check_Y1" name="check_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check_N1">부적합</label>
                        <input type="radio" id="check_N1" name="check_YN1">
                      </span>
                    </td>
                    <td></td>
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
                    <td class="info text_bold" style="width: 100px;">개선조치방법</td>
                    <td>
                      <pre class="pre_font">
◌ 세팅온도, 가열시간, 가열 후 품온 미달 시, 가열량 초과 시
- 모니터링 담당자는 한계기준 이탈 시 즉시 작업을 중지한다.
- 가열시간, 가열온도를 재조정한 후 이탈된 제품에 대하여 재 가열을 실시하고 
    제품(관능)검사를 실시하여 이상이 없을 시 다음 공정을 진행한다.
- 한계기준 이탈내용과 개선조치 내용을 모니터링 일지에 기록
◌ 가열시간 초과 시
- 모니터링 담당자는 한계기준 이탈시 즉시 작업을 중지한다.
- 제품(관능)검사를 실시하여 이상이 없을 시 다음 공정을 진행 한다.
- 한계기준 이탈내용과 개선조치 내용을 모니터링 일지에 기록
◌ 기계고장 시
- 모니터링 담당자는 가열기 등 기계고장 시 즉시 작업을 중지한다.
- 수리 후 정상적으로 작동 시 재가동한다.
☆ 즉각적인 수리가 불가능할 경우 교차오염이 되지 않도록 보호조치하여 냉동창고에 보관한 후, 수리가 끝나면 제품 생산을 계속 한다.
◌ 공통 : 개선조치 시
- 문제 발생 시 HACCP팀장에게 보고 후 조치하며, 개선조치 후 모니터링 일지에 기록 후 HACCP팀장에게 승인을 받는다.
                      </pre>
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
                  <tr class="info text_bold">
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
