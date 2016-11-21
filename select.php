<?php  
    include_once ('session.php');
    include_once ('connection_db.php');

    $connection = db_connect();

    $output = '';  
    $sql = "SELECT * FROM `interest` ORDER BY `id_interest` DESC";
    $result = mysqli_query($connection, $sql);  
    $output .= '  
        <div class="table-responsive">  
        <table class="table table-bordered">  
        <tr id="firstrow">  
        <th>Nombre del interés</th>
        <th>Descripción del interés</th>
        <th>Otra información</th>
        <th>Delete</th>  
        </tr>';  

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output .= '  
                <tr>
                <td class="name_interest" data-id1="'.$row["id_interest"].'" contenteditable>'.$row["name_interest"].'</td>
                <td class=" description_interest" data-id2="'.$row["id_interest"].'" contenteditable>'.$row["description_interest"].'</td>  
                <td class="other_info" data-id3="'.$row["id_interest"].'" contenteditable>'.$row["other_info"].'</td>  
                <td><button type="button" name="delete_btn" data-id4="'.$row["id_interest"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                </tr>  
           ';  
        } 
        $output .= '  
           <tr>                  
                <td id="name_interest" contenteditable></td>  
                <td id="description_interest" contenteditable></td>  
                <td id="other_info" contenteditable></td>
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';  
    } else  {  
        $output .= '<tr>  
        <td colspan="4">Data not Found</td>  
        </tr>';  
    }
    
    $output .= '</table></div>';  
    echo $output;
?>  