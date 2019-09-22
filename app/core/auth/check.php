<?php
declare(strict_types=1);

require_once VENDOR_PATH.'autoload.php';


/* 
	Authorization checkin
*/
function check_auth() {
	$headers = \SimpleRest\libs\Factory::request()->headers();
	$auth = $headers['Authorization'] ?? $headers['authorization'] ?? null;
	
	if (empty($auth)){
		\SimpleRest\libs\Factory::response()->sendError('Authorization not found',400);
	}
		
	list($jwt) = sscanf($auth, 'Bearer %s');

	if($jwt)
	{
		try{
			// Checking for token invalidation or outdated token
			$config =  include 'config/config.php';
			
			$data = Firebase\JWT\JWT::decode($jwt, $config['jwt_secret_key'], [ $config['encryption'] ]);
			
			if (empty($data))
				\SimpleRest\libs\Factory::response()->sendError('Unauthorized',401);
			
			if ($data->exp<time())
				\SimpleRest\libs\Factory::response()->sendError('Token expired',401);
				
		} catch (Exception $e) {
			/*
			 * the token was not able to be decoded.
			 * this is likely because the signature was not able to be verified (tampered token)
			 *
			 * reach this point if token is empty or invalid
			 */
			\SimpleRest\libs\Factory::response()->sendError('Unauthorized',401);
		}	
	}else{
		\SimpleRest\libs\Factory::response()->sendError('Authorization not found',400);
	}
}