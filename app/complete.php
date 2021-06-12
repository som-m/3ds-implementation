<?php

$search = OmiseCharge::search($order_id);

$charge_id = $search['data'][0]['id'];

$charge = OmiseCharge::retrieve($charge_id);
// to do: record final status in status.txt

header('Location: /../' . $charge['id'] . '/status');
