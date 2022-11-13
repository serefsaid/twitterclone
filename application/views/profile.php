<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@<?=$profileOwner->username?> profili</title>
    <style>
        a{
            text-decoration:none;
            cursor:pointer;
            color:inherit;
        }
        a:hover{
            text-decoration:underline
        }
        a:visited{
            color:inherit
        }

    </style>

</head>
<body>
    <h1>
        @<?=$profileOwner->username?>
        <?php if($profileOwner->id==$_COOKIE['userID']){echo "(bu senin profilin)";}?>
    </h1>
    <br> <br>
    <?php
    foreach($tweets as $tweet){
        if($tweet->userID==$_COOKIE['userID']){
            $mine = 1;
        }else{
            $mine = 0 ;
        }
    ?>
    <div style="display:flex;justify-content:space-between;width:60%;border:1px solid black">
        <div>
            <b>
                <a href="<?=base_url();?>Main_controller/profile/<?=$profileOwner->username?>">
                    <?=$profileOwner->username?> : 
                </a>
            </b>
            <div>
                <span><?=$tweet->tweet?><span>
            </div>
            <div>
                <a href="<?=base_url()?>Tweet/like/<?=$tweet->id?>">like</a><span> <?=$tweet->like?></span>
            </div>
        </div>
        <div>
            <a onclick="dropdown(<?=$tweet->id?>)">seçenekler</a>
            <div id="dropdown<?=$tweet->id?>" style="display:none">
                <div style="<?php if($mine!=1){echo "display:none";}?>" id="edit">
                    <a href="<?=base_url()?>Tweet/edit/<?=$tweet->id?>">edit</a>
                </div>
                <div style="<?php if($mine!=1){echo "display:none";}?>" id="delete">
                    <a href="<?=base_url()?>Tweet/delete/<?=$tweet->id?>">delete</a>
                </div>
                <div style="<?php if($mine!=0){echo "display:none";}?>" id="report">
                    <a href="<?=base_url()?>Tweet/report/<?=$tweet->id?>">report</a>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</body>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    function dropdown(id){
        $("#dropdown"+id).toggle();
    }
</script>
</html>