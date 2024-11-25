<style>
    .heading {
        text-align: center;
        font-weight: bold;
        margin-top: 30px;
        color: #0967a9;
    }

    .heading2 {
        text-align: center;
        margin: 20px;
        font-weight: bold;
        color: #0967a9;
    }
    
    table{
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: 10px;
        margin-left: 8%;
    }
    
        td,
         th {
        border: 1px solid #ddd;
        padding: 8px;

    }
    
    
     tr:nth-child(even) {
        background-color: #f2f2f2;
    }

     tr:hover {
        background-color: #ddd;
    }

     th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0967a9;
        color: white;
    }




</style>

<h2 class="heading">DIRECTORATE OF AFFILIATED COLLEGES, UNIVERSITY OF SINDH </h2>
<h4 class="heading2">LIST OF ALL PRIVATE AND GOVERNMENT AFFILIATED COLLEGES/INSTITUTES OF VARIOUS ACADEMIC DEGREE PROGRAMS FOR THE YEAR 2024 </h4>





<table id="">
    <thead>
        <tr>
            <th>Program Name</th>
            <th>Program Seats</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($programs as $p): ?>
            <tr>
                <td><?php echo $p->PROGRAM_NAME; ?></td>
                <td><?php echo $p->PROGRAM_SEAT; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
?>



<?php

// prePrint($programs);
?>
