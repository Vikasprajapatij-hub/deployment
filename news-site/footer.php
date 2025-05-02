<div id ="footer">
<?php
            $sql1 = "SELECT footerdesc FROM setting";
        $res1 = mysqli_query($conn,$sql1); 
         if(mysqli_num_rows($res1) > 0)
      {
          while($row = mysqli_fetch_assoc($res1))
                 {
                    $desc = $row['footerdesc'];
                 }  
        }
              ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $desc; ?></span>
            </div>
            
        </div>
    </div>
</div>
</body>
</html>
  