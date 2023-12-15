<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Track Record Kualitas Air</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="track-record-air" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
            <th>id</th>
            <th>pH</th>
            <th>TDS</th>
            <th>Fuzzy Value</th>
            <th>Status</th>
            <th>Time Stamp</th>
            </tr>
            </thead>
            <tbody>
            <?php
                require("../config/connection.php");
                require("../assets/fuzzy-logic/fuzzy-logic.php");
                global $connect;
                $sql = "SELECT * FROM sensor_data";
                $query = mysqli_query($connect, $sql);
            
                if($query){
                    while($row = mysqli_fetch_assoc($query)){
                        $fuzzy_status = getFinalStatus($row['fuzzy_result']);
                        if($fuzzy_status == "buruk"){
                            $class_name = "badge bg-danger";
                        }else if($fuzzy_status == "cukup"){
                            $class_name = "badge bg-warning";
                        }else if($fuzzy_status == "baik"){
                            $class_name = "badge bg-success";
                        }
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['ph']."</td>";
                        echo "<td>".$row['tds']."</td>";
                        echo "<td>".$row['fuzzy_result']."</td>";
                        echo '<td><span class="'.$class_name.'">'.$fuzzy_status.'</span></td>';
                        echo "<td>".$row['time_stamp']."</td>";
                    }
            
                }
            ?>
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
</div>


<script>
  //data table
  $(function () {
    $("#track-record-air").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching":false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>