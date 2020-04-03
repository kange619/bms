<?php

class productionModel extends baseModel {

    private $table;
    private $table_product;
    private $table_product_unit;
    private $table_mixing_ratio;
    private $table_company_members;
    private $table_product_stock;

    function __construct() {

        $this->table = ' t_production_order ';               
        $this->table_product = ' t_products_info ';    
        $this->table_product_unit = ' t_product_unit_info ';        
        $this->table_mixing_ratio = ' t_mixing_ratio ';        
        $this->table_company_members = ' t_company_members ';        
        $this->table_product_stock = ' t_product_stock ';        

        $this->db = $this->connDB('masic');

    }

    function __destruct() {

        # db close
        $this->db->dbClose();

    }

    /**
     * 제품 생산 지시를 insert 한다.
     */
    public function insertProduction( $arg_data ){
        return $this->db->insert( $this->table, $arg_data );
    }

    /**
     * 제품 생산 지시를 update 한다.
     */
    public function updateProduction( $arg_data, $arg_where ){
        return $this->db->update( $this->table, $arg_data, $arg_where );
    }

    /**
     * 제품 생산 지시 목록을 반환한다.
     */
    public function getProductionOrders( $arg_data ){

        $result = [];
        
        $join_table = "
            (
                SELECT  
                        as_production.*                                                    
                        , as_product.product_name
                        , as_pu.product_unit
                        , as_pu.product_unit_type
                        , as_pu.packaging_unit_quantity
                        , as_member.member_name
                        , ( SELECT IFNULL( SUM(schedule_quantity), 0 ) FROM t_production_order WHERE production_status=as_production.production_status AND del_flag='N' ) AS total_schedule_quantity
                        , ( SELECT IFNULL( SUM(pouch_quantity), 0 ) FROM t_production_order WHERE production_status=as_production.production_status AND del_flag='N' ) AS total_pouch_quantity
                        , ( SELECT IFNULL( SUM(box_quantity), 0 ) FROM t_production_order WHERE production_status=as_production.production_status AND del_flag='N' ) AS total_box_quantity
                FROM
                        ". $this->table ." AS as_production LEFT OUTER JOIN ". $this->table_product ." AS as_product
                        ON as_production.product_idx = as_product.product_idx
                        LEFT OUTER JOIN ". $this->table_product_unit ." AS as_pu
                        ON as_production.product_unit_idx = as_pu.product_unit_idx
                        LEFT OUTER JOIN ". $this->table_company_members ." AS as_member
                        ON as_production.reg_idx = as_member.company_member_idx

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
     * 신규 제조 번호를 반환 한다.
     */
    public function getNewProduceNo( $arg_no ){

        $query = " SELECT IFNULL( MAX( produce_no ), '') AS max_code FROM ". $this->table ." WHERE produce_no LIKE '". $arg_no ."%' ";

        $query_result = $this->db->execute( $query );

        return $query_result['return_data']['row']['max_code'];

    }

    /**
     * 제품 생산 지시 상세 정보를 반환
     */
    public function getProductionOrder( $arg_where ){

        $join_table = "
            (
                SELECT  
                        as_production.*                                                    
                        , as_product.product_name
                        , as_pu.product_unit
                        , as_pu.product_unit_type
                        , as_pu.packaging_unit_quantity
                        , as_member.member_name
                                    

                FROM
                        ". $this->table ." AS as_production LEFT OUTER JOIN ". $this->table_product ." AS as_product
                        ON as_production.product_idx = as_product.product_idx
                        LEFT OUTER JOIN ". $this->table_product_unit ." AS as_pu
                        ON as_production.product_unit_idx = as_pu.product_unit_idx
                        LEFT OUTER JOIN ". $this->table_company_members ." AS as_member
                        ON as_production.reg_idx = as_member.company_member_idx

            ) AS t_new
            
        ";
     
        $query = " SELECT * FROM ". $join_table ." WHERE 1=1 " . $arg_where;

        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 생산 제품 재고를 insert 한다.
     */
    public function insertProductStock( $arg_data ){
        return $this->db->insert( $this->table_product_stock, $arg_data );
    }

    /**
     * 생산 제품 재고를 수정한다.
     */
    public function updateProductStock( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_product_stock, $arg_data, $arg_where );
    }



}

?>