<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: c7df07c128d321b7765c604c1c1ee670"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $response = json_decode($response);
    // print_r($response)
    $provinsi =  $response->rajaongkir->results;
}
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

provinsi:
<select id="province">
    <option value="">-Pilih Provinsi-</option>
    <?php foreach ($provinsi as $p) : ?>
        <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
    <?php endforeach ?>
</select>

<hr />

kota:
<select>
</select>

<script>
    $('#province').on('change', function() {
        var province_id = this.value;
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8080/api/city.php',
            data: {
                'province': province_id,
            },
            dataType: 'json',
            success: function(response) {
                // alert(response);
                console.log(response);
            }
        });
    });
</script>