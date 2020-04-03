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
      .inner_table tr td {height:25px;}
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
                      부적합 발생일지
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
                    <tr class="info">
                        <td colspan="5"><h3>2020년 2월</h3></td>
                    </tr>
                    <tr class="info">
                        <td>일자</td>
                        <td>멥쌀가루(kg)</td>
                        <td>떡용쌀가루(kg)</td>
                        <td>새알심(kg)</td>
                        <td>비고</td>
                    </tr>
                    <!-- 리스트 시작 -->
<?
                    $count = 31;
                    for($i = 1; $i <= $count; $i++) {
?>
                    <tr>
                        <td><?=$i?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
<?
                    }
?>
                    <tr>
                        <td class="info">소계</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="info">월 발생량(합계)</td>
                        <td colspan="4">kg</td>
                    </tr>
                </table>
              </td>
            </tr>
            <!-- 검사 끝 -->
          </table>
        </div>
      </section>
    </div>
  </body>
</html>
