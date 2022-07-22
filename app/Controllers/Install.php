<?php

namespace App\Controllers;

class Install extends BaseController
{
    public function __construct()
    {
        try {
            $jumlahData = count(db_connect()->query("SELECT id_produk FROM produk")->getResult());
            if ($jumlahData > 0) {
                header('Location: ' . base_url());
                exit();
            }
        } catch (\Throwable $th) {
        }

        $this->produkModel = new \App\Models\ProdukModel();
    }

    public function index()
    {
        return view('install');
    }

    public function install()
    {
        $forge = \Config\Database::forge();

        $namaTabel = 'produk';
        $fields = [
            'id_produk' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'auto_increment' => true
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'harga' => [
                'type'       => 'VARCHAR',
                'constraint' => 10
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 17
            ],
        ];

        $forge->addField($fields);
        $forge->addKey('id_produk', true);

        try {
            $forge->createTable($namaTabel);
        } catch (\Throwable $th) {
            return redirect()->to(base_url('install'))->with('failed', 'Gagal menginstall aplikasi. Nama tabel sudah ada');
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $_ENV['LINK_API'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'username' => $_ENV['USERNAME'],
                'password' => $_ENV['PASSWORD']
            ]
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        if ($result->data ?? null !== null) {
            foreach ($result->data as $value) {
                $data = [
                    'id_produk' => $value->id_produk,
                    'nama_produk' => $value->nama_produk,
                    'harga' => $value->harga,
                    'kategori' => $value->kategori,
                    'status' => $value->status
                ];

                $this->produkModel->insert($data);
            }

            return redirect()->to(base_url());
        } else {
            $forge->dropTable($namaTabel);

            try {
                echo $result->error;
            } catch (\Throwable $th) {
                return redirect()->to(base_url('install'))->with('failed', 'Gagal menginstall aplikasi. pastikan link api valid');
            }

            return redirect()->to(base_url('install'))->with('failed','Gagal menginstall aplikasi. username dan password tidak valid');
        }
    }

}
