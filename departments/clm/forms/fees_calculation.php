<?php 

$reg_fees=$clm->query("select fees from payment_details where form_no='$form'")->fetch_object()->fees;
?>