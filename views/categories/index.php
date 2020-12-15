<div>
    <h3>Danh sách sản phẩm</h3>
</div>
<div>
    <div id="add"><a href="index.php?controller=category&action=create">Add New</a></div>
<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>DESCRIPTION</th>
        <th>AVATAR</th>
        <th>TIME</th>
        <th></th>
    </tr>
    <?php foreach($category as $value):?>
        <tr>
            <td><?php echo $value['id'];?></td>
            <td><?php echo $value['name'];?></td>
            <td><?php echo $value['description'];?></td>
            <td><img src="assets/upload/<?php echo $value['avatar']?>" height="80px" width="80px"></td>
            <td><?php echo date('Y-m-d', strtotime($value['created_at']))?></php></td>
            <td>
                <a href="index.php?controller=category&action=update&id=<?php echo $value['id'];?>">Update</a>
                <a href="index.php?controller=category&action=detail&id=<?php echo $value['id'];?>">Detail</a>
                <a href="index.php?controller=category&action=delete&id=<?php echo $value['id'];?>"
                onclick="return confirm('Are you sure to delete?')">Delete</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
    <div id="pages"><?php  echo $pages ?></div>
</div>
<style>
    #pages{
        margin-top:10px;
    }
    .page{
        text-decoration: none;
        margin-right:5px;
        text-align: center;
        border:1px solid black;
        display: inline-block;
        height:20px;
        width: 20px;
    }
    .page_item{
        background-color:yellow;
    }
    .first{
        text-decoration: none;
        border:1px solid black;
        display: inline-block;
        padding:0 5px;
        height:20px;
        margin-right:5px;
    }
    #add a{
        text-decoration: none;
    }
    #add a:hover{
        background-color: #0d57ff;
    }
</style>