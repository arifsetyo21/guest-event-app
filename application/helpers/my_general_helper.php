<?php

function qr_code_config($eventsTamuId = null)
{
    $config['config']['cacheable'] = true; //boolean, the default is true
    $config['config']['cachedir'] = './assets/'; //string, the default is application/cache/
    $config['config']['errorlog'] = './assets/'; //string, the default is application/logs/
    $config['config']['imagedir'] = './assets/images/'; //direktori penyimpanan qr code
    $config['config']['quality'] = true; //boolean, the default is true
    $config['config']['size'] = '1024'; //interger, the default is 1024
    $config['config']['black'] = array(224, 255, 255); // array, default is array(255,255,255)
    $config['config']['white'] = array(70, 130, 180); // array, default is array(0,0,0)

    $config['params']['data'] = base_url('index.php/event/confirmAttended/' . $eventsTamuId); //data yang akan di jadikan QR CODE
    $config['params']['level'] = 'H'; //H=High
    $config['params']['size'] = 10;
    $config['params']['savename'] = FCPATH . $config['config']['imagedir'] . $eventsTamuId . '.png'; //simpan image QR CODE ke folder assets/images/

    return $config;
}

function any_in_array($needle, $haystack)
{
    $needle = is_array($needle) ? $needle : array($needle);

    foreach ($needle as $item) {
        if (in_array($item, $haystack)) {
            return true;
        }
    }

    return false;
}

// random_element() is included in Array Helper, so it overrides the native function
function random_element($array)
{
    shuffle($array);
    return array_pop($array);
}
