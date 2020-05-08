<?php


namespace OCA\Quest\Controller;

use OCP\AppFramework\Http\JSONResponse;
use OCP\IRequest;
use OCP\AppFramework\ApiController;
use OCP\ISearch;

class QuestApiV1Controller extends ApiController {

	/** @var ISearch */
	private $searcher;

	public function __construct($AppName, IRequest $request, ISearch $search){
		parent::__construct($AppName, $request);

		$this->searcher = $search;
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $q the query string
	 * @param int $page the page offset
	 * @param int $limit the limit of result
	 * @return JSONResponse
	 */
	public function search(string $q, int $page = 1, int $limit = 30): JSONResponse {
		$results = $this->searcher->searchPaged($q, ['files'], $page, $limit);

		return new JSONResponse($results);
	}

}
