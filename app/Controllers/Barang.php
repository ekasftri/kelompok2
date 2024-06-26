<?php
namespace App\Controllers;

use App\Models\Modelbarang;

class Barang extends BaseController
{
    public function index()
    {
        return view('barang/viewTampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $brg = new Modelbarang();
            $data = [
                'tampildata' => $brg->findAll()
            ];
            $msg = [
                'data' => view('barang/databarang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('barang/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kode_barang' => [
                    'label' => 'Kode_barang',
                    'rules' => 'required|is_unique[handphone.kode_barang]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada'
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'merk' => [
                    'label' => 'merk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'warna' => [
                    'label' => 'warna',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
              
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kode_barang' => $validation->getError('kode_barang'),
                        'nama' => $validation->getError('nama'),
                        'merk' => $validation->getError('merk'),
                        'warna' => $validation->getError('warna'),
                        
                    ]
                ];
            }else{
                $simpandata = [
                    'kode_barang' => $this->request->getPost('kode_barang'),
                        'nama' => $this->request->getPost('nama'),
                        'merk' => $this-> request->getPost('merk'),
                        'warna' => $this-> request->getPost('warna'),
                ];
                $brg = new Modelbarang;
                $brg->insert($simpandata);
            
           
                $msg = [
                    'sukses' => 'Data barang berhasil disimpan'
                ];
            }
                echo json_encode($msg);
            
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function formedit(){
        if ($this->request->isAJAX()){
            $id_barang =$this->request->getVar('id_barang');

            $brg = new Modelbarang;
            // var_dump($brg);
            // exit;
            // $row = $brg->where('id_barang', $id_barang)->findAll();
            // $row = $brg->find($id_barang);
            // var_dump($row);
            // exit;
            $data =[
                'row' => $brg->where('id_barang', $id_barang)->findAll(),
            ];

            $msg = [
                'sukses' =>view('barang/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()){
            $simpandata = [
                'kode_barang' => $this->request->getPost('kode_barang'),
                    'nama' => $this->request->getPost('nama'),
                    'merk' => $this-> request->getPost('merk'),
                    'warna' => $this-> request->getPost('warna'),
            ];
            $brg = new Modelbarang;
            $id_barang = $this->request->getVar('id_barang');
            $brg->update($id_barang, $simpandata);

            $msg = [
                'sukses' => 'Data berhasil diupdate'
            ];
            echo json_encode($msg);
        }else{
            exit('maaf tidak dapat di proses');
        }
    }
    public function hapus(){
        if($this->request->isAJAX()){
            $id_barang =$this->request->getVar('id_barang');
            $brg =new Modelbarang;

            $brg->delete($id_barang);


            $msg =[
                'sukses' => "barang dihapus"
            ];
            echo json_encode($msg);
        }
    }
}
        


    