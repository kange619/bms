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
                      검사설비 관리대장
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
                        <td rowspan="2">관리번호</td>
                        <td rowspan="2">계측기명</td>
                        <td rowspan="2">규격</td>
                        <td rowspan="2">교정주기</td>
                        <td colspan="2">교정의뢰</td>
                        <td rowspan="2">고유번호</td>
                        <td rowspan="2">구입년월</td>
                        <td rowspan="2">최근교정일자</td>
                        <td rowspan="2">차기교정일자</td>
                    </tr>
                    <tr>
                        <td>외부</td>
                        <td>내부</td>
                    </tr>
                    <!-- 리스트 시작 -->
<?
                    $count = 10;
                    for($i = 1; $i <= $count; $i++) {
?>
                    <tr>
                        <td>관리번호<?=$i?></td>
                        <td>계측기<?=$i?></td>
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
