<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<style>
.choosesubject
    {
        margin-top:50px;
        font-size:20px
    }
    .type
    {
      
        color:#fff;
    }
</style>

        <div class="col-sm-3">
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
           </div>
        <div class="col-sm-9 choosesubject">
            <span class="col-md-2 type"><a href="viewsubject.php?type=1"> Partners </a></span> 
            <br/><br/>
            <span class="col-md-2  type"><a href="viewsubject.php?type=2"> Latest News</a></span>
            </div>
            </div>
    
    </div>