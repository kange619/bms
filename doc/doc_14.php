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
      .inner_table tr td {height:40px;}
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
                      완제품 출고검사
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
                    <td class="info" style="width: 100px;">작성자</td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- 작성일자, 점검자 끝 -->
            <!-- 검사 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                    <colgroup width="10%"></colgroup>
                    <colgroup width="10%"></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width="10%"></colgroup>
                    <colgroup width="10%"></colgroup>
                    <colgroup width="10%"></colgroup>
                    <colgroup width="10%"></colgroup>
                    <tr>
                        <td class="info" colspan="2" rowspan="3">검사항목</td>
                        <td class="info" rowspan="3">검사내용</td>
                        <td class="info" rowspan="3">채점결과</td>
                        <td class="info" rowspan="3">적합여부</td>
                        <td colspan="2">용인</td>
                    </tr>
                    <tr>
                        <td colspan="2">2020-02-18</td>
                    </tr>
                    <tr>
                        <td><input class="checked" type="checkbox" checked disabled />쌀가루</td>
                        <td><input class="checked" type="checkbox" checked disabled />새알심</td>
                    </tr>
                    <tr>
                        <td rowspan="4">성상</td>
                        <td>색깔</td>
                        <td>
                            <pre class="pre_font">
1. 색깔이 양호한 것은 5점
2. 대체로 양호한 것은 그정도에 따라 3점, 4점
3. 나쁜 것은 2점
4. 현저히 나쁜 것은 1점</pre>
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>풍미</td>
                        <td>
                            <pre class="pre_font">
1. 풍미가 양호한 것은 5점
2. 대체로 양호한 것은 그정도에 따라 3점, 4점
3. 나쁜 것은 2점
4. 현저히 나쁜 것은 1점</pre>
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>조직감</td>
                        <td>
                            <pre class="pre_font">
1. 조직감이 양호한 것은 5점
2. 대체로 양호한 것은 그정도에 따라 3점, 4점
3. 나쁜 것은 2점
4. 현저희 나쁜 것은 1점</pre>
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>외관</td>
                        <td>
                            <pre class="pre_font">
1. 제품의 균질 및 성형상태와 포장상태 등 외형이 양호한 것은 5점
2. 제품의 제조가공 상태 및 외형이 비교적 양호한 그 정도에 따라 3점, 4점
3. 제조. 가공 상태 및 외형이 나쁜 것은 2점
4. 제조 가공 상태 및 외형이 현저히 나쁜 것은 1점</pre>
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2">이물</td>
                        <td>
                            <pre class="pre_font">
이물질이 검출되지 않을 것 (금속검출공정/외관)</pre>
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2">차량상태</td>
                        <td>
                            <pre class="pre_font">
차량 청결상태 및 냉동 온도 유지 여부 - 적합유무</pre>
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                </table>
              </td>
            </tr>
            <!-- 검사 끝 -->
          </table>
        </div>
      </section>
    </div>
    <style>
        .checked {position:relative; margin-right:5px; vertical-align:-1px;}
        .checked:checked:before {content:""; position:absolute; width:15px; height:15px; background:#fff url(../public/images/icon_checked.png); background-size:cover;}
    </style>
  </body>
</html>
