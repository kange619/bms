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
                      협력업체 점검표
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
                    <td class="info" style="width: 100px;">협력업체명</td>
                    <td></td>
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
                        <td>구분</td>
                        <td>항목</td>
                        <td>기준</td>
                        <td>배점</td>
                        <td>결과</td>
                    </tr>
                    <!-- 기본요건 검사 -->
                    <tr>
                      <td rowspan="3">기본 요건(10)</td>
                      <td>영업신고(허가)</td>
                      <td>신고 유무</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>공장등록증</td>
                      <td>유무</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>품목제조보고서</td>
                      <td>품목제조보고 이행</td>
                      <td>4</td>
                      <td></td>
                    </tr>
                    <!-- 생산능력 검사 -->
                    <tr>
                      <td rowspan="2">생산능력(10)</td>
                      <td>원료 수불서류</td>
                      <td>관계 서류작성 및 3년간 보관</td>
                      <td>5</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>표시사항</td>
                      <td>표시사항 준수</td>
                      <td>5</td>
                      <td></td>
                    </tr>
                    <!-- 위생 검사 -->
                    <tr>
                      <td rowspan="5">위생(15)</td>
                      <td>건강진단</td>
                      <td>건강진단 실시(년1회) 및 관련 서류보관</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>위생교육</td>
                      <td>영업자 위생교육 이수</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>수질검사</td>
                      <td>수돗물 또는 지하수 사용 및 관련 서류</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>공장 위생상태</td>
                      <td>작업장 특성별 청결관리</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>설비관리 상태</td>
                      <td>기계·기구류의 세척 및 소독관리</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <!-- 검사 -->
                    <tr>
                      <td rowspan="3">검사(10)</td>
                      <td>제품검사</td>
                      <td>자가품질검사실시 및 성적서 비치</td>
                      <td>5</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>검사능력</td>
                      <td>검사실 및 설비 구비</td>
                      <td>3</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>검사원</td>
                      <td>자체 검사인력</td>
                      <td>2</td>
                      <td></td>
                    </tr>
                    <!-- 운반 검사 -->
                    <tr>
                      <td>운반(5)</td>
                      <td>차량위생상태</td>
                      <td>차량 청결관리</td>
                      <td>5</td>
                      <td></td>
                    </tr>
                    <tr>
                        <td>비고</td>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td>종합평점</td>
                        <td colspan="4">
                            00점 (등급판정 : ?급)
                        </td>
                    </tr>
                </table>
              </td>
            </tr>
            <!-- 기록 끝 -->
          </table>
        </div>
      </section>
    </div>
  </body>
</html>
