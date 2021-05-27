<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Products extends MX_Controller {

    /**
     * This controller is using for controlling to Products
     *
     * Maps to the following URL
     * 		http://example.com/index.php/users
     * 	- or -  
     * 		http://example.com/index.php/users/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->model('productmodel');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
     //THis function add new Category 
    public function addCategory() {

        if ($this->input->post('submit', TRUE)) {
            $cat_name = $this->input->post('cat_name', TRUE);
            $company_name = $this->input->post('company_name', TRUE);
            $discription = $this->input->post('discription', TRUE);
            $userid = $this->input->post('user_id', TRUE);
        // add category array data
            $add_category = array(
                'category_name' => $this->db->escape_like_str($cat_name), 
                'company_name' => $this->db->escape_like_str($company_name), 
                'company_discription' => $this->db->escape_like_str($discription), 
                'status' => $this->db->escape_like_str('Active'),
                'created_by' => $this->db->escape_like_str($userid),

            ); 
        // insert data into database add_product_category table
            if ($this->db->insert('add_product_category', $add_category)) {
                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                            <strong>Success</strong> Add Category Successfully <strong> ' . $cat_name . '</strong>
                                    </div>';
        // get data into database all category
                //$data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
                $this->load->view('temp/header');
                $this->load->view('addCategory', $data);
                $this->load->view('temp/footer');
            }
        } else { 
           // $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
            $this->load->view('temp/header');
            $this->load->view('addCategory');
            $this->load->view('temp/footer');
        }
    }
    //This function get all category information
    public function allCategory() {
        $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
        $this->load->view('temp/header');
        $this->load->view('allCategory', $data);
        $this->load->view('temp/footer');
    }   

//This function is used for a full category and product informtion
    public function categoryDetails() {
        $p_id = $this->input->get('c_id');
        $data['cateInfo']  = $this->productmodel->getWhere('add_product_category', 'id', $p_id); 
        $data['proInfo']   = $this->productmodel->getWhere('add_products', 'cate_id', $p_id);   
        
        $this->load->view('temp/header');
        $this->load->view('categoryDetails', $data);
        $this->load->view('temp/footer');
    }
    // This function is edit Category information
    public function editCategory(){
        if ($this->input->post('submit', TRUE)) {
            $category_name = $this->input->post('category_name', TRUE);
            $company_name = $this->input->post('company_name', TRUE);
            $company_discription = $this->input->post('company_discription', TRUE);
            $status = $this->input->post('status', TRUE);
            $userid = $this->input->post('user_id', TRUE);
            $cateId = $this->input->post('cateId', TRUE);

        // this array data is updated data  
            $editCategory = array(
                'category_name' => $this->db->escape_like_str($category_name), 
                'company_name' => $this->db->escape_like_str($company_name),
                'company_discription' => $this->db->escape_like_str($company_discription),
                'status' => $this->db->escape_like_str($status),
                'created_by' => $this->db->escape_like_str($userid)
            );
        // this check is checked  
            $this->db->where('id', $cateId); 
        // this query is update data into database add_product_category
            if ($this->db->update('add_product_category', $editCategory)) {
                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                        <strong> Success </strong> Update Categroy Info ' . $category_name . '
                                    </div>';
                $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
                $this->load->view('temp/header');
                $this->load->view('allCategory', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $cateId = $this->input->get('c_id'); 
            $data['cateId'] =  $cateId;
            $data['cateInfo'] = $this->productmodel->getWhere('add_product_category', 'id', $cateId);
            $this->load->view('temp/header');
            $this->load->view('editCategory', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function can delete product Category information
    public function deleteCategory() {
        $id = $this->input->get('id');
        // delete query
        if ($this->db->delete('add_product_category', array('id' => $id))) {
            $data['success'] = '<div class="alert alert-danger alert-dismissable admisionSucceassMessageFont">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                            <strong>Success</strong> Remove Category Successfully <strong> </strong>
                                    </div>';
                
                $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
                $this->load->view('temp/header');
                $this->load->view('allCategory', $data);
                $this->load->view('temp/footer');

            // redirect('products/allCategory/', 'refresh');
        }
    }
    

//// this section is product curd queries///////

     //THis function add new Product in database 
    public function addProduct() {

        if ($this->input->post('submit', TRUE)) {
            $cat_id = $this->input->post('cat_id', TRUE); 
            $product_name = $this->input->post('product_name', TRUE);
            $product_size = $this->input->post('product_size', TRUE);
            $product_price = $this->input->post('product_price', TRUE);  
            $discription = $this->input->post('discription', TRUE);
            $userid = $this->input->post('user_id', TRUE);

        // add product array data
            $add_product = array(

                'cate_id' => $this->db->escape_like_str($cat_id), 
                'product_name' => $this->db->escape_like_str($product_name), 
                'product_size' => $this->db->escape_like_str($product_size), 
                'product_price' => $this->db->escape_like_str($product_price), 
                'product_discription' => $this->db->escape_like_str($discription), 
                'status' => $this->db->escape_like_str('Active'),
                'created_by' => $this->db->escape_like_str($userid)
            );  
        // insert data into database in add_products table
            if ($this->db->insert('add_products', $add_product)) {
                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                            <strong>Success</strong> Add Product Successfully <strong> ' . $product_name . '</strong>
                                    </div>';
        // get data into database all category
                $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
                $this->load->view('temp/header');
                $this->load->view('addProduct', $data);
                $this->load->view('temp/footer');
            }
        } else { 
            $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
            $this->load->view('temp/header');
            $this->load->view('addProduct',  $data);
            $this->load->view('temp/footer');
        }
    }

    //This function get all products information
    public function allProducts() {
        $data['proInfo'] = $this->productmodel->getAllData('add_products');
        $this->load->view('temp/header');
        $this->load->view('allProducts', $data);
        $this->load->view('temp/footer');
    }   
    
    //This function is used for a full product informtion
    public function productDetails() {
        $p_id = $this->input->get('p_id');
        $data['proInfo'] = $this->productmodel->getWhere('add_products', 'id', $p_id);  
        
        $this->load->view('temp/header');
        $this->load->view('productDetails', $data);
        $this->load->view('temp/footer');
    }

    // This function is edit Product information
    public function editProducts(){
        if ($this->input->post('submit', TRUE)) {
            $proid = $this->input->post('proId', TRUE);
            $cate_id = $this->input->post('cate_id', TRUE);
            $product_name = $this->input->post('product_name', TRUE);
            $product_size = $this->input->post('product_size', TRUE);
            $product_price = $this->input->post('product_price', TRUE);
            $product_discription = $this->input->post('product_discription', TRUE); 
            $status = $this->input->post('status', TRUE);

            $userid = $this->input->post('user_id', TRUE);

        // this array data is updated data  
            $editProduct = array(
                'cate_id' => $this->db->escape_like_str($cate_id), 
                'product_name' => $this->db->escape_like_str($product_name),
                'product_size' => $this->db->escape_like_str($product_size),
                'product_price' => $this->db->escape_like_str($product_price),
                'product_discription' => $this->db->escape_like_str($product_discription), 
                'status' => $this->db->escape_like_str($status),
                'created_by' => $this->db->escape_like_str($userid)
            ); 
        // this check is checked  
            $this->db->where('id', $proid); 
        // this query is update data into database add_product_category
            if ($this->db->update('add_products', $editProduct)) {
                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                        <strong> Success </strong> Update product Info Successfully' . $product_name . '
                                    </div>';
                $data['proInfo'] = $this->productmodel->getAllData('add_products');

                $this->load->view('temp/header');
                $this->load->view('allProducts', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $cateId = $this->input->get('c_id'); 
            $data['proId'] =  $cateId;
            $data['proInfo'] = $this->productmodel->getWhere('add_products', 'id', $cateId);
            $data['cateInfo'] = $this->productmodel->getAllData('add_product_category');
            $this->load->view('temp/header');
            $this->load->view('editProduct', $data);
            $this->load->view('temp/footer');
        }
    }


   //This function can delete product information
    public function delProduct() {
        $p_id = $this->input->get('id');
        // delete query
        if ($this->db->delete('add_products', array('id' => $p_id))) {
            $data['success'] = '<div class="alert alert-danger alert-dismissable admisionSucceassMessageFont">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                            <strong>Success</strong> Remove Product Successfully  
                                    </div>';
                
                $data['proInfo'] = $this->productmodel->getAllData('add_products');

                $this->load->view('temp/header');
                $this->load->view('allProducts', $data);
                $this->load->view('temp/footer');
 
        }
    }

    
}
