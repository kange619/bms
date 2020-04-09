<!-- Start content-page -->
<div class="content-page" style="margin-left:0px" >
    <!-- Start content -->
    <div class="content">
        <div class="container" id="document_form_area" style="text-align:center">
         
        </div> <!-- // container -->
    </div> <!-- // content -->
</div> <!-- // content-page -->

<input type="hidden" id="doc_table_style_data" value="<?=$doc_result['doc_table_style_data']?>" />
<input type="hidden" id="doc_data" value="<?=$doc_result['doc_data']?>" />

<script>
    $(document).ready(function(){

        doc.init({
            work : 'r'
            , element : 'document_form_area'                            
            , table_data : $('#doc_table_style_data').val()
            , data : $('#doc_data').val()
        });

        $.each($('#document_form_area').find('td'), function(){     

            if( ( $(this).text() == '__reporter_qr__' )  ) {
                $(this).html( '<img src="<?=$doc_result['reporter_qrcode_path']?>" >' ) ;
            } 

            if( ( $(this).text() == '__approval_qr__' ) ) {
                $(this).html( '<img src="<?=$doc_result['approver_qrcode_path']?>" >' );
            }

        });
        
    });
    

</script>
            
