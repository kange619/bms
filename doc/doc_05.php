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
                      중요관리점(CCP) 검증점검표
                      <span class="sub_title">(매월 1회 작성)</span>
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
                    <td class="info" style="width: 100px;">점검일자</td>
                    <td></td>
                    <td class="info" style="width: 100px;">점검자</td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 작성일자, 점검자 끝 -->
            <!-- 기록 시작 -->
            <!--
                회사마다 점검하고자 하는 공정이 달라질 수 있으며 그 내용 또한 다를 수 있다.
                ex : 세척공정, 가열공정, 금속검출공정, 여과공정, 세척공정
            -->
            <tr>
              <td>
                <table class="inner_table">
                    <tr class="info">
                        <td rowspan="2" style="width: 100px;">공정</td>
                        <td rowspan="2">검증 내용</td>
                        <td colspan="2" style="width: 200px;">기록</td>
                    </tr>
                    <tr class="info">
                        <td style="width: 100px;">예</td style="width: 100px;">
                        <td style="width: 100px;">아니오</td style="width: 100px;">
                    </tr>
                <!-- 세척공정 검증1 -->
                  <tr>
                    <td class="info" rowspan="8">세척공정</td>
                    <td class="text-left">담당자가 주기적으로 세적량, 세척시간, 세척수량을 확인하고 그 내용을 기록하고 있습니까?</td>
                    <td><input type="radio" name="wash_chk1" /></td>
                    <td><input type="radio" name="wash_chk1" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">모니터링 일지 확인:</td>
                  </tr>
                  <!-- 검증2 -->
                  <tr>
                    <td class="text-left">타이머/수량계는 연 1회 이상 검·교정이 이루어지고 있습니까?</td>
                    <td><input type="radio" name="wash_chk2" /></td>
                    <td><input type="radio" name="wash_chk2" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          검 교정일 : <br>
                          타이머 : <br>
                          수량계 : 
                      </td>
                  </tr>
                  <!-- 검증3 -->
                  <tr>
                    <td class="text-left">담당자가 세척량, 세척시간, 세척수량을 확인하는 방법을 정확히 알고 있습니까?</td>
                    <td><input type="radio" name="wash_chk3" /></td>
                    <td><input type="radio" name="wash_chk3" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          모니터링 행동 관찰 : 
                      </td>
                  </tr>
                  <!-- 검증4 -->
                  <tr>
                    <td class="text-left">담당자가가 한계기준 이탈 시 실시해야 하는 개선조치 방법을 알고 있으며, 이탈 및 개선조치 내용이 기록되고 있습니까?</td>
                    <td><input type="radio" name="wash_chk4" /></td>
                    <td><input type="radio" name="wash_chk4" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          모니터링 담당자 인터뷰 : 
                      </td>
                  </tr>
                  <!-- 가열공정 검증1 -->
                  <tr>
                    <td class="info" rowspan="8">가열공정</td>
                    <td class="text-left">종사자가 주기적으로 가열시간, 가열 후 품온을 확인하고 그 내용을 기록하고 있습니까?</td>
                    <td><input type="radio" name="heating_chk1" /></td>
                    <td><input type="radio" name="heating_chk1" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">모니터링 일지 확인:</td>
                  </tr>
                  <!-- 검증2 -->
                  <tr>
                    <td class="text-left">타이머/탐침온도계는 연 1회 이상 검·교정이 이루어지고 있습니까?</td>
                    <td><input type="radio" name="heating_chk2" /></td>
                    <td><input type="radio" name="heating_chk2" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          검 교정일 : <br>
                          타이머 : <br>
                          수량계 : 
                      </td>
                  </tr>
                  <!-- 검증3 -->
                  <tr>
                    <td class="text-left">종사자가 가열시간, 가열 후 품온을 확인하는 방법을 정확히 알고 있습니까? </td>
                    <td><input type="radio" name="heating_chk3" /></td>
                    <td><input type="radio" name="heating_chk3" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          모니터링 행동 관찰 : 
                      </td>
                  </tr>
                  <!-- 검증4 -->
                  <tr>
                    <td class="text-left">종사자가 한계기준 이탈 시 실시해야 하는 개선조치 방법을 알고 있으며, 이탈 및 개선조치 내용이 기록되고 있습니까?</td>
                    <td><input type="radio" name="heating_chk4" /></td>
                    <td><input type="radio" name="heating_chk4" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          모니터링 담당자 인터뷰 : 
                      </td>
                  </tr>
                  <!-- 금속검출 공정 검증1 -->
                  <tr>
                    <td class="info" rowspan="8">금속검출공정</td>
                    <td class="text-left">종사자가 주기적으로 테스트피스를 통해 금속검출기의 감도 이상 유무를 확인하고 있습니까?</td>
                    <td><input type="radio" name="metal_chk1" /></td>
                    <td><input type="radio" name="metal_chk1" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">모니터링 일지 확인:</td>
                  </tr>
                  <!-- 검증2 -->
                  <tr>
                    <td class="text-left">금속검출기는 연 1회 검·교정(또는 정기점검)이 이루어지고 있습니까?</td>
                    <td><input type="radio" name="metal_chk2" /></td>
                    <td><input type="radio" name="metal_chk2" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          검 교정일 : <br>
                          타이머 : <br>
                          수량계 : 
                      </td>
                  </tr>
                  <!-- 검증3 -->
                  <tr>
                    <td class="text-left">종사자가 금속검출기 감도를 확인하는 방법을 정확히 알고 있습니까?</td>
                    <td><input type="radio" name="metal_chk3" /></td>
                    <td><input type="radio" name="metal_chk3" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          모니터링 행동 관찰 : 
                      </td>
                  </tr>
                  <!-- 검증4 -->
                  <tr>
                    <td class="text-left">종사자가 한계기준 이탈 시 실시해야 하는 개선조치 방법을 알고 있으며, 이탈 및 개선조치 내용이 기록되고 있습니까?</td>
                    <td><input type="radio" name="metal_chk4" /></td>
                    <td><input type="radio" name="metal_chk4" /></td>
                  </tr>
                  <tr>
                      <td colspan="3" class="text-left">
                          모니터링 담당자 인터뷰 : 
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 기록 끝 -->
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
