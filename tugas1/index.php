<!DOCTYPE html>
<html>
<head>
    <title>Caesar Cipher Encryption/Decryption</title>
    <link rel="stylesheet" href="edit3.css">
</head>
<body>
    <h1>Caesar Cipher Encryption/Decryption</h1>
    <?php
    function caesar_encrypt($plaintext, $shift) {
        $ciphertext = "";

        for ($i = 0; $i < strlen($plaintext); $i++) {
            $char = $plaintext[$i];
            if (ctype_alpha($char)) { // Pastikan hanya karakter alfabet yang dienkripsi
                $isUpperCase = ctype_upper($char);
                $char = strtolower($char);
                $charCode = ord($char);
                $shiftedChar = chr((($charCode - ord('a') + $shift) % 26) + ord('a'));
                if ($isUpperCase) {
                    $shiftedChar = strtoupper($shiftedChar);
                }
                $ciphertext .= $shiftedChar;
            } else {
                $ciphertext .= $char; // Biarkan karakter selain alfabet tetap seperti adanya
            }
        }

        return $ciphertext;
    }

    function caesar_decrypt($ciphertext, $shift) {
        $plaintext = "";

        for ($i = 0; $i < strlen($ciphertext); $i++) {
            $char = $ciphertext[$i];
            if (ctype_alpha($char)) {
                $isUpperCase = ctype_upper($char);
                $char = strtolower($char);
                $charCode = ord($char);
                $shiftedChar = chr(((($charCode - ord('a') - $shift) + 26) % 26) + ord('a'));
                if ($isUpperCase) {
                    $shiftedChar = strtoupper($shiftedChar);
                }
                $plaintext .= $shiftedChar;
            } else {
                $plaintext .= $char;
            }
        }

        return $plaintext;
    }

    // Form untuk menginputkan teks
    echo '<form method="post" action="">';
    echo '<label for="text">Plaintext:</label>';
    echo '<textarea id="text" name="text" rows="4" cols="50">' . (isset($_POST['text']) ? $_POST['text'] : '') . '</textarea><br>';
    echo '<input type="submit" name="encrypt" value="Encrypt">';
    echo '<input type="submit" name="decrypt" value="Decrypt">';
    echo '</form>';

    // Proses enkripsi dan dekripsi
    if (isset($_POST['encrypt'])) {
        $plaintext = $_POST['text'];
        $shift = 10; // Tetapkan shift ke 10
        $ciphertext = caesar_encrypt($plaintext, $shift);
        echo '<label>Ciphertext:</label>';
        echo '<textarea rows="4" cols="50">' . $ciphertext . '</textarea>';
    } elseif (isset($_POST['decrypt'])) {
        $ciphertext = $_POST['text'];
        $shift = 10; // Tetapkan shift ke 10
        $plaintext = caesar_decrypt($ciphertext, $shift);
        echo '<label>Decrypted Text:</label>';
        echo '<textarea rows="4" cols="50">' . $plaintext . '</textarea>';
    }
    ?>

</body>
</html>
