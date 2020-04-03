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
                      작업장 온도/습도 점검표
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
            <tr>
              <td>
                <table class="inner_table tbl-fixed record_row">
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <tr class="info">
                        <td>측정장소</td>
                        <td>기준온도(℃)</td>
                        <td>기준습도(%)</td>
                        <td>측정온도(℃)</td>
                        <td>측정습도(%)</td>
                    </tr>
<?
                    $count = 7;
                    for($i = 1; $i <= $count; $i++) {
?>
                    <tr>
                      <td>장소 <?=$i?></td>
                      <td>30℃ 이하</td>
                      <td>80% 이하</td>
                      <td>30℃</td>
                      <td>80%</td>
                    </tr>
<?
                    }                   
?>
                </table>
              </td>
            </tr>
            <!-- 기록 끝 -->
            <!-- 조치 및 확인 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <colgroup width=""></colgroup>
                  <colgroup width=""></colgroup>
                  <colgroup width=""></colgroup>
                  <tr>
                    <td class="info">이탈사항</td>
                    <td class="info">개선조치내용</td>
                    <td class="info">조치자</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
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
