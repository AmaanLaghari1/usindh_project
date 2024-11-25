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
    


    #collgedata {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: 30px;
        margin-left: 8%;
    }

    #collgedata td,
    #collgedata th {
        border: 1px solid #ddd;
        padding: 8px;

    }

    #collgedata tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #collgedata tr:hover {
        background-color: #ddd;
    }

    #collgedata th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0967a9;
        color: white;
    }

    /*#collegeID {*/
    /*    width: 360px;*/
    /*    height: 50px;*/
    /*    border-radius: 10px;*/
    /*    margin-left: 8%;*/
    /*    padding: 12px;*/
    /*    font-size: 16px;*/
    /*}*/
    
    /*h3{*/
    /*   text-align: center;*/
    /*}*/
    
     #myInput{
      margin:6px;
      padding:8px;
      border-radius:10px;
      width:80%;
      margin-left: 8%;
    }
</style>

<h2 class="heading">DIRECTORATE OF AFFILIATED COLLEGES, UNIVERSITY OF SINDH </h2>
<h4 class="heading2">LIST OF ALL PRIVATE AND GOVERNMENT AFFILIATED COLLEGES/INSTITUTES OF VARIOUS ACADEMIC DEGREE PROGRAMS FOR THE YEAR 2024 </h4>

<input type="text" id="myInput" placeholder="Search for names..">


<table id="collgedata">
    <tr>
        <th>No</th>
        <th>College Name</th>
        <th>Type</th>
    </tr>
    <?php foreach($result as $college): ?>
  
    <tr>
        <td><?php echo $college->COLLEGE_ID; ?></td>
        <td>  <a href='<?=base_url("college_prog?id=".$college->COLLEGE_ID)?>'><?php echo $college->COLLEGE_NAME; ?> </a></td>
        <td><?php echo $college->TYPE; ?></td>
    </tr>
   
    <?php endforeach; ?>
</table>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#collgedata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>








