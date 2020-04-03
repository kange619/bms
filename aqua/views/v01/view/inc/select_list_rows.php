<div style="height: 35px;">
    <div class="pageNum">
        <div class="pull-right">        
            <select class="form-control pull-right" id="change_list_rows" style="width:120px;" >
                <option value="10" <?=( $list_rows == '10' ) ? 'selected="selected"' : '' ?> >10개 보기</option>
                <option value="20" <?=( $list_rows == '20' ) ? 'selected="selected"' : '' ?>>20개 보기</option>
                <option value="50" <?=( $list_rows == '50' ) ? 'selected="selected"' : '' ?>>50개 보기</option>
                <option value="100" <?=( $list_rows == '100' ) ? 'selected="selected"' : '' ?>>100개 보기</option>
            </select>
        </div>
    </div> 
</div>