<div class="content-page">
    <!-- start content -->
	<div class="content">
		<!-- container -->
        <div class="container">
            <section class="content-header">
              <h1>
                모니터링 이탈 상세보기
                <button type="button" class="pull-right btn btn-inverse waves-effect w-md m-l-5" onclick="location.href='./<?=$page_name?>_list?page=<?=$page?><?=$params?>'">목록</button> 
              </h1>
            </section>
			<!--/ 모니터링 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
							<b>상세정보</b>
						</h5>
                        <hr class="m-t-0">
                        <div class="warning_wrap">
                            <div class="warning_box danger_box">
                                <span class="warning_title"><?=$storage_name;?></span>
                                <strong class="warning_temp"><?=$warning_temperature;?>℃</strong>
                            </div>
                            <div class="warning_cont">
                                <h4 style="font-weight:bold;">이탈정보</h4>
                                <hr class="m-t-0">
                                <ul class="warning_txt">
                                    <li>
                                        측정시각
                                        <span class="fright"><?=$reg_date;?></span>
                                    </li>
                                    <li>
                                        한계범위
                                        <span class="fright"><?=$limit_range;?>℃</span>
                                    </li>
                                    <li>
                                        이탈원인
                                        <div class="warning_textarea">
                                            <?=nl2br($warning_cause);?>
                                        </div>
                                    </li>
                                    <li>
                                        이탈조치사항
                                        <div class="warning_textarea">
                                            <?=nl2br($warning_action);?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
					</div>
				</div>
			</div>
			<!-- // 모니터링 -->

		</div><!-- container -->
	</div><!-- content -->
</div><!-- content-page -->