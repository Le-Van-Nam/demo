<table>
    <form action="" method="post" enctype="multipart/form-data">
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo $category['name']?>" /></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea name="description" cols="20"><?php echo $category['description']?></textarea></td>
        </tr>
        <tr>
            <td>Upload avatar:</td>
            <td>
                <input type="file" name="avatar" />
                <img src="assets/upload/<?php echo $category['avatar']?>" height="80px" width="80px">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Update" />
            </td>
        </tr>
    </form>
</table>
<a href="index.php?controller=category&action=index">Back</a>