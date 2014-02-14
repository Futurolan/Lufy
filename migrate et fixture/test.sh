php symfony doctrine:build --all --no-confirmation;
php symfony lufy:validate-slots > test.1;

php symfony doctrine:build --all --no-confirmation;
mysql -u ga_prod -pga_prod -Dga_prod -e"select * from team;" >> test.2;
php symfony lufy:validate-slots --execute >> test.2;
mysql -u ga_prod -pga_prod -Dga_prod -e"select * from team;" >> test.2;


php symfony doctrine:build --all --and-load --no-confirmation;
php symfony lufy:validate-slots > test.3;

php symfony doctrine:build --all --and-load --no-confirmation;
mysql -u ga_prod -pga_prod -Dga_prod -e"select * from team;" >> test.4;
php symfony lufy:validate-slots --execute > test.4;
mysql -u ga_prod -pga_prod-D -Dga_prod -e"select * from team;" >> test.4;


php symfony doctrine:build --all --and-load --no-confirmation;
mysql -u ga_prod -pga_prod -Dga_prod < ./donnewezevent.sql;
php symfony lufy:validate-slots > test.5;

php symfony doctrine:build --all --and-load --no-confirmation;
mysql -u ga_prod -pga_prod ga_prod < ./donnewezevent.sql;
mysql -u ga_prod -pga_prod -Dga_prod -e"select * from team;" >> test.6;
php symfony lufy:validate-slots --execute > test.6;
mysql -u ga_prod -pga_prod -Dga_prod -e"select * from team;" >> test.6;

php symfony lufy:validate-slots > test.7;
