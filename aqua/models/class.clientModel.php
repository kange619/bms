<?php

class clientModel extends baseModel {

    private $table_client;
    private $table_client_company_addr;    
    private $table_client_receive_order;    

    function __construct() {

        $this->table_client = ' t_client_company ';        
        $this->table_client_company_addr = ' t_client_company_addr ';        
        $this->table_client_receive_order = ' t_client_receive_order ';        
        
        $this->db = $this->connDB('masic');

    }

    function __destruct() {

        # db close
        $this->db->dbClose();

    }

    /**
     * 수주 업체 목록을 반환한다.
     */
    public function getClients( $arg_data ){

        $result = [];

        $query = " SELECT COUNT(*) AS cnt FROM ". $this->table_client ." WHERE 1=1 " . $arg_data['query_where'];

        $query_result = $this->db->execute( $query );

        $result['total_rs'] = $query_result['return_data']['row']['cnt'];

        $query = " SELECT * FROM ". $this->table_client ." WHERE 1=1 " . $arg_data['query_where']. $arg_data['query_sort'] . $arg_data['limit'];
        
        $query_result = $this->db->execute( $query );

        $result['rows'] = $query_result['return_data']['rows'];

        return $result;

    }
    
    /**
     * 수주업체 정보를 가져온다.
     */
    public function getClient( $arg_where ){

        $query = " SELECT * FROM ". $this->table_client ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 수주업체 정보를 insert 한다.
     */
    public function insertClient( $arg_data ){
        return $this->db->insert( $this->table_client, $arg_data );
    }

    /**
     * 수주업체 정보를 수정한다.
     */
    public function updateClient( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_client, $arg_data, $arg_where );
    }


     /**
     * 수주업체 정보를 가져온다.
     */
    public function getClientComapnyAddr( $arg_where ){

        $query = " SELECT * FROM ". $this->table_client_company_addr ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 수주업체 정보를 insert 한다.
     */
    public function insertClientCompanyAddr( $arg_data ){
        return $this->db->insert( $this->table_client_company_addr, $arg_data );
    }

    /**
     * 수주업체 정보를 수정한다.
     */
    public function updateClientCompanyAddr( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_client_company_addr, $arg_data, $arg_where );
    }

    /**
     * 수주정보를 insert 한다.
     */
    public function insertClientReceiveOrder( $arg_data ){
        return $this->db->insert( $this->table_client_receive_order, $arg_data );
    }

    /**
     * 수주정보를 수정한다.
     */
    public function updateClientReceiveOrder( $arg_data, $arg_where ) {
        return $this->db->update( $this->table_client_receive_order, $arg_data, $arg_where );
    }

    
     /**
     * 고객사 배송지 정보를 insert 한다.
     */ 
    public function insertcompanyAddrs( 
        $arg_client_idx
        , $arg_addr_name
        , $zipcode
        , $addr
        , $addr_detail  
        , $arg_company_idx
     ){

        $insert_query = ' INSERT INTO '. $this->table_client_company_addr . ' 
                        (   
                            client_idx
                            , addr_name
                            , zipcode
                            , addr
                            , addr_detail
                            , company_idx                          
                            , reg_idx
                            , reg_ip
                            , reg_date 
                        ) VALUES ';

        $insert_add_query = [];

        foreach( $arg_addr_name AS $idx=>$val ){            

            if( ( empty( $val ) == false )  ) {
                $insert_add_query[] = " ( 
                    '". $arg_client_idx ."'
                    ,'". $arg_addr_name[$idx] ."'
                    ,'". $zipcode[$idx] ."'
                    ,'". $addr[$idx] ."'
                    , '". $addr_detail[ $idx ] ."'
                    ,'". $arg_company_idx ."'                   
                    , '". getAccountInfo()['idx'] ."'
                    , '". $this->getIP() ."'
                    , NOW() 
                ) ";
            }

        }
        
        if( count($insert_add_query) > 0 ) {

            $insert_query .= join( ', ', $insert_add_query );
            $return_data = $this->db->execute( $insert_query );

        } else {
            $return_data['state'] = true;
        }
        

        return $return_data;
    }

    /**
     * 수주정보 목록을 반환한다.
     */
    public function getReceiveOrders( $arg_data ){
        $result = [];

        $join_table = "
            (
                SELECT  
                        as_order.*                                                  
                        , as_client.company_name
                        , as_client.manager_name
                        , as_client.manager_phone_no                

                FROM
                        ". $this->table_client_receive_order ." AS as_order LEFT OUTER JOIN ". $this->table_client ." AS as_client
                        ON as_order.client_idx = as_client.client_idx
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
     * 수주 정보를 반환한다.
     */
    public function getReceiveOrder( $arg_where ){

        $join_table = "
            (
                SELECT  
                        as_order.*                                                  
                        , as_client.company_name
                        , as_client.manager_name
                        , as_client.manager_phone_no                
                        , as_client.client_zip_code                
                        , as_client.client_addr                
                        , as_client.client_addr_detail                

                FROM
                        ". $this->table_client_receive_order ." AS as_order LEFT OUTER JOIN ". $this->table_client ." AS as_client
                        ON as_order.client_idx = as_client.client_idx
            ) AS t_new
            
        ";

        $query = " SELECT * FROM ". $join_table ." WHERE " . $arg_where;
        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }


}



?>