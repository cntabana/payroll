<table class="table table-striped" >
        <thead>
            <tr>
                <th>Staff Member Name</th>
                <th>Payroll Ref</th>
                <th>Total Hours Worked</th>
                <th>Total Pay</th>
                <th>Work Date</th>
               
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $ret->fetchArray() ){
        ?>
            <tr>
                <td><?php echo $row['firstname'].' '.$row['familyname'].' '.$row['middlename'] ?></td>
                <td><?php echo $row['Payroll_Ref'];?></td>
                <td><?php echo $row['Total_Hours_Worked'];?></td>
                <td><?php echo $row['Total_Pay'];?></td>
                <td><?php echo date('dS F Y',$row['Work_Date']);?>
                </td>
               
            </tr>
             
         <?php        
           }
         ?>
        </tbody>
</table>