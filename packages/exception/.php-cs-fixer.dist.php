<?php

return \Ssc\Cs\ConfigBuilder::forPath(__DIR__)
    ->withLicenseHeader(\Ssc\Cs\Factory\LicenseHeader::forPackage(
        name: 'ssc/lib',
        owners: [[
            'name' => 'Loïc Faugeron',
            'email' => 'faugeron.loic@gmail.com',
        ]],
    ))
    ->build()
;
