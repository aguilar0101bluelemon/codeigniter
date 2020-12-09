<?php
        class Blog extends CI_Controller{
                public function index()

                {
                        echo 'Hello World';
                }
                public function comentarios($id)
                {
                        if(!is_numeric($id)){
                                $respuesta = array('err' => true, 'mensaje'=>'el id tiene que ser numerico');
                                echo json_encode($respuesta);

                                return;
                        }

                        $comentarios = array (
                                array( 'id' => 1, 'mensaje'=> 'lorem 1'),
                                array( 'id' => 2, 'mensaje'=> 'lorem 2'),
                                array( 'id' => 3, 'mensaje'=> 'lorem 3'),
                        );

                        if($id >= count($comentarios) OR $id < 0){
                                $respuesta = array('err' => true, 'mensaje'=>'el id no existe');
                                echo json_encode($respuesta);

                                return; 
                        }

                        echo json_encode($comentarios[$id]);
                }

        }

