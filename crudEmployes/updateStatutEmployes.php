<?php
    if(isset($_GET["id_employe"])){
        $id=$_GET["id_employe"];

        require_once("../dbconn.php");
    
        // Mise à jour du statut à "inactif"
        $sql = "UPDATE employes SET statut = 'inactif' WHERE id_employe = $id";
        $conn->query($sql);
    }

    header("location:tableListingEmployes.php");
    exit;
?>
