<?php
function genRow($task,$ddl,$tid){
  return <<<"ROW"
          <tr>
            <td>$task</td>
            <td>$ddl</td>
            <td><i class="material-icons" ><a href="deleteTodo.php?tid=$tid">change_history</a></i></td>
          </tr>
ROW;
}
$tableContent = <<<"EOT"
      <table>
        <thead>
          <tr>
              <th>Task</th>
              <th>DDL</th>
              <th> </th>
          </tr>
        </thead>

        <tbody>
EOT;

$sql = "SELECT * FROM ClassHelper.todo WHERE done = 0 and uid = \"$uid\"";
$result = $conn->query($sql);
$numResult = $result->num_rows;
if ($numResult >2){
  $numResult = 2;
}
for($i=0;$i<$numResult;$i++){
  $row = $result->fetch_assoc();
  $tableContent = $tableContent.genRow($row["task"],$row["ddl"],$row["tid"]);
}

$tableContent = $tableContent."</tbody> </table>";

?>


    <div class="col s12 m6">
      <div class="card white small">
                  
        <div class="card-content black-text">
          <span class="card-title">Todo</span>
          
            <?php echo $tableContent;?>
            <p align="right"><i  class="material-icons" ><a href="todo/allTodo.php">arrow_forward</a></p>
        </div>
        
      </div>
    </div>