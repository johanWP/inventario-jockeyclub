@include('emails.template',
    [
        'introLines' => [
        'Usted está recibiendo este mensaje como una notificación de que una notebook ha cambiado de almacén.',
        '<strong>Serial del equipo</strong>: ' . $asset->serial_fabricante,
        '<strong>Serial interno</strong>: ' . $asset->serial,
        '<strong>Marca</strong>: ' . $asset->marca,
        '<strong>Modelo</strong>: ' . $asset->modelo,
        '<strong>Fecha de Compra</strong>: ' . $asset->fecha_compra,
        '<strong>Responsable actual</strong>: ' . $asset->owner->fullName
        ],
        'outroLines' => [
        'Si tiene dudas sobre este movimiento, consulte el <a href="'.  url('/')  .'">sistema de inventario</a> o
        comuníquese con el área de Sistemas.'
        ],
        'level' => ''

    ]);