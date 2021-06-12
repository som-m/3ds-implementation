<?php

$charge_id = $_POST['charge'];

$charge = OmiseCharge::retrieve($charge_id);

header('Location: /../' . $charge['id'] . '/type=' . $charge['description'] . '&status=' . $charge['status']);
