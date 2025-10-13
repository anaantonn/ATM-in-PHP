<?php
declare(strict_types=1);

function is_input_empty(array $fields) {
    foreach ($fields as $field) {
        if (empty($field)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function is_email_invalid($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_email_registered($pdo, $email) {
    if (get_email($pdo, $email)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_telefon_registered($pdo, $telefon) {
    if (get_telefon($pdo, $telefon)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_cnp_registered($pdo, $cnp) {
    if (get_cnp($pdo, $cnp)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function create_user($pdo, array $fields) {
    set_user($pdo, $fields);
}
