<?php

class docModel extends baseModel {

    private $table_doc_usage;
    private $table_doc_approval;
    private $table_members;

    function __construct() {

        $this->table_doc_usage = ' t_document_usage ';
        $this->table_doc_approval = ' t_document_approval ';
        $this->table_members = ' t_company_members ';
        $this->db = $this->connDB('masic');

    }

    /**
     * 문서 목록을 반환한다.
     */
    public function getApprovalDocuments( $arg_data ){

        $result = [];
        $join_table = "
            (
                SELECT  
                        as_approval.*                                                    
                        , as_member.member_name AS writer_name                      
                        , ( SELECT member_name FROM ". $this->table_members ." WHERE company_member_idx = as_approval.reviewer_idx ) AS reviewer_name
                        , ( SELECT member_name FROM ". $this->table_members ." WHERE company_member_idx = as_approval.approver_idx ) AS approver_name
                FROM
                        ". $this->table_doc_approval ." AS as_approval LEFT OUTER JOIN ". $this->table_members ." AS as_member
                        ON as_approval.writer_idx = as_member.company_member_idx                        
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
     * 문서 정보를 반환한다.
     */
    public function getApprovalDocument( $arg_where ){

        $result = [];

        $join_table = "
            (
                SELECT  
                        as_approval.*                                                    
                        , as_member.member_name AS writer_name                      
                        , ( SELECT member_name FROM ". $this->table_members ." WHERE company_member_idx = as_approval.reviewer_idx ) AS reviewer_name
                        , ( SELECT member_name FROM ". $this->table_members ." WHERE company_member_idx = as_approval.approver_idx ) AS approver_name
                FROM
                        ". $this->table_doc_approval ." AS as_approval LEFT OUTER JOIN ". $this->table_members ." AS as_member
                        ON as_approval.writer_idx = as_member.company_member_idx                        
            ) AS t_new
            
        ";


        $query = " SELECT * FROM ". $join_table ." WHERE 1=1 " . $arg_where;

        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }

    /**
     * 회사 문서양식을 반환한다.
     */
    public function getDocumentForm( $arg_where ){

        $result = [];

        $query = " SELECT * FROM ". $this->table_doc_usage ." WHERE 1=1 " . $arg_where;

        $query_result = $this->db->execute( $query );

        return $query_result['return_data'];

    }


    /**
     * 문서 정보를 insert 한다.
     */
    public function insertApprovalDoc( $arg_data ){
        return $this->db->insert( $this->table_doc_approval, $arg_data );
    }

    /**
     * 정보를 update 한다.
     */
    public function updateApprovalDoc( $arg_data, $arg_where ){
        return $this->db->update( $this->table_doc_approval, $arg_data, $arg_where );
    }

    function __destruct() {

        # db close
        $this->db->dbClose();

    }

}

?>