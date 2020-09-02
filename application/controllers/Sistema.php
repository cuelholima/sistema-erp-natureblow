<?php defined('BASEPATH') OR exit ('Ação não permitida');

class Sistema extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index(){
        $data = array(
            'titulo' => 'Editar informações do sistema',
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );

        $this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'required|min_length[4]|max_length[40]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome Fantasia', 'required|min_length[4]|max_length[40]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'required');
        $this->form_validation->set_rules('sistema_razao_social', 'I.E', 'required|min_length[10]|max_length[25]');

        $this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'required|valid_email|max_length[40]');
        $this->form_validation->set_rules('sistema_site_url', 'Site', 'required|valid_url|max_length[45]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'required');

        $this->form_validation->set_rules('sistema_endereco', 'Endereço', 'required|max_length[45]');
        $this->form_validation->set_rules('sistema_numero', 'Nº', 'required|max_length[6]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'required|max_length[40]');
        $this->form_validation->set_rules('sistema_uf', 'UF', 'required|exact_length[2]');

        $this->form_validation->set_rules('sistema_ordem_servico', 'Texto da ordem de serviço', 'max_length[500]');


        if($this->form_validation->run()){

            $data = elements(

                array(

                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_telefone_movel',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_endereco',
                    'sistema_numero',
                    'sistema_cep',
                    'sistema_cidade',
                    'sistema_estado',
                    'sistema_txt_ordem_servico',
                ), $this->input->post()
            );

            $this->core_model->update('sistema', $data, array('sistema_id' => 1));
            redirect('sistema');

        } else{     
            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
        }     

    }


}