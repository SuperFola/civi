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

        if (isset($params["view"])) {
            if ($params["view"] == "createprofile" || $params["view"] == "editaccount" || $params["view"] == "search" || $params["view"] == "viewprofile")
                $output["view"] = $params["view"];
        }

        return $output;
    }
?>