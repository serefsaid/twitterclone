<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <style>
        a{
            text-decoration:none;
            cursor:pointer
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
<p>
    Login was successful @<?=$user->username?>! <br>
    id = <?=$_COOKIE['userID']?>
</p>    
<div>
    <textarea style="resize:none;width:40%;height:60px" name="tweet" id="tweetInput"></textarea> <br> 
    <div style="display:flex;justify-content:space-between;width:40%">
        <button id="tweetButton" onclick="tweet()" disabled>tweet</button> 
        <span id="characterLimit">280</span>
    </div>
    <span id="sentMessage" style="display:none">tweet sent</span>
    <span id="notSentMessage" style="display:none">tweet not sent</span>
</div>
<br><br>
<?php foreach($tweets as $tweet){
    if($tweet->userID==$_COOKIE['userID']){
            $mine = 1;
        }else{
            $mine = 0 ;
        }

        $getTweeter = $this->Main_model->get('users','username',array('id'=>$tweet->userID),true);
        ?>
    <div style="display:flex;justify-content:space-between;width:60%;border:1px solid black">
        <div>
            <b>
                <a href="<?=base_url();?>Main_controller/profile/<?=$getTweeter->username?>">
                    <?=$getTweeter->username?> : 
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
$("#tweetInput").keydown(function(e){
    if($('#tweetInput').val()!=''){
        $('#tweetButton').removeAttr('disabled');
    }
    
    if(e.keyCode===13){
        tweet();
    }
    $('#characterLimit').html(280-$('#tweetInput').val().length);
})

function tweet(){
    var tweet = $("#tweetInput").val();
    var userID = '<?=$_COOKIE['userID']?>';
    if($('#tweetInput').val().length<280){
        $.post( "<?=base_url();?>Main_controller/tweet",{userID:userID,tweet:tweet} ,function( data ) {
            if(data!=1){
                $('#notSentMessage').removeAttr('style');
            }else{
                $('#sentMessage').removeAttr('style');
                $('#tweetInput').val('');
            }
        });
    }else{
        alert('Karakter sınırını aştınız!');
    }
}
function dropdown(id){
    $("#dropdown"+id).toggle();
}
</script>
</html>