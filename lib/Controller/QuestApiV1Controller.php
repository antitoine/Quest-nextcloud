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
	 * @param string[] $inApps optionally limit results to the given apps
	 * @param bool $computeHasMore optionally ask to compute if has more result
	 * @return JSONResponse
	 */
	public function search(string $q, int $page = 1, int $limit = 30, array $inApps = [], bool $computeHasMore = false): JSONResponse {
		$results = $this->searcher->searchPaged($q, $inApps, $page, $limit);
		$hasMore = null;
		if ($computeHasMore) {
			$resultForHasMore = $this->searcher->searchPaged($q, $inApps, $page + 1, $limit);
			$hasMore = count($resultForHasMore) > 0;
		}
		return new JSONResponse([
			'results' => $results,
			'length' => count($results),
			'has_more' => $hasMore,
		]);
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 */
	public function check(): JSONResponse {
		return new JSONResponse([
			'status' => 'ok',
		]);
	}
}
