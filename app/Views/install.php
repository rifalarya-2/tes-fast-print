<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install aplikasi - Tes Fast Print</title>
</head>

<style>
    body {
        display: flex;
        align-items: center;
        height: 100vh;
        justify-content: center;
        text-align: center;
    }

    .btn {
        background: #5E5DF0;
        border-radius: 999px;
        box-shadow: #5E5DF0 0 10px 20px -10px;
        box-sizing: border-box;
        color: #FFFFFF;
        cursor: pointer;
        font-family: Inter, Helvetica, "Apple Color Emoji", "Segoe UI Emoji", NotoColorEmoji, "Noto Color Emoji", "Segoe UI Symbol", "Android Emoji", EmojiSymbols, -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", sans-serif;
        font-size: 16px;
        font-weight: 700;
        line-height: 24px;
        opacity: 1;
        outline: 0 solid transparent;
        padding: 8px 18px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        width: fit-content;
        word-break: break-word;
        border: 0;
    }
</style>

<body>
    <main>
        <h1>Menginstall aplikasi</h1>

        <p style="color: red;">Note: Ketika Anda meng-klik tombol install, aplikasi akan membuat tabel baru di database dengan nama "produk".</p><br>

        <form action="<?= base_url('install/install') ?>">
            <button type="submit" class="btn">Install</button>
        </form>
    </main>

    <script>
        (function() {
            <?php if (session()->get('failed')) { ?>
                alert('<?= session()->get('failed') ?>');
            <?php } ?>
        })()
    </script>
</body>

</html>