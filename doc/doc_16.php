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
                      제품출고현황
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
            <!-- 검사 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed">
                    <tr class="info">
                        <td rowspan="2">출고일자</td>
                        <td rowspan="2">품명</td>
                        <td rowspan="2">업체명</td>
                        <td colspan="2">출고량</td>
                        <td colspan="2">제조일자</td>
                        <td rowspan="2">출고시 특이사항<br>(포장 이상여부 등)</td>
                    </tr>
                    <tr>
                        <td>포장규격</td>
                        <td>박스</td>
                        <td>유통기한</td>
                        <td>박스</td>
                    </tr>
                    <!-- 리스트 시작 -->
<?
                    $count = 10;
                    for($i = 1; $i <= $count; $i++) {
?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
<?
                    }
?>
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
