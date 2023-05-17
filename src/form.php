<?php

$fields = array(
  "live" => "0",
  "oid" => "112",
  "inv" => "112020102292999",
  "ttl" => "900",
  "tel" => "256712375678",
  "eml" => "kajuej@gmailo.com",
  "vid" => "realhub",
  "curr" => "KES",
  "p1" => "airtel",
  "p2" => "020102292999",
  "p3" => "",
  "p4" => "900",
  "cbk" => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
  "cst" => "1",
  "crl" => "2"
);

$datastring =  $fields['live'] . $fields['oid'] . $fields['inv'] . $fields['ttl'] . $fields['tel'] . $fields['eml'] . $fields['vid'] . $fields['curr'] . $fields['p1'] . $fields['p2'] . $fields['p3'] . $fields['p4'] . $fields['cbk'] . $fields['cst'] . $fields['crl'];
$hashkey = "n&v?aT#mxj8dKXgEeV5%Rx#@j@9APqg7";

$generated_hash = hash_hmac('sha1', $datastring, $hashkey);

?>

<form action="https://payments.ipayafrica.com/v3/ke">
  <?php
  foreach ($fields as $key => $value) {
    echo $key;
    echo '<input name="' . $key . '" type="text" value="' . $value . '"></br>';
  }
  ?>

  <input name="hsh" type="text" value="<?php echo $generated_hash ?>">
  <button type="submit"> Lipa </button>

</form>