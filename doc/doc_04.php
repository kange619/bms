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
                      중요관리점(CCP-2P) 모니터링일지
                      <span class="sub_title">[금속검출공정 (쌀가루)]</span>
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
                    <td class="info" style="width: 100px;">작성일자</td>
                    <td></td>
                    <td class="info" style="width: 100px;">점검자</td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 작성일자, 점검자 끝 -->
            <!-- 한계기준, 주기 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td class="info" style="width: 100px;">한계기준</td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="inner_table" style="table-layout: fixed;">
                  <tr>
                    <td class="info" rowspan="2" style="width: 100px;">주기</td>
                    <td>금속검출기 정상작동 여부 확인</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>금속검출기에 의한 공정품 확인</td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td class="info" style="width: 100px;">방법</td>
                    <td>
                      <pre class="pre_font">
○ 기기감도
모니터링담당자는 기기 중간에 Test piece(Fe 2.0. STS 2.5mmΦ)를 통과시켜 검출여부를 확인하고 
CCP-2P(떡류) 모니터링 일지에 기록한다.
○ 제품감도
모니터링담당자는 제품 중간에 Test piece(Fe 2.0. STS 2.5mmΦ)를 넣고 기기에 통과시켜 검출여부를 확인하고 CCP-2P(떡류) 모니터링점검표에 기록한다.
○ 통과량 및 검출량
모니터링담당자는 통과된 양과 검출된 양을 CCP-2P(떡류) 모니터링점검표에 기록하고 HACCP팀장에 보고한다.
※ 금속검출기는 연1회 이상 정상작동 유무 확인
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
                        <td class="info" colspan="9">금속검출기 감도 모니터링(판정 - 검출 : ○, 불검출 : X) / 판정 적합시 ○</td>
                    </tr>
                  <tr>
                    <td style="width: 50px;">차수</td>
                    <td>통과시간</td>
                    <td>Fe만 통과<br>(중간)</td>
                    <td>STS만 통과<br>(중간)</td>
                    <td>제품만<br>통과</td>
                    <td>Fe+제품 통과<br>(제품 중앙 아래)</td>
                    <td>STS+제품 통과<br>(제품 중앙 아래)</td>
                    <td>판정</td>
                    <td>비고</td>
                  </tr>
                  <!-- 1차 : A -->
                  <tr>
                    <td>1</td>
                    <td> : </td>
                    <td>
                      <span class="chk_radio">
                        <label for="check1_Y1">O</label>
                        <input type="radio" id="check1_Y1" name="check1_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check1_N1">X</label>
                        <input type="radio" id="check1_N1" name="check1_YN1">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="check1_Y1">O</label>
                        <input type="radio" id="check1_Y1" name="check1_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check1_N1">X</label>
                        <input type="radio" id="check1_N1" name="check1_YN1">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="check1_Y1">O</label>
                        <input type="radio" id="check1_Y1" name="check1_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check1_N1">X</label>
                        <input type="radio" id="check1_N1" name="check1_YN1">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="check1_Y1">O</label>
                        <input type="radio" id="check1_Y1" name="check1_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check1_N1">X</label>
                        <input type="radio" id="check1_N1" name="check1_YN1">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="check1_Y1">O</label>
                        <input type="radio" id="check1_Y1" name="check1_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check1_N1">X</label>
                        <input type="radio" id="check1_N1" name="check1_YN1">
                      </span>
                    </td>
                    <td>
                      <span class="chk_radio">
                        <label for="check1_Y1">O</label>
                        <input type="radio" id="check1_Y1" name="check1_YN1">
                      </span>
                      <span class="chk_radio">
                        <label for="check1_N1">X</label>
                        <input type="radio" id="check1_N1" name="check1_YN1">
                      </span>
                    </td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 기록 끝 -->
            <!-- 제품통과 기록 시작 -->
            <tr>
              <td class="info">금속검출기 제품 통과</td class="info">
            </tr>
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td>차수</td>
                    <td>최초통과시간</td>
                    <td>통과종료시간</td>
                    <td>이탈유무</td>
                    <td>통과량</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td> : </td>
                    <td> : </td>
                    <td>무</td>
                    <td>220</td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 제품통과 기록 끝 -->
            <!-- 개선조치방법 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td class="info" style="width: 100px;">개선조치방법</td>
                    <td>
                      <pre class="pre_font">
◌ 금속성 이물 검출 시
- 모니터링 담당자는 즉시 금속검출기의 작업을 중지하고 공정품을 보류하고 해당(이탈) 제품을 제거한다.
- 공정품에 혼입된 금속이물을 찾아내고, 그 출처를 조사하여 원인을 제거한다.
- 금속이물 검출 내역 및 개선조치 사항을 모니터링 일지에 기록
◌ 감도 이상 발생 시
- 모니터링 담당자는 즉시 금속검출기의 작업을 중지하고 공정품을 보류한다.
- 감도를 재조정한 후 정상적으로 작동 시 재가동한다. 
- 감도이상 발생 전부터 정상운전 확인시점까지 생산된 제품을 다시 검사한다.
- 재검사 후 그 내역 또는 개선조치 사항을 모니터링 일지에 기록
◌ 기계적 고장 시
- 모니터링 담당자는 즉시 금속검출기의 작업을 중지하고 공정품을 보류한다.
- 수리 후 정상적으로 작동 시 재가동한다.
- 수리 불가능할 때에는 납품업체에 수리를 의뢰한다.
☆ 금속검출기의 고장으로 정상 운전 확인 이후에 생산된 제품과 금속검출기 미 통과제품에 대해서는 
    전량 검사대기품 표시(냉동보관)를 하여 금속검출기 수리 완료 후 전량 재통과한다.
◌ 공통 : 개선조치 시
- 문제 발생 시 HACCP팀장에게 보고 후 조치하며, 개선조치 후 모니터링 일지에 기록 후 HACCP팀장에게 
  승인을 받는다.
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
