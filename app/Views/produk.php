<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home - Tes Fast Print</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <!-- STYLES -->
    <style>
        :root {
            --primary-color: #001E6C;
            --secondary-color: #035397;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
        }

        header {
            display: flex;
            justify-content: center;
            margin-top: 2%;
            margin-bottom: 2%;
        }

        form {
            display: flex;
        }

        .input {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin: 5px 5px 10px 10px;
        }

        .input>label {
            display: block;
            width: 100%;
            text-align: left;
        }

        .input>input {
            padding: .2rem .5rem;
        }

        button {
            appearance: button;
            background-color: var(--primary-color);
            border-radius: 8px;
            border-style: none;
            box-shadow: rgba(255, 255, 255, 0.26) 0 1px 2px inset;
            cursor: pointer;
            font-size: 100%;
            line-height: 1.15;
            padding: 10px 21px;
            text-align: center;
            box-shadow: .13s ease-in-out;
            color: white;
        }

        #tambahkanBarang {
            text-decoration: navajowhite;
            color: white;
        }

        main>h1 {
            display: block;
            text-align: center;
            padding-top: 2%;
        }

        table {
            width: 80%;
            margin: auto;
            padding-top: 1rem;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        table>thead {
            font-weight: 600;
        }

        @media only screen and (max-width: 768px) {

            form {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header>
        <form action="<?= base_url('tambah') ?>" method="POST">
            <div class="input">
                <label for="kategori">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="<?= old('nama_produk') ?>" required>
            </div>
            <div class="input">
                <label for="kategori">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= old('harga') ?>" required>
            </div>
            <div class="input">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" value="<?= old('kategori') ?>" required>
            </div>
            <div class="input">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" value="<?= old('status') ?>" required>
            </div>
            <button type="submit">Tambahkan barang</button>
        </form>
        <button style="display: none;"><a href="">Tambahkan produk</a></button>
    </header>
    <main>
        <h1>Daftar barang yang bisa dijual</h1>
        <div style="overflow: auto;">
            <table>
                <thead>
                    <tr>
                        <td>Nama Produk</td>
                        <td>Harga</td>
                        <td>Kategori</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allProduk as $produk) { ?>
                        <tr>
                            <td><?= $produk['nama_produk'] ?></td>
                            <td><?= $produk['harga'] ?></td>
                            <td><?= $produk['kategori'] ?></td>
                            <td>
                                <p><a href="<?= base_url('edit') . '/' . $produk['id_produk'] ?>" style="color: var(--secondary-color);">Edit</a></p>
                                <p><a href="" class="hapusProduk" data-id-product="<?= $produk['id_produk'] ?>" style="color: var(--secondary-color);">Hapus</a></p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        (function() {
            <?php if (session()->get('validation_error') !== null) { ?>
                <?php foreach (session()->get('validation_error') as $error) { ?>
                    alert('<?= $error ?>');
                <?php } ?>
            <?php } ?>

            <?php if (session()->get('success')) { ?>
                alert('<?= session()->get('success') ?>');
            <?php } ?>

            <?php if (session()->get('error')) { ?>
                alert('<?= session()->get('error') ?>');
            <?php } ?>
        })()
    </script>
    <script>
        const hapusProdukBtn = document.querySelectorAll('.hapusProduk');
        // if (hapusProdukBtn !== null) {
        for (elemen of hapusProdukBtn) {
            elemen.addEventListener('click', (e) => {
                e.preventDefault();

                if (confirm('Anda yakin ingin menghapus data ini?')) {

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            location.reload();
                        }
                    }

                    xhr.open("GET", location.origin + '/hapus/' + e.target.dataset.idProduct, true);
                    xhr.send();
                }
            })
        }
    </script>

</body>

</html>