<?php
$uri = service('uri');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Tes Fast Print</title>
</head>
<style>
    form {
        display: flex;
        justify-content: center;
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
        background-color: #001E6C;
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
</style>

<body>
    <main>
        <form action="<?= base_url('edit') . '/' . $uri->getSegment(2) ?>" method="POST">
            <div class="input">
                <input type="text" name="id_produk" id="id_produk" hidden value="<?= $row['id_produk'] ?>" required>
                <div class="input">
                    <label for="kategori">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="<?= $row['nama_produk'] ?>" required>
                </div>
                <div class="input">
                    <label for="kategori">Harga</label>
                    <input type="number" name="harga" id="harga" value="<?= $row['harga'] ?>" required>
                </div>
                <div class="input">
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" value="<?= $row['kategori'] ?>" required>
                </div>
                <div class="input">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" value="<?= $row['status'] ?>" required>
                </div>
                <button type="submit">Edit barang</button>
            </div>
        </form>
    </main>

    <script>
        (function() {
            <?php if (session()->get('validation_error') !== null) { ?>
                <?php foreach (session()->get('validation_error') as $error) { ?>
                    alert('<?= $error ?>');
                <?php } ?>
            <?php } ?>
        })()
    </script>
</body>

</html>