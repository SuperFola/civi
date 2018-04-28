<?php
    /* function parseparameters
     * $params array("key" => "value")
     * retourne un array(
     *      "view" => "view name",
     *      "user" => ...,
     * )
     */
    function parseparameters($params) {
        $output = array();
        $valid_views = array("createprofile", "editaccount", "search", "viewprofile", "about", "search-error", "disconnected", "signin");

        if (isset($params["view"])) {
            if (in_array($params["view"], $valid_views)) {
                $output["view"] = $params["view"];
                $output["valid"] = true;
            } else {
                $output["view"] = "undefined";
                $output["valid"] = false;
            }
        } else {
            // incorrect si on est pas vide (cela veut dire qu'on a pas réussi à parser certains arguments)
            // correct si vide parce qu'on a rien eu a parser
            $output["valid"] = empty($params);
        }

        return $output;
    }
?>