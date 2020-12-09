<?php
defined('BASEPATH') OR exit ('No direct script access allowed');


        class Pruebasdb extends CI_Controller{
            
            public function __construct(){
                parent::__construct();
                $this->load->database();
                $this->load->helper('utilidades');
            }


//tabla
            public function tabla(){

                /* $this->db->select('pais, count(*) as clientes'); */
                $this->db->distinct();
                $this->db->select('pais');
                $this->db->from('clientes');
                $this->db->order_by('pais', 'asc');
                $this->db->limit(10,10); //paginacion

                //echo $this->db->count_all_results();

                

                //$this->db->group_by('pais');

                /* $this->db->like('nombre','LINDSEY'); */

               /*  $ids = array(1,2,3,4,5);
                $this->db->where_in('id', $ids); */

               /*  $this->db->where('id ', 10);
                $this->db->or_where('id', 1); */

                $query = $this->db->get();

               /*  $this->db->select('id, nombre, correo, (select count(*) from clientes) as conteo'); */

              /*  $this->db->select_max('id', 'id_maximo'); */

              /*  $this->db->select_avg('id', 'id_promedio');

               $query = $this->db->get_where('clientes'); */

                /* $query = $this->db->get('clientes', 10, 0); */

                /* $query = $this->db->get_where('clientes', array('id'=>1)); */


                foreach ($query->result() as $fila){

                    echo $fila->pais . '<br/>';
                }

                //echo json_encode($query->result());

            }

            public function insertar(){

                //insertar un registro a la vez
                /* $data = array(
                    'nombre' => 'roberto',
                    'apellido' => 'aguilar'
                );

                $data = capitalizar_todo($data);

                $this->db->insert('test', $data);

                $respuesta = array(
                    'err' => FALSE,
                    'id_insertado ' =>$this->db->insert_id()
                );

                echo json_encode($respuesta); */

                //insertar multiples registros

                $data = array(
                    array( 
                    'nombre' => 'roberto',
                    'apellido' => 'aguilar'),
                    array( 
                        'nombre' => 'antonio',
                        'apellido' => 'martinez')
                   
                );

               /*  $data = capitalizar_todo($data); */

                $this->db->insert_batch('test', $data);

               /*  $respuesta = array(
                    'err' => FALSE,
                    'id_insertado ' =>$this->db->insert_id()
                ); */

                /* echo json_encode($respuesta); */
                echo $this->db->affected_rows();


            }

            public function actualizar(){


                $data = array(
                    'nombre' => 'Victor',
                    'apellido' => 'Jimenez'
                );
                $data = capitalizar_todo($data);
                $this->db->where('id', 1);
                $this->db->update('test',$data);

                echo 'todo ok';

            }

            public function eliminar(){

                $this->db->where('id',1);
                $this->db->delete('test');

                echo 'eliminado correctamente';
            }









            public function clientes_beta(){
                $this->load->database();

                $query = $this->db->query('SELECT id, nombre, correo, telefono1 FROM clientes limit 10');



                /* foreach($query->result() as $row)
                {
                    echo $row->id;
                    echo $row->nombre;
                    echo $row->correo;

                }

                echo 'Total registros: ' . $query->num_rows(); */


                $respuesta= array(
                    'err' => FALSE,
                    'mensaje' => 'Registro cargados correctamente',
                    'total_registros' => $query->num_rows(),
                    'clientes' => $query->result()
                );

                echo json_encode($respuesta);
            }


            public function cliente($id){
                $this->load->database();

                $query = $this->db->query('SELECT * FROM clientes where id = ' . $id);

                $fila= $query->row();

                if(isset($fila)){

                   $respuesta= array(
                    'err' => FALSE,
                    'mensaje' => 'Registro cargados correctamente',
                    'total_registros' => $query->num_rows(),
                    'clientes' => $query->result()
                );

                }else{
                    $respuesta= array(
                        'err' => TRUE,
                        'mensaje' => 'el registro con el id no existe '.$id. ' no existe',
                        'total_registros' => 0,
                        'clientes' => null
                    );
                }

                echo json_encode($respuesta);
            }



        }