<select class="form-control" name="class" id="class">
                            <option value="">Select A class</option>
                            <?php 
                                include("./database/db.php");
                                $query = "select * from class";
                                $result = $conn->query($query);
                                foreach($result as $row)
                                    {
                                        $name = ucfirst($row['name']);
                                        $id = $row['id'];
                                        echo "<option value=$id>$name</option>";
                                    }
                            ?>
</select>