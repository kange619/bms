<div class="content-page">
    <!-- start content -->
	<div class="content">
		<!-- container -->
        <div class="container">
            <section class="content-header">
              <h1>
                모니터링
              </h1>
            </section>
			<!--/ 모니터링 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
							<b>목록</b>
						</h5>
                        <hr class="m-t-0">
                        <ul class="monitor_list">
                            <?php
                                foreach($list AS $idx=>$val) {
                                    if( $val['temp_state'] == 'W' ) {
                                        $class_name = 'danger_box';
                                    } else {
                                        $class_name = 'normal_box';
                                    }
                            ?>
                            <li class="<?=$class_name?>" onclick="location.href='monitor_view?storage_idx=<?=$val['storage_idx']?><?=$params?>'">
                                <div class="temp_wrap">
                                    <span class="temp_tit"><?=$val['storage_name']?></span>
                                    <strong class="temp_txt"><?=$val['temperature']?>℃</strong>
                                </div>
                                <p class="temp_time">최종측정시각 : <?=$val['reg_date']?></p>
                            </li>
                            <?php

                                }
                            ?>
                            
                        </ul>
					</div>
				</div>
			</div>
			<!-- // 모니터링 -->

		</div><!-- container -->
	</div><!-- content -->
</div><!-- content-page -->