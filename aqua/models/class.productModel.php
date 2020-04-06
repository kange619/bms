<?php

class productModel extends baseModel {

    private $table;
    private $table_product_unit;
    private $table_mixing_ratio;
    private $table_product_stock;
    private $table_production_order;

    function __construct() {

        $this->table = ' t_products_info ';        
        $this->table_product_unit = ' t_product_unit_info ';        
        $this->table_mixing_ratio = ' t_mixing_ratio ';                
        $this->table_product_stock = ' t_product_stock ';                
        $this->table_production_order = ' t_production_order ';                
        $this->db = $this->connDB('masic');

    }

    function __destruct() {

        # db close
        $this->db->dbClose();

    }

    /**
     * 정보보호테이블 기준 기업정보 목록을 반환한다.
     */
    public function getProducts( $arg_data ){

        $result = [];

        $query = " SELECT COUNT(*) AS cnt FROM ". $this->table ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = "  SELECT *
                            ,( SELECT COUNT(*) FROM t_mixing_ratio WHERE ( product_idx=t_products_info.product_idx ) AND ( del_flag='N' ) ) AS raw_mix_cnt
                    FROM ". $this->table ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;

    }
    
    /**
     * 유형 코드를 생성해 반환한다.
     */
    public function createProductCode( $arg_type ){

        $query = " SELECT IFNULL( MAX( product_registration_no ), '') AS max_code FROM ". $this->table ." WHERE product_registration_no LIKE '". $arg_type ."%' ";

        $query_result = $this->db->execute( $query );

        return $query_result['return_data']['row']['max_code'];

    }

    /**
     * 제품 정보를 가져온다.
     */
    public function getProduct( $arg_where ){

        $query = " SELECT * FROM ". $this->table ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 제품 단위정보를 가져온다.
     */
    public function getProductUnitInfo( $arg_where ){

        $query = "  SELECT 
                            * 
                            , ( SELECT product_expiration_date FROM ". $this->table ." WHERE product_idx=as_unit.product_idx ) AS product_expiration_date
                    FROM ". $this->table_product_unit ." AS as_unit WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 제품정보를 insert 한다.
     */
    public function insertProduct( $arg_data ){
        return $this->db->insert( $this->table, $arg_data );
    }

    /**
     * 제품정보를 수정한다.
     */
    public function updateProduct( $arg_data, $arg_where ) {
        return $this->db->update( $this->table, $arg_data, $arg_where );
    }


     /**
     * 제품 단위정보를 insert 한다.
     */
    public function insertProductUnit( $arg_data ){
        return $this->db->insert( $this->table_product_unit, $arg_data );
    }

    /**
     * 제품 단위 정보를 update 한다
     */
    public function updateProductUnit( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_product_unit, $arg_data, $arg_where );
    }


    /**
     * 제품 단위 정보를 insert 한다.
     */ 
    public function insertProductUnitInfo( $arg_product_idx, $arg_product_unit, $arg_product_unit_type, $arg_packaging_unit_quantity, $arg_company_idx ){

        $insert_query = ' INSERT INTO '. $this->table_product_unit . ' ( 
            company_idx
            , product_idx
            , product_unit
            , product_unit_type
            , packaging_unit_quantity
            , reg_idx
            , reg_ip
            , reg_date
         ) VALUES ';
        $insert_add_query = [];

        foreach( $arg_product_unit AS $idx=>$val ){            

            if( ( empty( $val ) == false && empty( $arg_packaging_unit_quantity[ $idx ] ) == false )  ) {
                $insert_add_query[] = " ( 
                    '". $arg_company_idx ."'
                    ,'". $arg_product_idx ."'
                    ,'". $arg_product_unit[ $idx ] ."'
                    , '". $arg_product_unit_type[ $idx ] ."'
                    , '". $arg_packaging_unit_quantity[ $idx ] ."'
                    , '". getAccountInfo()['idx'] ."'
                    , '". $this->getIP() ."'
                    , NOW() 
                ) ";
            }

        }
        
        $insert_query .= join( ', ', $insert_add_query );

        return $this->db->execute( $insert_query );
    }

    /**
     * 제품 단위 정보를 수정한다.
     */
    public function updateProductUnitInfo( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_product_unit, $arg_data, $arg_where );
    }

    /**
     * 배합비율 정보를 가져온다.
     */
    public function getMixingRatio( $arg_where ){

        $query = " SELECT * FROM ". $this->table_mixing_ratio ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }


    /**
     * 배합비율 정보를 insert 한다.
     */ 
    public function insertMixingRatio( 
        $arg_product_idx
        , $arg_material_idx
        , $arg_material_ratio
        , $arg_material_code
        , $arg_material_name        
        , $arg_material_company_name        
        , $arg_company_idx
     ){

        $insert_query = ' INSERT INTO '. $this->table_mixing_ratio . ' 
                        (   
                            product_idx
                            , company_idx
                            , material_idx
                            , material_ratio
                            , material_code
                            , material_name
                            , material_company_name
                            , reg_idx
                            , reg_ip
                            , reg_date 
                        ) VALUES ';

        $insert_add_query = [];

        foreach( $arg_material_ratio AS $idx=>$val ){            

            if( ( empty( $val ) == false && empty( $arg_material_name[ $idx ] ) == false )  ) {
                $insert_add_query[] = " ( 
                    '". $arg_product_idx ."'
                    ,'". $arg_company_idx ."'
                    ,'". $arg_material_idx[$idx] ."'
                    ,'". $val ."'
                    , '". $arg_material_code[ $idx ] ."'
                    , '". $arg_material_name[ $idx ] ."'
                    , '". $arg_material_company_name[ $idx ] ."'
                    , '". getAccountInfo()['idx'] ."'
                    , '". $this->getIP() ."'
                    , NOW() 
                ) ";
            }

        }
        
        $insert_query .= join( ', ', $insert_add_query );

        return $this->db->execute( $insert_query );
    }

    /**
     * 배합비율 정보를 수정한다.
     */
    public function updateMixingRatio( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_mixing_ratio, $arg_data, $arg_where );
    }


    /**
     * 제품별 재고현황을 조회 반환한다.
     */
    public function getProdcuctStockState(){

        $query = " 
            SELECT	as_product.product_idx
                    , as_product.product_name
                    , as_product.food_code
                    , tmp_available_stocks.product_unit_idx
                    , as_p_unit.product_unit
                    , as_p_unit.product_unit_type
                    , as_p_unit.packaging_unit_quantity
                    , as_p_unit.product_unit_name
                    , IFNULL( tmp_available_stocks.total_in_quantity, 0 ) AS total_in_quantity 
                    , IFNULL( tmp_available_stocks.use_quantity , 0 ) AS use_quantity 
                    , IFNULL( tmp_available_stocks.stock_quantity , 0 ) AS stock_quantity 
                    , (	
                        SELECT IFNULL( SUM(product_quantity), 0 ) 
                        FROM ". $this->table_product_stock ." 
                        WHERE ( product_idx=tmp_available_stocks.product_idx ) AND ( del_flag='N' ) AND ( task_type = 'U' )
                    ) AS total_use_quantity 
                    , (
                        SELECT IFNULL( SUM(product_quantity), 0 ) 
                        FROM ". $this->table_product_stock ." 
                        WHERE ( product_idx=tmp_available_stocks.product_idx ) AND ( del_flag='N' ) AND ( task_type = 'D' ) 
                    ) AS total_discard_quantity 
                    , ( 
                        SELECT IFNULL( SUM(product_quantity), 0 ) 
                        FROM ". $this->table_product_stock ." 
                        WHERE ( product_idx=tmp_available_stocks.product_idx ) AND ( del_flag='N' ) AND ( task_type = 'S' )
                    ) AS total_schedule_quantity 
            FROM ".$this->table." AS as_product LEFT OUTER JOIN ( 
            SELECT * 
            FROM ( 
                SELECT * , ( total_in_quantity - use_quantity ) AS stock_quantity 
                FROM ( 
                    SELECT * 
                            ,(	SELECT IFNULL( SUM( product_quantity ), 0 ) 
                                FROM ". $this->table_product_stock ." WHERE ( del_flag='N' ) AND ( task_type <> 'I' ) AND ( product_idx=use_insert_quantity.product_idx ) 
                            ) AS use_quantity 
                    FROM ( 
                        SELECT	SUM( product_quantity ) AS total_in_quantity
                                    , product_unit_idx 
                                    , product_idx 
                        FROM ". $this->table_product_stock ." 
                        WHERE ( del_flag='N' ) AND ( task_type='I' ) AND ( company_idx = '". COMPANY_CODE ."' ) 
                        GROUP BY product_unit_idx 
                    ) AS use_insert_quantity 
                ) AS t_cur 
            ) AS t_result 
            ) AS tmp_available_stocks ON as_product.product_idx = tmp_available_stocks.product_idx 
            LEFT OUTER JOIN ". $this->table_product_unit ." AS as_p_unit
            ON tmp_available_stocks.product_unit_idx = as_p_unit.product_unit_idx
            WHERE as_product.del_flag='N'
        ";

        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 재고 정보를 insert 한다.
     */
    public function insertStock( $arg_data ){
        return $this->db->insert( $this->table_product_stock, $arg_data );
    }

    /**
     * 재고 정보를 update 한다.
     */
    public function updateStock( $arg_data, $arg_where ){
        return $this->db->update( $this->table_product_stock, $arg_data, $arg_where );
    }

    /**
     * 제품 재고 목록을 반환 한다.
     */
    public function getProductStocks( $arg_data ){

        $result = [];

        $join_table = "
            (
                SELECT  
                    t_stock.*                   
                    ,t_order.schedule_date
                    ,t_order.expiration_date
                    ,t_order.expiration_days
                    ,t_order.food_code                    
                FROM
                        ". $this->table_product_stock ." AS t_stock LEFT OUTER JOIN ". $this->table_production_order ." AS t_order
                        ON t_stock.production_idx = t_order.production_idx 
            ) AS t_new
            
        ";

        $query = " SELECT COUNT(*) AS cnt FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = " SELECT IFNULL( SUM( product_quantity ), 0 ) AS total_quantity FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_quantity'] = $query_result['return_data']['row']['total_quantity'];


        $query = " SELECT * FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;

    }

    /**
     * 제품 재고 정보를 반환 한다.
     */
    public function getProductStock( $arg_where ){

        $result = [];

        $join_table = "
            (
                SELECT  
                    t_stock.*                   
                    ,t_order.schedule_date
                    ,t_order.expiration_date
                    ,t_order.expiration_days
                    ,t_order.food_code                    
                FROM
                        ". $this->table_product_stock ." AS t_stock LEFT OUTER JOIN ". $this->table_production_order ." AS t_order
                        ON t_stock.production_idx = t_order.production_idx 
            ) AS t_new
            
        ";

        $query = " SELECT * FROM ". $join_table ." WHERE 1=1 " . $arg_where;

        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    
    /**
     * 사용가능한 제품 재고 수를 반환 한다.
     */
    public function getAvailableStocks( $arg_stock_idx ){
        
        $query = " 
            SELECT 
                ( product_quantity - ( SELECT IFNULL( SUM( product_quantity ), 0 )  FROM ". $this->table_product_stock ." WHERE production_idx = t_stock.production_idx AND task_type <> 'I' AND del_flag='N' ) ) AS stock_quantity
            FROM ". $this->table_product_stock ." AS t_stock WHERE stock_idx = '". $arg_stock_idx ."' AND task_type='I' AND ( del_flag='N' )
        ";

        $query_result = $this->db->execute( $query );

        return $query_result['return_data']['row']['stock_quantity'];


    }

    /**
     * 사용가능한 제품 재고 수를 반환 한다.
     */
    public function getAvailableStockByExpirationDate( $arg_stock_idx ){

        $query = " 
            SELECT	stock_idx
                    , SUM( result_quantity ) AS stock_quantity
                    ,expiration_date
            FROM (
                SELECT	
                    * 
                    , (product_quantity - used_quantity ) AS result_quantity
                FROM ( 
                        SELECT 
                            t_stock.stock_idx
                            ,t_stock.product_name
                            ,t_stock.product_unit_idx
                            ,t_stock.product_unit
                            ,t_stock.product_unit_type
                            ,t_stock.packaging_unit_quantity
                            ,t_stock.product_quantity
                            ,t_order.expiration_date
                            ,t_order.expiration_days
                            ,t_order.production_idx
                            , (
                                SELECT IFNULL( SUM(product_quantity), 0 ) 
                                FROM ". $this->table_product_stock ." 
                                WHERE ( production_idx=t_stock.production_idx ) AND ( product_unit_idx=t_stock.product_unit_idx ) AND ( del_flag='N' ) AND ( task_type <> 'I' )
                            ) AS used_quantity
                        FROM ". $this->table_product_stock ." AS t_stock LEFT OUTER JOIN ". $this->table_production_order ." AS t_order
                        ON t_stock.production_idx = t_order.production_idx 
                        WHERE t_stock.task_type = 'I' AND t_stock.product_unit_idx = '".$arg_stock_idx."'
                ) AS as_stock_result
            ) AS t_state
            group by expiration_date
        ";

        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }




    


}

?>