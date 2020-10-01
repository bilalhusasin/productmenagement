<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function to_125()
    {
        //Update user_privileges for sales and purchase return report
        if ( ! $this->db->field_exists('purchase_return_report', 'user_privileges'))
        {
            if ( ! isset($fields['purchase_return_report']))
            {
                $this->load->dbforge();
                $new_fields = array(
                    'purchase_return_report' => array(
                        'type' => 'INT',
                        'constraint' => 11
                        ),
                    'sales_return_report' => array(
                        'type' => 'INT',
                        'constraint' => 11
                        ),
                    );
                $this->dbforge->add_column('user_privileges', $new_fields);
            }
        }
        //Update item status field to enum
        $items = $this->db->field_data('items');
        if ($items[8]->type == 'varchar')
        {
            $this->load->dbforge();
            $fields = array(
                'status' => array(
                    'name' => 'status',
                    'type' => 'ENUM("Active","Inactive")',
                    'default' => 'Active',
                    'null' => FALSE,
                    ),
                );
            $this->dbforge->modify_column('items', $fields);
        }
        //Update supplier status field to enum
        $items = $this->db->field_data('suppliers');
        if ($items[14]->type == 'varchar')
        {
            $this->load->dbforge();
            $fields = array(
                'status' => array(
                    'name' => 'status',
                    'type' => 'ENUM("Active","Inactive")',
                    'default' => 'Active',
                    'null' => FALSE,
                    ),
                );
            $this->dbforge->modify_column('suppliers', $fields);
        }

        echo 'Upgrade complete.';
    }

    public function from_125_to_126()
    {
        // Add company logo, currency_id and currency_symbol_position field
        if ( ! $this->db->field_exists('logo', 'companies'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'logo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20'
                    ),
                'currency_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                    ),
                'currency_symbol_position' => array(
                    'type' => 'ENUM("Before", "After")',
                    'default' => 'Before',
                    'null' => FALSE,
                    ),
                );
            $this->dbforge->add_column('companies', $new_fields);
        }

        // Add currency table
        if ( ! $this->db->table_exists('currencies') )
        {
            $query = file_get_contents('upgrade/126_currencies.sql');
            $this->db->conn_id->multi_query($query);
        }

        // Add item avco_price field and update price
        if ( ! $this->db->field_exists('avco_price', 'items'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'avco_price' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    ),
                );
            $this->dbforge->add_column('items', $new_fields);
        }

        $data = array();
        $q = $this->db->get('items');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        if (count($data) > 0)
        {
            foreach($data as $item)
            {
                // Update AVCO price in item table
                $avco = $this->MPurchase_details->get_avco($item['id']);
                $this->MItems->update_field($item['id'], 'avco_price', $avco);
            }
        }


        // Add sales_details cogs_total field and update price
        if ( ! $this->db->field_exists('cogs_total', 'sales_details'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'cogs_total' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    ),
                );
            $this->dbforge->add_column('sales_details', $new_fields);
        }

        echo 'Upgrade complete.';
    }

    public function from_126_to_200()
    {
        // Add tax_percent and tax_amount field in sales_master table
        if ( ! $this->db->field_exists('tax_percent', 'sales_master'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'tax_percent' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    'after' => 'customer_id',
                    ),
                'tax_amount' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    'after' => 'tax_percent',
                    ),
                );
            $this->dbforge->add_column('sales_master', $new_fields);
        }

        // Add ac_tax and tax_rate field in settings table
        if ( ! $this->db->field_exists('ac_tax', 'settings'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'ac_tax' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                    'constraint' => 11,
                    'after' => 'ac_cogs',
                    ),
                'tax_rate' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    'after' => 'ac_tax',
                    ),
                );
            $this->dbforge->add_column('settings', $new_fields);
        }

        // Add currency_settings field in user_privileges table
        if ( ! $this->db->field_exists('currency_settings', 'user_privileges'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'currency_settings' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                    'constraint' => 11,
                    'after' => 'basic_settings',
                    ),
                );
            $this->dbforge->add_column('user_privileges', $new_fields);
        }
    }

    public function from_200_to_210()
    {
        // Add tax_percent and tax_amount field in sales_return_master table
        if ( ! $this->db->field_exists('tax_percent', 'sales_return_master'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'tax_percent' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    'after' => 'customer_id',
                    ),
                'tax_amount' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    'after' => 'tax_percent',
                    ),
                );
            $this->dbforge->add_column('sales_return_master', $new_fields);
        }

        // Add cogs_total field in sales_return_details table
        if ( ! $this->db->field_exists('cogs_total', 'sales_return_details'))
        {
            $this->load->dbforge();
            $new_fields = array(
                'cogs_total' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
                    'after' => 'price_total',
                    ),
                );
            $this->dbforge->add_column('sales_return_details', $new_fields);
        }
    }

}