#============================================================
#   Delete Index, Create Index, Update Mapping && Run Import on Questions
#============================================================
php artisan elastic:drop-index "\Modules\Question\ElasticSearch\QuestionIndexConfigurator" || echo "NOT Found" &&
php artisan elastic:create-index "\Modules\Question\ElasticSearch\QuestionIndexConfigurator" &&
php artisan elastic:update-mapping "Modules\Question\Entities\Question\QuestionSetter" &&
php artisan scout:import "Modules\\Question\\Entities\\Question\\QuestionSetter" -v