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
    <style>
      .inner_table tr td {height:50px;}
    </style>
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
                      새알심 품질검사일지
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
                    <td class="info" style="width: 100px;">검사일자</td>
                    <td></td>
                    <td class="info" style="width: 100px;">검사자</td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 작성일자, 점검자 끝 -->
            <!-- 검사기준 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <td class="info" style="width: 100px;">검사기준</td>
                    <td>
                        <pre class="pre_font">※ 당일 생산된 제품은 당일 검사(당일 생산된 제품 중 랜덤으로 100g)를 원칙으로 한다.
당일 검사가 불가할 시 다음날 진행하고 생산일자를 빨간색 등으로 구분 기록한다.
※ 검사항목 중 질감은 끓는 물에서 2분 10초, 2분 30초 두 차례로 나뉘어서 검사한 후 결과를 기록한다.
※ 이탈사항 기록 : 검사 결과가 나쁨, 불량 시 기록한 후 보고한다.</pre>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 검사기준 끝 -->
            <!-- 검사 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                    <tr class="info">
                        <td>검사항목</td>
                        <td colspan="2">검사결과</td>
                    </tr>
                    <tr>
                        <td class="info">색깔</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="info">풍미</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="info">질감</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="info">외관</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="info">결과</td>
                        <td colspan="2"></td>
                    </tr>
                </table>
              </td>
            </tr>
            <!-- 검사 끝 -->
            <!-- 조치 및 확인 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                    <tr class="info">
                        <td colspan="4">이탈사항 기록</td>
                    </tr>
                  <tr>
                    <td>이탈일자</td>
                    <td>이탈내용</td>
                    <td>조치 및 결과 보고</td>
                    <td>조치자 및 확인</td>
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
