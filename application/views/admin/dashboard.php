<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 3/29/2022
 * Time: 12:27 AM
 */
?>
<style>
    .panel-body a{
        color:#FFf;
        margin-top: 0px;
    }

</style>
<div id = "min-height" class="container-fluid" >
    <div class="container">
        <div class="row">
            <?php
            foreach ($side_bar_values as $value) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <a href="<?=base_url().$value['link']?>">
                            <div class="card-body">
                                <h1><?=$value['value']?></h1>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>


</div>