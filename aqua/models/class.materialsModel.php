<?php

class materialsModel extends baseModel {

    private $table_company;
    private $table_materials_usage;    
    private $table_materials_order;    
    private $table_materials_stock;    
    private $table_materials;    
    private $table_doc_approval;    

    function __construct() {

        $this->table_company = ' t_material_company ';        
        $this->table_materials_usage = ' t_materials_usage ';
        $this->table_materials_order = ' t_materials_order ';
        $this->table_materials_stock = ' t_materials_stock ';
        $this->table_materials = ' t_materials ';
        $this->table_doc_approval = ' t_document_approval ';
        
        $this->db = $this->connDB('masic');

    }

    function __destruct() {

        # db close
        $this->db->dbClose();

    }

    /**
     * 납품 업체 목록을 반환한다.
     */
    public function getCompanys( $arg_data ){

        $result = [];

        $query = " SELECT COUNT(*) AS cnt FROM ". $this->table_company ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = " SELECT * FROM ". $this->table_company ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;

    }
    
    /**
     * 납품업체 정보를 가져온다.
     */
    public function getCompany( $arg_where ){

        $query = " SELECT * FROM ". $this->table_company ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 납품업체 정보를 insert 한다.
     */
    public function insertCompany( $arg_data ){
        return $this->db->insert( $this->table_company, $arg_data );
    }

    /**
     * 납품업체 정보를 수정한다.
     */
    public function updateCompany( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_company, $arg_data, $arg_where );
    }

    /**
     * 주문 정보를 insert 한다.
     */
    public function insetOrder( $arg_data ){
        return $this->db->insert( $this->table_materials_order, $arg_data );
    }

    /**
     * 주문 정보를 수정한다.
     */
    public function updateOrder( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_materials_order, $arg_data, $arg_where );
    }

    /**
     * 원부자재 insert
     */
    public function insetMaterialStd( $arg_data ){
        return $this->db->insert( $this->table_materials, $arg_data );
    }

    /**
     * 원부자재 update
     */
    public function updateMaterialStd( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_materials, $arg_data, $arg_where );
    }

    /**
     * 재고 정보를 insert 한다.
     */
    public function insertStock( $arg_data ){
        return $this->db->insert( $this->table_materials_stock, $arg_data );
    }

    /**
     * 재고 정보를 update 한다.
     */
    public function updateStock( $arg_data, $arg_where ){
        return $this->db->update( $this->table_materials_stock, $arg_data, $arg_where );
    }

    /**
     * 재고 정보 확인
     */
    public function doubleCheckStock( $arg_where ){

        $query = " SELECT count(*) AS check_cnt FROM ". $this->table_materials_stock ." WHERE " . $arg_where;

        $query_result = $this->db->execute( $query );

        return $query_result['return_data']['row']['check_cnt'];

    }

    /**
     * 유형 코드를 생성해 반환한다.
     */
    public function getMaxCode( $arg_type ){

        $query = " SELECT IFNULL( MAX( product_registration_no ), '') AS max_code FROM ". $this->table ." WHERE product_registration_no LIKE '". $arg_type ."%' ";

        $query_result = $this->db->execute( $query );

        return $query_result['return_data']['row']['max_code'];

    }


    /**
     * 자재 정보를 가져온다.
     */
    public function getMaterials( $arg_where ){

        $query = "  SELECT as_material.*,  as_company.company_name
                    FROM ". $this->table_materials_usage ." AS as_material LEFT OUTER JOIN ". $this->table_company ." AS as_company
                    ON as_material.material_company_idx = as_company.material_company_idx
                    WHERE ( as_material.del_flag='N' ) AND ( as_company.del_flag='N' ) AND " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 원부자재 재고 정보들을 가져온다.
     */
    public function getMaterialStocks( $arg_data ){
        $result = [];

        $join_table = "
            (
                SELECT  
                        as_stock.*                                                    
                        , as_company.company_name
                        , as_company.manager_name
                        , as_company.manager_phone_no                

                FROM
                        ". $this->table_materials_stock ." AS as_stock LEFT OUTER JOIN ". $this->table_materials_usage ." AS as_materials
                        ON as_stock.materials_usage_idx = as_materials.materials_usage_idx
                        LEFT OUTER JOIN ". $this->table_company ." AS as_company
                        ON as_materials.material_company_idx = as_company.material_company_idx

            ) AS t_new
            
        ";

        $query = " SELECT COUNT(*) AS cnt FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = " SELECT IFNULL( SUM( quantity ), 0 ) AS total_quantity FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_quantity'] = $query_result['return_data']['row']['total_quantity'];


        $query = " SELECT * FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;
    }


    /**
     * 원부자재 기준 정보들을 가져온다.
     */
    public function getMaterialStds( $arg_data ){
        $result = [];

        $query = " SELECT COUNT(*) AS cnt FROM ". $this->table_materials ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = " SELECT * FROM ". $this->table_materials ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;
    }

    /**
     * 원부자재 기준 정보를 가져온다.
     */
    public function getMaterialStd( $arg_where ){

        $query = " SELECT * FROM ". $this->table_materials ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 배합비율 정보를 insert 한다.
     */ 
    public function insertMaterial( $arg_data ){
        return $this->db->insert( $this->table_materials_usage, $arg_data );
    }

    /**
     * 배합비율 정보를 수정한다.
     */
    public function updateMaterial( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_materials_usage, $arg_data, $arg_where );
    }

    

    /**
     * 주문정보를 불러온다.
     */
    public function getOrders( $arg_data ){

        $result = [];

        $join_table = "
            (
                SELECT  
                        as_order.*
                        , as_materials.material_code                                   
                        , as_company.company_name
                        , as_company.manager_name
                        , as_company.manager_phone_no                
                        , ( SELECT doc_approval_idx FROM ". $this->table_doc_approval ." WHERE ( task_table_idx = as_order.order_idx ) AND (del_flag = 'N') AND ( task_type = '". trim( $this->table_materials_order ) ."' ) ) AS doc_exist
                        , ( SELECT approval_state FROM ". $this->table_doc_approval ." WHERE ( task_table_idx = as_order.order_idx ) AND (del_flag = 'N') AND ( task_type = '". trim( $this->table_materials_order ) ."' ) ) AS doc_approval_state                        
                FROM
                        ". $this->table_materials_order ." AS as_order LEFT OUTER JOIN ". $this->table_materials_usage ." AS as_materials
                        ON as_order.materials_usage_idx = as_materials.materials_usage_idx
                        LEFT OUTER JOIN ". $this->table_company ." AS as_company
                        ON as_materials.material_company_idx = as_company.material_company_idx

            ) AS t_new
            
        ";

        $query = " SELECT COUNT(*) AS cnt FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = " SELECT * FROM ". $join_table ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;

    }

    /**
     * 납품업체 정보를 가져온다.
     */
    public function getOrder( $arg_where ){

        $join_table = "
            (
                SELECT  
                        as_order.*
                        , as_materials.material_code                                                                    
                        , as_company.company_name
                        , as_company.manager_name
                        , as_company.manager_phone_no                

                FROM
                        ". $this->table_materials_order ." AS as_order LEFT OUTER JOIN ". $this->table_materials_usage ." AS as_materials
                        ON as_order.materials_usage_idx = as_materials.materials_usage_idx
                        LEFT OUTER JOIN ". $this->table_company ." AS as_company
                        ON as_materials.material_company_idx = as_company.material_company_idx

            ) AS t_new
            
        ";

        $query = " SELECT * FROM ". $join_table ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 사용가능한 재고 수를 반환 한다.
     */
    public function getAvailableStocks( $arg_order_idx ){
        
        $query = " 
            SELECT 
                ( quantity - ( SELECT IFNULL( SUM( quantity ), 0 )  FROM ". $this->table_materials_stock ." WHERE order_idx = '". $arg_order_idx ."' AND task_type <> 'I' AND del_flag='N' ) ) AS stock_quantity
            FROM ". $this->table_materials_stock ." WHERE order_idx = '". $arg_order_idx ."' AND task_type='I' AND ( del_flag='N' )
        ";
        $query_result = $this->db->execute( $query );

        return $query_result['return_data']['row']['stock_quantity'];


    }

    /**
     * 원부자재 입고 날짜별 수량
     */
    public function getQuantityByReceivingDate( $arg_where ){

        $query = " 
        SELECT * 
        FROM (
                SELECT * , ( total_in_quantity - use_quantity ) AS stock_quantity
                FROM (
                
                    SELECT * 
                        ,(SELECT IFNULL( SUM( quantity ), 0 ) FROM ". $this->table_materials_stock ." WHERE ( del_flag='N' ) AND ( task_type <> 'I' ) AND (  material_idx=use_insert_quantity.material_idx ) AND (receipt_date=use_insert_quantity.receipt_date)  ) AS use_quantity                        
                    FROM 
                    (
                        SELECT  SUM( quantity ) AS total_in_quantity , receipt_date, material_idx, material_kind   		
                        FROM ". $this->table_materials_stock ." WHERE ( del_flag='N' ) AND ( task_type='I' ) ". $arg_where ."
                        GROUP BY receipt_date, material_idx
                    ) AS use_insert_quantity
                
                )  AS t_cur
        ) AS t_result
        WHERE  stock_quantity > 0
        ";


        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }



     /**
     * 원부자재별 입고/사용수/재고수
     */
    public function getMaterialStockState(){

        $query = " 
            SELECT 
                as_mt.*
                , IFNULL( tmp_available_stocks.total_in_quantity, 0 ) AS total_in_quantity
                , IFNULL( tmp_available_stocks.use_quantity , 0 ) AS use_quantity
                , IFNULL( tmp_available_stocks.stock_quantity , 0 ) AS stock_quantity
                , ( SELECT IFNULL( SUM(quantity), 0 ) FROM ". $this->table_materials_stock ." WHERE ( material_idx=tmp_available_stocks.material_idx ) AND ( del_flag='N' )  AND ( task_type = 'R' ) ) AS total_return_quantity
                , ( SELECT IFNULL( SUM(quantity), 0 ) FROM ". $this->table_materials_stock ." WHERE ( material_idx=tmp_available_stocks.material_idx ) AND ( del_flag='N' )  AND ( task_type = 'U' ) ) AS total_use_quantity
                , ( SELECT IFNULL( SUM(quantity), 0 ) FROM ". $this->table_materials_stock ." WHERE ( material_idx=tmp_available_stocks.material_idx ) AND ( del_flag='N' )  AND ( task_type = 'D' ) ) AS total_discard_quantity
                , ( SELECT IFNULL( SUM(quantity), 0 ) FROM ". $this->table_materials_stock ." WHERE ( material_idx=tmp_available_stocks.material_idx ) AND ( del_flag='N' )  AND ( task_type = 'S' ) ) AS total_schedule_quantity
            FROM ".$this->table_materials." AS as_mt LEFT OUTER JOIN (
                SELECT * 
                FROM (
                    SELECT * , ( total_in_quantity - use_quantity ) AS stock_quantity
                    FROM (
                    
                        SELECT * 
                        ,(SELECT IFNULL( SUM( quantity ), 0 ) FROM ". $this->table_materials_stock ." WHERE ( del_flag='N' ) AND ( task_type <> 'I' ) AND (  material_idx=use_insert_quantity.material_idx )   ) AS use_quantity                        
                        FROM 
                        (
                            SELECT  SUM( quantity ) AS total_in_quantity , receipt_date, material_idx, material_kind   		
                            FROM ". $this->table_materials_stock ." WHERE ( del_flag='N' ) AND ( task_type='I' ) AND ( company_idx = '". COMPANY_CODE ."' )
                            GROUP BY material_idx
                        ) AS use_insert_quantity
                    
                    )  AS t_cur
                ) AS t_result
            ) AS tmp_available_stocks
            ON as_mt.material_idx = tmp_available_stocks.material_idx
            WHERE as_mt.del_flag='N' AND as_mt.use_flag='Y'
        ";


        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }
        


}



?>