<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View page Animaux</title>
    </head>
    <body>
        <?php include "tableListingHabitats.php" ?>
        <?php include "../headerLogout.php" ?>
        <header>

        </header>

        <div class="titredepage">
            <h1>Aracadia Zoo - Listing Animaux / <br/></h1>
        </div>
        <table width="100%" id="table">
            <tr>
                <th>Habitat </th>
                <th>Prénom</th>
                <th>Race </th>
                <th> Photo</th>
            </tr>
            <?php  
                $readTablHabitat->setFetchMode(PDO::FETCH_ASSOC);
                foreach ($readTablHabitat as $row) 
                {
            ?>
            <tr>
                <td><?php echo $row['habitat'];?></td>
                <td><?php echo $row['penom_animal'];?></td>
                <td><?php echo $row['race'];?></td>
                <td><?php echo '<img src="' . $row['photo'] . ' "style="width:80px; height:60px;" />';?></td>
                
                <td>
                    <a href='formUpdateAnimauxAdmin.php?id_habitat={$row['id_habitat']}' class='link-warning'><i class='fas fa-pencil-square'></i></a>&nbsp
                    <a href='updateStatutHabitats.php?id_habitat={$row['id_habitat']}' class='link-danger'><i class='fas fa-trash'></i></a>
                </td>
            <?php
                }
            ?>
        </table>
        <?php include "../footer.php" ?>
    </body>
</html>