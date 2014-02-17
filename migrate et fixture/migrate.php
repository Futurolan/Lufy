<?php

// Script de migration Lufy 1.x -> Lufy 2.0
// Configuration
$config = array(
    'db' => array(
        'prod' => array(
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'name' => 'ga_prod'
        ),
        'dev' => array(
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'name' => 'ga_dev'
        )
    )
);

$db_prod = mysql_connect($config['db']['prod']['host'], $config['db']['prod']['login'], $config['db']['prod']['password']);
mysql_select_db($config['db']['prod']['name']);

$db_dev = mysql_connect($config['db']['dev']['host'], $config['db']['dev']['login'], $config['db']['dev']['password']);
mysql_select_db($config['db']['dev']['name']);


$migrate = array(
    //===========================================
    00 => array(
        'from' => array(
            'table' => 'sf_guard_user',
            'fields' => array(
                'id',
                'first_name',
                'last_name',
                'email_address',
                'username',
                'algorithm',
                'salt',
                'password',
                'is_active',
                'is_super_admin',
                'last_login',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_user',
            'fields' => array(
                'id',
                'first_name',
                'last_name',
                'email_address',
                'username',
                'algorithm',
                'salt',
                'password',
                'is_active',
                'is_super_admin',
                'last_login',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    01 => array(
        'from' => array(
            'table' => 'tshirt',
            'fields' => array(
                'user_id',
                'size',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_user_tshirt',
            'fields' => array(
                'user_id',
                'size',
            ),
        ),
    ),
    02 => array(
        'from' => array(
            'table' => 'sf_guard_user_permission',
            'fields' => array(
                'user_id',
                'permission_id',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_user_permission',
            'fields' => array(
                'user_id',
                'permission_id',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    //================ adresse =====================
    03 => array(
        'from' => array(
            'table' => 'sf_guard_user',
            'fields' => array(
                'username',
                'address',
                'zipcode',
                'city',
                'country',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_user_address',
            'fields' => array(
                'name',
                'address',
                'zipcode',
                'city',
                'country',
            ),
        ),
    ),
    //=====================================
    04 => array(
        'from' => array(
            'table' => 'sf_guard_permission',
            'fields' => array(
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_permission',
            'fields' => array(
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    05 => array(
        'from' => array(
            'table' => 'sf_guard_group_permission',
            'fields' => array(
                'group_id',
                'permission_id',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_group_permission',
            'fields' => array(
                'group_id',
                'permission_id',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    06 => array(
        'from' => array(
            'table' => 'sf_guard_group',
            'fields' => array(
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'sf_guard_group',
            'fields' => array(
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    07 => array(
        'from' => array(
            'table' => 'var_config',
            'fields' => array(
                'id_var',
                'name',
                'value',
                'description',
            ),
        ),
        'to' => array(
            'table' => 'var_config',
            'fields' => array(
                'id_var',
                'name',
                'value',
                'description',
            ),
        ),
    ),
    /* 89 => array(
      'from' => array(
      'table' => '',
      'fields' => array(
      ),
      ),
      'to' => array(
      'table' => '',
      'fields' => array(
      ),
      ),
      ), */
    08 => array(
        'from' => array(
            'table' => 'newsletter',
            'fields' => array(
                'id_newsletter',
                'recipient',
                'subject',
                'content',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'newsletter',
            'fields' => array(
                'id_newsletter',
                'recipient',
                'subject',
                'content',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    09 => array(
        'from' => array(
            'table' => 'mail',
            'fields' => array(
                'id_mail',
                'name',
                'description',
                'email',
                'subject',
                'content',
                'created_at',
                'updated_at',
            ),
        ),
        'to' => array(
            'table' => 'mail',
            'fields' => array(
                'id_mail',
                'name',
                'description',
                'email',
                'subject',
                'content',
                'created_at',
                'updated_at',
            ),
        ),
    ),
    10 => array(
        'from' => array(
            'table' => 'gallery',
            'fields' => array(
                'id_gallery',
                'title',
                'album_id',
                'description',
                'position',
                'status',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'gallery',
            'fields' => array(
                'id_gallery',
                'title',
                'album_id',
                'description',
                'position',
                'status',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
    ),
    11 => array(
        'from' => array(
            'table' => 'friend',
            'fields' => array(
                'id_friend',
                'user_id',
                'friend_id',
            ),
        ),
        'to' => array(
            'table' => 'friend',
            'fields' => array(
                'id_friend',
                'user_id',
                'friend_id',
            ),
        ),
    ),
    12 => array(
        'from' => array(
            'table' => 'file_type',
            'fields' => array(
                'id_file_type',
                'name',
                'description',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'file_type',
            'fields' => array(
                'id_file_type',
                'name',
                'description',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
    ),
    13 => array(
        'from' => array(
            'table' => 'file_category',
            'fields' => array(
                'id_file_category',
                'name',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'file_category',
            'fields' => array(
                'id_file_category',
                'name',
                'description',
                'created_at',
                'updated_at',
                'slug',),
        ),
    ),
    14 => array(
        'from' => array(
            'table' => 'file',
            'fields' => array(
                'id_file',
                'name',
                'file',
                'description',
                'file_type_id',
                'file_category_id',
                'position',
                'status',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'file',
            'fields' => array(
                'id_file',
                'name',
                'file',
                'description',
                'file_type_id',
                'file_category_id',
                'position',
                'status',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
    ),
    15 => array(
        'from' => array(
            'table' => 'faq',
            'fields' => array(
                'id_faq',
                'request',
                'answer',
                'status',
                'position',
            ),
        ),
        'to' => array(
            'table' => 'faq',
            'fields' => array(
                'id_faq',
                'request',
                'answer',
                'status',
                'position',
            ),
        ),
    ),
    16 => array(
        'from' => array(
            'table' => 'block',
            'fields' => array(
                'id_block',
                'title',
                'content',
                'image',
                'link',
                'position',
                'is_active',
            ),
        ),
        'to' => array(
            'table' => 'block',
            'fields' => array(
                'id_block',
                'title',
                'content',
                'image',
                'link',
                'position',
                'is_active',
            ),
        ),
    ),
    17 => array(
        'from' => array(
            'table' => 'news_type',
            'fields' => array(
                'id_news_type',
                'label',
                'description',
                'logourl',
                'is_special',
            ),
        ),
        'to' => array(
            'table' => 'news_type',
            'fields' => array(
                'id_news_type',
                'label',
                'description',
                'logourl',
                'is_special',
            ),
        ),
    ),
    18 => array(
        'from' => array(
            'table' => 'news',
            'fields' => array(
                'id_news',
                'user_id',
                'title',
                'summary',
                'content',
                'status',
                'publish_on',
                'image',
                'news_type_id',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'news',
            'fields' => array(
                'id_news',
                'user_id',
                'title',
                'summary',
                'content',
                'status',
                'publish_on',
                'image',
                'news_type_id',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
    ),
    19 => array(
        'from' => array(
            'table' => 'page_type',
            'fields' => array(
                'id_page_type',
                'label',
                'description',
            ),
        ),
        'to' => array(
            'table' => 'page_type',
            'fields' => array(
                'id_page_type',
                'label',
                'description',
            ),
        ),
    ),
    20 => array(
        'from' => array(
            'table' => 'page',
            'fields' => array(
                'id_page',
                'title',
                'content',
                'status',
                'publish_on',
                'page_type_id',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'page',
            'fields' => array(
                'id_page',
                'title',
                'content',
                'status',
                'publish_on',
                'page_type_id',
                'created_at',
                'updated_at',
                'slug',
            ),
        ),
    ),
    21 => array(
        'from' => array(
            'table' => 'partner_type',
            'fields' => array(
                'id_partner_type',
                'name',
                'description',
                'status',
                'position',
            ),
        ),
        'to' => array(
            'table' => 'partner_type',
            'fields' => array(
                'id_partner_type',
                'name',
                'description',
                'status',
                'position',
            ),
        ),
    ),
    22 => array(
        'from' => array(
            'table' => 'partner',
            'fields' => array(
                'id_partner',
                'name',
                'description',
                'logourl',
                'website',
                'status',
                'position',
                'partner_type_id',
            ),
        ),
        'to' => array(
            'table' => 'partner',
            'fields' => array(
                'id_partner',
                'name',
                'description',
                'logourl',
                'website',
                'status',
                'position',
                'partner_type_id',
            ),
        ),
    ),
//===========================================    
    23 => array(
        'from' => array(
            'table' => 'plateform',
            'fields' => array(
                'id_plateform',
                'name',
                'tag',
                'constructor',
            ),
        ),
        'to' => array(
            'table' => 'plateform',
            'fields' => array(
                'id_plateform',
                'name',
                'tag',
                'constructor',
            ),
        ),
    ),
    24 => array(
        'from' => array(
            'table' => 'game_type',
            'fields' => array(
                'id_game_type',
                'label',
            ),
        ),
        'to' => array(
            'table' => 'game_type',
            'fields' => array(
                'id_game_type',
                'label',
            ),
        ),
    ),
    25 => array(
        'from' => array(
            'table' => 'game',
            'fields' => array(
                'id_game',
                'game_type_id',
                'plateform_id',
                'label',
                'editor',
                'year',
                'description',
                'logourl',
            ),
        ),
        'to' => array(
            'table' => 'game',
            'fields' => array(
                'id_game',
                'game_type_id',
                'plateform_id',
                'label',
                'editor',
                'year',
                'description',
                'logourl',
            ),
        ),
    ),
    26 => array(
        'from' => array(
            'table' => 'event',
            'fields' => array(
                'id_event',
                'null',
                'name',
                'description',
                'image',
                'start_at',
                'end_at',
                'null',
                'null',
                'start_registration_at',
                'end_registration_at',
                'slug',
            ),
        ),
        'to' => array(
            'table' => 'event',
            'fields' => array(
                'id_event',
                '',
                'name',
                'description',
                'image',
                'start_at',
                'end_at',
                '',
                '',
                'start_registration_at',
                'end_registration_at',
                'slug',
            ),
        ),
    ),
    27 => array(
        'from' => array(
            'table' => 'tournament',
            'fields' => array(
                'id_tournament',
                'game_id',
                'event_id',
                'null',
                'name',
                'number_team',
                'player_per_team',
                'cost_per_player',
                'reserved_slot',
                'start_at',
                'end_at',
                'logourl',
                'description',
                'position',
                'is_active',
                'slug'
            ),
        ),
        'to' => array(
            'table' => 'tournament',
            'fields' => array(
                'id_tournament',
                'game_id',
                'event_id',
                '',
                'name',
                'number_team',
                'player_per_team',
                'cost_per_player',
                'reserved_slot',
                'start_at',
                'end_at',
                'logourl',
                'description',
                'position',
                'is_active',
                'slug'
            ),
        ),
    ),
    28 => array(
        'from' => array(
            'table' => 'tournament_admin',
            'fields' => array(
                'id_tournament_admin',
                'user_id',
                'tournament_id',
            ),
        ),
        'to' => array(
            'table' => 'tournament_admin',
            'fields' => array(
                'id_tournament_admin',
                'user_id',
                'tournament_id',
            ),
        ),
    ),
);

echo "\n";
echo '*****************************' . "\n";
echo '* Lancement de la migration *' . "\n";
echo '*****************************' . "\n\n";

foreach ($migrate as $step => $schema)
{
  $select_request = 'SELECT ';
  foreach ($schema['from']['fields'] as $field)
  {
    $select_request.= $field;
    $select_request.= ', ';
  }
  $select_request = substr($select_request, 0, -2) . ' ';
  $select_request.= 'FROM ';
  $select_request.= $config['db']['prod']['name'] . '.' . $schema['from']['table'];
  echo ' --Recuperation des enregistrements de la table ' . $schema['from']['table'] . "\n";
  echo $select_request . ';
' . "\n";

  $select_results = mysql_query($select_request, $db_prod);
  while ($row = mysql_fetch_array($select_results))
  {
    $update_request = 'INSERT INTO ';
    $update_request.= $config['db']['dev']['name'] . '.' . $schema['to']['table'];
    $update_request.= ' VALUES ( ';
    $i = 0;
    foreach ($schema['to']['fields'] as $field)
    {
      $update_request.= '"' . mysql_real_escape_string($row[$i]) . '", ';
      $i++;
    }
    $update_request = substr($update_request, 0, -2) . ' ';
    $update_request.= ');
';

    //DEBUG
    //echo "-- ".$update_request."\n";
    echo '.';
    mysql_query($update_request, $db_dev);
  }
  echo "\n" . ' --Les donnees de la table ' . $schema['from']['table'] . ' ont ete copiees vers ' . $schema['to']['table'] . "\n\n";
}
echo 'FIN.' . "\n\n";
?>
