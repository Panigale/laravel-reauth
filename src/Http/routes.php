$router->get('auth/confirm', 'ReAuthController@getReauthenticate');
$router->post('auth/confirm', 'ReAuthController@postReauthenticate');
