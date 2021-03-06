<?php
    session_start();
    include "util.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = array();
        $data["USERNAME"] = $_POST["username"];
        $data["PASSWORD"] = $_POST["password"];
        $data["ES_CLUSTER_URL"] = $_POST["cluster_url"];
        $data["ARC_ID"] = $_POST["arc_id"];
        $data["OPENFAAS_GATEWAY"] = $_POST["open_faas_gateway"];
        $data["OPENFAAS_KUBE_CONFIG"] = $_POST["open_faas_kube_config"];
        $data["LOG_FILE_PATH"] = "/appbase-data/es.json";
        if (isset($_POST["set_sniffing"])) {
            $data["SET_SNIFFING"] = "true";
        } else {
            $data["SET_SNIFFING"] = "false";
        }
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["cluster_url"]) && isset($_POST["arc_id"]) && !empty($_POST["username"]) && !empty($_POST["username"]) && !empty($_POST["cluster_url"]) && !empty($_POST["arc_id"])) {
            upsertEnvVars($data);
            upsertLogFile($data);
            logout("?success=Data updated successfully");
        } else {
            header("Location: env.php?error=Invalid parameters");
        }
    } else {
        header("Location: index.php?error=Invalid method");
    }
?>
