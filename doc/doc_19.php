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
      <section class="horizontal">
        <div class="record_table">
          <table class="ccp_table">
            <!-- 제목 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <tr>
                    <th class="info" rowspan="2" style="font-size:24px;">
                      압축공기필터 관리대장 2020년
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
            <!-- 관리 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                    <colgroup width="10%"></colgroup>
                    <colgroup width="10%"></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width="20%"></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <tr class="info">
                        <td colspan="5">필터 정보</td>
                        <td colspan="2">점검</td>
                    </tr>
                    <tr class="info">
                        <td>설비위치</td>
                        <td>용도</td>
                        <td>제품명</td>
                        <td>필터규격</td>
                        <td>교체주기</td>
                        <td>교체일</td>
                        <td>판정</td>
                    </tr>
                    <!-- 리스트 시작 -->
                    <!-- 설비위치1 -->
                    <tr>
                        <td rowspan="2">쌀가루 가공실</td>
                        <td rowspan="2">기기청소</td>
                        <td rowspan="2">
                        TPC
                        수분필터
                        PF4-04B
                        </td>
                        <td>1차필터 : 5㎛
                        - 수분,먼지</td>
                        <td rowspan="2">24개월
                            (1,000시간 사용후교체)
                            2시간/일 사용기준
                        </td>
                        <td>2020-02-18</td>
                        <td>적합</td>
                    </tr>
                    <tr>
                        <td>2차필터 : 0.01㎛
                        - 수분,먼지,유분</td>
                        <td>2020-02-18</td>
                        <td>적합</td>
                    </tr>
                    <!-- 설비위치2 -->
                    <tr>
                        <td rowspan="2">쌀가루 가공실</td>
                        <td rowspan="2">기기청소</td>
                        <td rowspan="2">
                        TPC
                        수분필터
                        PF4-04B
                        </td>
                        <td>1차필터 : 5㎛
                        - 수분,먼지</td>
                        <td rowspan="2">24개월
                            (1,000시간 사용후교체)
                            2시간/일 사용기준
                        </td>
                        <td>2020-02-18</td>
                        <td>적합</td>
                    </tr>
                    <tr>
                        <td>2차필터 : 0.01㎛
                        - 수분,먼지,유분</td>
                        <td>2020-02-18</td>
                        <td>적합</td>
                    </tr>
                    <!-- 설비위치3 -->
                    <tr>
                        <td rowspan="2">쌀가루 가공실</td>
                        <td rowspan="2">기기청소</td>
                        <td rowspan="2">
                        TPC
                        수분필터
                        PF4-04B
                        </td>
                        <td>1차필터 : 5㎛
                        - 수분,먼지</td>
                        <td rowspan="2">24개월
                            (1,000시간 사용후교체)
                            2시간/일 사용기준
                        </td>
                        <td>2020-02-18</td>
                        <td>적합</td>
                    </tr>
                    <tr>
                        <td>2차필터 : 0.01㎛
                        - 수분,먼지,유분</td>
                        <td>2020-02-18</td>
                        <td>적합</td>
                    </tr>
                    <!-- 설비위치4 -->
                    <tr>
                        <td rowspan="2"></td>
                        <td rowspan="2"></td>
                        <td rowspan="2">
                        
                        </td>
                        <td></td>
                        <td rowspan="2">
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- 특이사항 -->
                    <tr>
                        <td class="text-left" colspan="7">
                            <h4>- 특이사항 -</h4>
                            <div>123</div>
                        </td>
                    </tr>
                </table>
              </td>
            </tr>
            <!-- 관리 끝 -->
          </table>
        </div>
      </section>
    </div>
  </body>
</html>
