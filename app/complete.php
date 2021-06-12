<?php

$search = OmiseCharge::search($order_id);

$charge_id = $search['data'][0]['id'];

$charge = OmiseCharge::retrieve($charge_id);

header('Location: /../' . $charge['id'] . '/type=' . $charge['description'] . '&status=' . $charge['status']);
