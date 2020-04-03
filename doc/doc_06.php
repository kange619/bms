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
                      작업장 조도 점검표
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
            <!-- 검사방법, 검사주기 시작 -->
            <tr>
                <td>
                    <table class="inner_table">
                        <tr>
                            <td class="info" style="width: 100px;">검사방법</td>
                            <td></td>
                            <td class="info" style="width: 100px;">검사주기</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- 검사방법, 검사주기 끝 -->
            <!-- 기록 시작 -->
            <tr>
              <td>
                <table class="inner_table tbl-fixed record_row">
                    <colgroup width="50px;"></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <colgroup width=""></colgroup>
                    <tr class="info">
                        <td colspan="2">장소</td>
                        <td>기준조도(Lux)</td>
                        <td>측정값(Lux)</td>
                        <td>판정(O/X)</td>
                        <td>조치결과</td>
                    </tr>
<?
                    $count = 13;
                    for($i = 1; $i < $count; $i++) {
?>
                    <tr>
                      <td><?=$i?></td>
                      <td>장소 <?=$i?></td>
                      <td>100</td>
                      <td>100</td>
                      <td>적합</td>
                      <td>100,100,100</td>
                    </tr>
<?
                    }                   
?>
                </table>
              </td>
            </tr>
            <!-- 기록 끝 -->
            <!-- 조도권고기준 시작 -->
            <tr>
              <td class="text-left">
                ※ 조도 권고 기준<br>
                - 검사검수장소(검수구역) : 540 Lux 이상<br>
                - 일반 작업구역 : 220 Lux 이상<br>
                - 기타 부대시설 : 110 Lux 이상
              </td>
            </tr>
            <!-- 조도권고기준 끝 -->
            <!-- 조치 및 확인 시작 -->
            <tr>
              <td>
                <table class="inner_table">
                  <colgroup width="100px;"></colgroup>
                  <colgroup width=""></colgroup>
                  <tr>
                    <td class="info">부적합사항</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="info">개선조치내역</td>
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
