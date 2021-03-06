<?php

/**
 * Class get information to service.
 *
 * @author juanfrasr
 */
class kpaxSrv {

    protected $url = "http://localhost:8080/webapps/svrKpax/";
    private $key;
    private $apiKey = "b2e6fc6abbc0ef1436eef51832babf753b304c9a"; // Public API key generated by elgg
    private $oauthKpax = null;

    public function __construct($userName = "admin") { //ha de ser kPAXadmin o admin per defecte???
        $this->oauthKpax = new kpaxOauth();
        $userName = str_replace("uoc.edu_", "", $userName); //Case UOC login
        $body = 'username=' . trim($userName . "&apikey=" . $this->apiKey);
        $_SESSION["campusSession"] = $this->service("user/sign/elgg", "POST", $body);
    }

    public function getKey() {
        return $this->key;
    }
    
    public function oauth($key,$secret){
        $this->oauthKpax->setKeySecret($key, $secret);
    }
        
    private function service($action, $type = "GET", $body = "", $header = "application/json") {
        $url = $this->oauthKpax->getSignature($type, $this->url . $action);
        $options = array('method' => $type,
            'header' => 'Content-type: ' . $header,
            'content' => $body);
        $type_post = array('http' => $options);
        $context = stream_context_create($type_post);

        return file_get_contents($url, false, $context);
    }

	/* Likes */
    public function addLikeGame($campusSession, $containerId, $productId) {
        $body = 'secretSession=' . $campusSession . '&containerId=' . $containerId;
        $this->service("game/like/" . $productId . "/add", "POST", $body);
    }

    public function delLikeGame($campusSession, $containerId, $productId) {
        $body = 'secretSession=' . $campusSession . '&containerId=' . $containerId;
        $this->service("game/like/" . $productId . "/del", "POST", $body);
    }

	public function getLikeGame($campusSession, $idEntity) {
        $objLike = json_decode($this->service("game/like/" . $campusSession . "/get/" . $idEntity));
        return $objLike;
    }
	
    public function getLikesGame($campusSession, &$entity) {
        $listLike = json_decode($this->service("game/like/" . $campusSession . "/list/" . $entity->getGuid()));
        return $listLike;
    }

	/* Score */
    public function getScore($gameUid) {
        return json_decode($objScore = $this->service("game/score/" . $gameUid . "/list"));
    }

	/* Games */
	//NOU - El·liminat
//    public function addGame($campusSession, $name, $idGame) {
//        $body = 'secretSession=' . $campusSession . '&name=' . $name . '&idGame=' . $idGame;
//        return $this->service("game/add", "POST", $body);
//    }

    public function addGame($campusSession, $name, $idGame, $idCategory, $dateCreation) {
        $body = 'secretSession=' . $campusSession . '&name=' . $name . '&idGame=' . $idGame . "&idCategory=" . $idCategory . "&dateCreation=" . $dateCreation;
        return $this->service("game/add", "POST", $body);
    }

	public function delGame($campusSession, $idGame) {
        $body = 'secretSession=' . $campusSession;
        return $this->service("game/delete/" . $idGame, "POST", $body);
    }
	
    public function getGame($gameId, $campusSession) {

        return json_decode($this->service("game/" . $campusSession . "/get/" . $gameId));
    }

	/*Now we not use it - is from Rviguera TFM*/
	/*public function getListGames($campusSession, $idOrderer, $idFilterer, $fields, $values) {
        $body = 'secretSession=' . $campusSession;
    $count = count($fields);
    for ($i = 0; $i < $count; $i++) {
        $body = $body . "&fields=" . $fields[$i] . "&values=" . $values[$i];
    }
        return json_decode($this->service("game/" . $campusSession . "/list/" . $idOrderer . "/" . $idFilterer, "POST", $body));
    }*/
	
    public function getListGames($campusSession) {
        //var_dump($this->service("game/" . $campusSession . "/list")); //Volem que torni l'objecte
        return json_decode($this->service("game/" . $campusSession . "/list"));
    }

    public function getUserListGames($username, $campusSession) {
        //$body = 'secretSession=' . $campusSession . "&username=" . $username;
        return json_decode($this->service("game/" . $campusSession . "/listDev/" . $username));
        //var_dump($this->service("game/" . $campusSession . "/list/" . $username));
    }
	
	public function getListGamesSearch($name, $category, $platform, $skill, $tag, $keyMeta, $valueMeta, $sort, $offset, $limit, $campusSession) {
		$text = urlencode($name . "#_#" . $category . "#_#" . $platform . "#_#" . $skill . "#_#" . $tag . "#_#".  $keyMeta . "#_#" . $valueMeta . "#_#" . $sort);
		return json_decode($this->service("game/" . $campusSession . "/list/" . $text . "?offset=" . $offset . "&limit=" . $limit));
    }

		/* Similar games */
	public function getListSimilarGames($idGame, $campusSession) {
		return json_decode($this->service("game/" . $campusSession . "/listsimilar/" . $idGame));
    }
	/* Category */
    public function getCategory($campusSession, $idCategory) {
        $objCategory = json_decode($this->service("game/category/" . $campusSession . "/get/" . $idCategory));
        return $objCategory;
    }
	
    public function getCategories($campusSession) {
        $listCategories = json_decode($this->service("game/category/" . $campusSession . "/list/"));
        return $listCategories;
    }

	/* Comments */
    public function addCommentGame($campusSession, $idGame, $idComment) {
        $body = 'secretSession=' . $campusSession . "&idGame=" . $idGame;
        return $this->service("game/comment/" . $idComment . "/add", "POST", $body);
    }

    public function delCommentGame($campusSession, $idComment) {
        $body = 'secretSession=' . $campusSession . '&containerId=' . $containerId;
        return $this->service("game/comment/" . $idComment . "/del", "POST", $body);
    }
	
    public function getCommentsGame($campusSession, $idGame) {
        $listComments = json_decode($this->service("game/comment/" . $campusSession . "/list/" . $idGame));
        return $listComments;
    }

	/* Tags */
    public function addDelTagsGame($campusSession, $idGame, $tagsCommaSeparated) {
        $body = 'secretSession=' . $campusSession . '&tags=' . $tagsCommaSeparated;
        return $this->service("game/tag/" . $idGame . "/addDel", "POST", $body);
    }
	
    public function getTagsGame($campusSession, $idGame) {
        $listTags = json_decode($this->service("game/tag/" . $campusSession . "/list/" . $idGame));
        return $listTags;
    }
	
	/* Platforms */
    public function getPlatform($campusSession, $idPlatform) {
        $objPlatform = json_decode($this->service("game/platform/" . $campusSession . "/get/" . $idPlatform));
        return $objPlatform;
    }
	
	public function getPlatforms($campusSession) {
		$listPlatforms = json_decode($this->service("game/platform/" . $campusSession . "/list/"));
        return $listPlatforms;
    }

	/* Skills */
	public function getSkill($campusSession, $idSkill) {
        $objSkill = json_decode($this->service("game/skill/" . $campusSession . "/get/" . $idSkill));
        return $objSkill;
    }
	
	public function getSkills($campusSession) {
		$listSkills = json_decode($this->service("game/skill/" . $campusSession . "/list/"));
        return $listSkills;
    }

	/* Metadata */
    public function addDelMetaDatasGame($campusSession, $idGame, $keysCommaSeparated, $valuesCommaSeparated) {
        $body = 'secretSession=' . $campusSession . '&keys=' . $keysCommaSeparated . '&values=' . $valuesCommaSeparated;;
        return $this->service("game/metadata/" . $idGame . "/addDel", "POST", $body);
    }

	public function getMetaDatasGame($campusSession, $idGame) {
        $listMetaDatas = json_decode($this->service("game/metadata/" . $campusSession . "/list/" . $idGame));
        return $listMetaDatas;
    }
	
	public function getMetaDatas($campusSession) {
        $listMetaDatas = json_decode($this->service("game/metadata/" . $campusSession . "/list/"));
        return $listMetaDatas;
    }
}

?>
