<table>
    <tr>
        <td>ID:</td>
        <td><?php echo $category['id']?></td>
    </tr>
    <tr>
        <td>DESCRIPTION:</td>
        <td><?php echo $category['description']?></td>
    </tr>
    <tr>
        <td>AVATAR:</td>
        <td><img src="assets/upload/<?php echo $category['avatar']?>" height="80px" width="80px"></td>
    </tr>
    <tr>
        <td>TIME:</td>
        <td><?php echo date('Y-m-d H:i:sa',strtotime($category['created_at']))?></td>
    </tr>
</table>
<a href="index.php?controller=category&action=index">Back</a>