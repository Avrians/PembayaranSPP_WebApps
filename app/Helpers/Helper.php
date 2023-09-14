<?php

function formatRupiah($nominal, $prefix = null)
{
    if ($prefix) {
        return $prefix . ' ' . number_format($nominal, 0, ',', '.');
    }
    return 'Rp. ' . number_format($nominal, 0, ',', '.');
}
