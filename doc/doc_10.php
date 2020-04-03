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
      .ccp_table tr td {height:50px;}
    </style>
  </head>
  <body>
    <div id="wrap">
      <section>
        <div class="record_table">
            <table class="ccp_table">
                <!-- 제목 시작 -->
                <tr>
                    <th class="info" rowspan="2" style="font-size:24px;">
                        생산일보 (본멥 쌀가루)
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
            <!-- 제목 끝 -->
            <!-- 작성일자, 점검자 시작 -->
            <table class="ccp_table">
                <colgroup width="20%"></colgroup>
                <colgroup width="30%"></colgroup>
                <colgroup width="20%"></colgroup>
                <colgroup width="30%"></colgroup>
                <tbody>
                    <tr>
                        <td class="info">생산일</td>
                        <td></td>
                        <td class="info">작성자</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- 작성일자, 점검자 끝 -->
            <!-- 생산 시작 -->
            <table class="ccp_table tbl-fixed">
                <tbody>
                    <tr>
                        <td class="info" colspan="3">원재료 작업내용(멥쌀)</td>
                    </tr>
                    <tr class="info">
                        <td>입고일</td>
                        <td>중량</td>
                        <td>사용량</td>
                    </tr>
                    <tr>
                        <td rowspan="3">2020-02-17</td>
                        <td>1톤</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>40kg</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>kg</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="info" colspan="2">합계(kg)</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- 생산 끝 -->
            <!-- 포장 시작 -->
            <table class="ccp_table tbl-fixed">
                <tbody>
                    <tr>
                        <td class="info" colspan="8">포장작업내용</td>
                    </tr>
                    <tr class="info">
                        <td rowspan="2">생산일</td>
                        <td rowspan="2">품목</td>
                        <td rowspan="2">작업내용</td>
                        <td colspan="5">포장현황</td>
                    </tr>
                    <tr>
                        <td>규격(kg)</td>
                        <td>유통기한(날인)</td>
                        <td colspan="2">봉(파우치)</td>
                        <td>박스(10kg)</td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td rowspan="3">본멥쌀가루</td>
                        <td rowspan="3">파우치포장</td>
                        <td rowspan="3"></td>
                        <td></td>
                        <td></td>
                        <td rowspan="3"></td>
                        <td rowspan="3"></td>
                    </tr>
                    <tr>
                        <td rowspan="2"></td>
                        <td>(오전)</td>
                    </tr>
                    <tr>
                        <td>(오후)</td>
                    </tr>
                    <tr>
                        <td class="text-left" colspan="8">
                            <h4>- 메모 -</h4>
                            <div>
                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- 포장 끝 -->
        </div>
      </section>
    </div>
  </body>
</html>
