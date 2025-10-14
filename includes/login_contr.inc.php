<?php

declare(strict_types=1);

function is_iban_wrong(bool|array $result) {
    if (!$result) {
        return TRUE;
    } else {
        return FALSE;
    }
}

// function is_pin_wrong($pin, $hashed_pin) {
//     if (!password_verify($pin, $hashed_pin)) {
//         return TRUE;
//     } else {
//         return FALSE;
//     }
// }

function is_input_empty($iban, $pin) {
    if (empty($iban) || empty(($pin))) {
        return TRUE;
    } else {
        return FALSE;
    }
}
