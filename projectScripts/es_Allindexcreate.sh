# !bin/bash

#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on Products
#============================================================
# php artisan elastic:drop-index "\App\ElasticSearch\Product\ProductIndexConfigurator" &&
# php artisan elastic:create-index "\App\ElasticSearch\Product\ProductIndexConfigurator" &&
# php artisan elastic:update-mapping "\App\Models\Product\Products" &&
# php artisan scout:import "App\\Models\\Product\\Products" -v

#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on Products
#============================================================

# php artisan elastic:drop-index "\App\ElasticSearch\Product\ProductPricingIndexConfigurator" &&
# php artisan elastic:create-index "\App\ElasticSearch\Product\ProductPricingIndexConfigurator" &&
# php artisan elastic:update-mapping "\App\Models\Product\ProductPricing" &&
# php artisan scout:import "App\\Models\\Product\\ProductPricing" -v

#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on Product HS Code
#============================================================
# php artisan elastic:drop-index "\App\ElasticSearch\Product\ProductHsCodeIndexConfigurator" &&
php artisan elastic:create-index "\App\ElasticSearch\Product\ProductHsCodeIndexConfigurator" &&
php artisan elastic:update-mapping "\App\Models\Product\ProductHsCode" &&
php artisan scout:import "App\\Models\\Product\\ProductHsCode" -v

#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on CMDT Code
#============================================================
# php artisan elastic:drop-index "\App\ElasticSearch\Volume\CmdtCodeIndexConfigurator" &&
php artisan elastic:create-index "\App\ElasticSearch\Volume\CmdtCodeIndexConfigurator" &&
php artisan elastic:update-mapping "\App\Models\VolumeModule\CmdtCode" &&
php artisan scout:import "App\\Models\\VolumeModule\\CmdtCode" -v
#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on VolumeCompany
#============================================================

# php artisan elastic:drop-index "\App\ElasticSearch\Volume\VolumeCompanyIndexConfigurator" &&
php artisan elastic:create-index "\App\ElasticSearch\Volume\VolumeCompanyIndexConfigurator" &&
php artisan elastic:update-mapping "\App\Models\VolumeModule\VolumeCompany" &&
php artisan scout:import "App\\Models\\VolumeModule\\VolumeCompany" -v





#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on ShipmentHistory
#============================================================

# php artisan elastic:drop-index "\App\ElasticSearch\Volume\ShipmentIndexConfigurator" &&
php artisan elastic:create-index "\App\ElasticSearch\Volume\ShipmentIndexConfigurator" &&
php artisan elastic:update-mapping "\App\Models\VolumeModule\ShipmentHistory" &&
php artisan scout:import "App\\Models\\VolumeModule\\ShipmentHistory" -v




