<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

require( APPPATH.'/libraries/REST_Controller.php');
/* use Restserver\Libraries\REST_Controller; */



        class Clientes extends REST_Controller{
            public function __construct(){
                parent::__construct();
                $this->load->database();
                $this->load->model('Cliente_model');
                //$this->load->helper('utilidades');
            }

            public function paginar_get(){
                $this->load->helper('paginacion');
                $pagina = $this->uri->segment(3);
                $por_pagina = $this->uri->segment(4);
                //$campos = array('id', 'nombre', 'telefono1');

                $respuesta = paginar_todo('clientes', $pagina, $por_pagina /* $campos */);

                $this->response($respuesta);

               
            }

            /* public function index_get(){
                $this->load->helper('utilidades');
                $data = array(
                    'nombre' => 'roberto aguilar',
                    'contacto' => 'fernando herrrera',
                    'direccion'=> 'residensial'
                );
                $campos_capitalizar=array('nombre','contacto');
                $data = capitalizar_arreglo($data,$campos_capitalizar );

                echo json_encode($data);


            } */



            public function cliente_get(){
                //$this->load->model('Cliente_model');

                $cliente_id = $this->uri->segment(3);

                if(!isset($cliente_id)){
                    $respuesta = array(
                        'err'=>TRUE,
                        'mensaje '=> 'Es necesario el ID del cliente'
                    );
                    $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
                    return;
                }

                $cliente = $this->Cliente_model->get_cliente($cliente_id);

                if(isset($cliente)){
                    $respuesta = array(
                        'err'=>FALSE,
                        'mensaje '=> 'Registro cargado correctamente',
                        'cliente' => $cliente
                    );
                    $this->response($respuesta);
                }else{
                    $respuesta = array(
                        'err'=>TRUE,
                        'mensaje '=> 'Registro con el id '. $cliente_id . ' no existe',
                        'cliente' => null
                    );
                    $this->response($respuesta,REST_Controller::HTTP_NOT_FOUND );
                }

                $this->response($cliente);
                //echo json_encode($cliente);

                
                //echo $cliente_id;

               
            }

        }