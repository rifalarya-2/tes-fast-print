<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    public function __construct()
    {
        try {
            $jumlahData = count(db_connect()->query("SELECT id_produk FROM produk")->getResult());
            if ($jumlahData === 0) {
                header('Location: ' . base_url('install'));
                exit();
            }
        } catch (\Throwable $th) {
            header('Location: ' . base_url('install'));
            exit();
        }

        $this->produkModel = new produkModel();
    }

    public function index()
    {
        $data = [
            'allProduk' => $this->produkModel->where('status', 'bisa dijual')->findAll()
        ];
        return view('produk', $data);
    }

    public function tambah()
    {
        $check = $this->validate([
            'nama_produk' => 'required|max_length[100]',
            'harga' => 'required|integer|max_length[10]',
            'kategori' => 'required|max_length[30]',
            'status' => 'required|max_length[17]'
        ]);

        if (!$check) {
            return redirect()->to(base_url())->with('validation_error', $this->validate->getErrors())->withInput();
        } else {

            $data = [
                'nama_produk' => $this->input->getPost('nama_produk'),
                'harga' => $this->input->getPost('harga'),
                'kategori' => $this->input->getPost('kategori'),
                'status' => $this->input->getPost('status')
            ];

            if ($this->produkModel->insert($data)) {
                return redirect()->to(base_url())->with('success', 'Berhasil menambah produk');
            } else {
                return redirect()->to(base_url())->with('error', 'Gagal menambah produk');
            }
        }
    }

    public function edit($id)
    {
        if($this->request->getMethod() === 'get'){
            $data = [
                'row' => $this->produkModel->find(intval($id))
            ];
            return view('edit', $data);
        }
        if($this->request->getMethod() === 'post'){
            $check = $this->validate([
                'nama_produk' => 'required|max_length[100]',
                'harga' => 'required|integer|max_length[10]',
                'kategori' => 'required|max_length[30]',
                'status' => 'required|max_length[17]'
            ]);

            if (!$check) {
                return redirect()->to(base_url('edit') . '/' . $this->input->getPost('id_produk'))->with('validation_error', $this->validate->getErrors())->withInput();
            } else {
                $data = [
                    'id_produk' => $this->input->getPost('id_produk'),
                    'nama_produk' => $this->input->getPost('nama_produk'),
                    'harga' => $this->input->getPost('harga'),
                    'kategori' => $this->input->getPost('kategori'),
                    'status' => $this->input->getPost('status')
                ];

                if ($this->produkModel->save($data)) {
                    return redirect()->to(base_url())->with('success', 'Berhasil mengedit produk');
                } else {
                    return redirect()->to(base_url())->with('error', 'Gagal mengedit produk');
                }
            }
        }
    }

    public function hapus($id)
    {
        if ($this->produkModel->delete(intval($id))) {
            return session()->setFlashdata('success', 'Berhasil menghapus produk');
        } else {
            return session()->setFlashdata('error', 'Gagal menghapus produk');
        }
    }
}
